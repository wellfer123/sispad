<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CidDao
 *
 * @author Albuquerque
 */
class ModelDao {

    //put your code here
    public $classeModel;

    function __construct($classeModel) {
        $this->classeModel = $classeModel;
    }

    /**
     *
     * @param CModel[] $listModels que serão inseridos no banco
     * @param Connection $connection instância de Yii::app()->db
     * Caso connection seja null irá criar pegar a conexão, abrir uma transação e inserir os dados.
     * Se connection for diferente de null, vai usála para inserir os dados. Então a transação e 
     * confirmação ou rollback deve ser feito por quem chama.
     * @return boolean se não ocorrer nenhum erro
     */
    public function insertMultiple($listModels, $connection=null) {
        $sucess = false;
        try {
            if (is_array($listModels)) {
                $insert = null;
                $classe = new $this->classeModel();
                if ($classe instanceof CModel) {
                    $insert = $this->createInsert($listModels, $classe);
                    
                    if ($connection === null) {
                        $connection = Yii::app()->db;
                        $transaction = $connection->beginTransaction();
                        try {
                            $command = $connection->createCommand($insert);
                            $command->execute();
                            $transaction->commit();
                            $sucess = true;
                        } catch (Exception $ex) {
                            Yii::log($ex->getMessage(), Clogger::LEVEL_ERROR);
                            $transaction->rollback();
                        }
                    }
                    //uma conexão foi repassada
                    else {

                        $command = $connection->createCommand($insert);
                        $command->execute();
                    }
                }
            }
        } catch (Exception $ex) {
            throw $ex;
        }
        return $sucess;
    }

    /**
     *
     * @param CModel[] $listModels que serão inseridos no banco
     * @param Connection $connection instância de Yii::app()->db
     * @param array $primaryKey que contém a chave primária ou os atributos que devem
     * fazer parte do where e que não serão atualizados
     * Caso connection seja null irá criar pegar a conexão, abrir uma transação e inserir os dados.
     * Se connection for diferente de null, vai usála para inserir os dados. Então a transação e 
     * confirmação ou rollback deve ser feito por quem chama.
     * @return boolean se não ocorrer nenhum erro
     */
    public function updatetMultiple($listModels, $primaryKey, $connection=null) {
        $sucess = false;
        try {
            if (is_array($listModels)) {
                $insert = null;
                $classe = new $this->classeModel();
                if ($classe instanceof CModel) {

                    //cria um insert
                    $insert = $this->createInsert($listModels, $classe);
                    //substitui com o nome da tabela antiga por um temporário
                    $tb = $classe->tableName();
                    $tbTemp = 'temp_' . $classe->tableName();
                    $insert = str_replace($tb, $tbTemp, $insert);
                    //gera o sql para tabela temporária
                    $tabela = $this->createSQLTempTable($tb, $tbTemp);
                    //gera o update entre o tabela temporária e a fixa
                    $update = $this->createUpdate($classe, $tb, $tbTemp, $primaryKey);
                    //cria instrução drop para deletar a tabela
                    $dropTable = $this->createDropTable($tbTemp);
                    if ($connection === null) {
                        $connection = Yii::app()->db;
                        $transaction = $connection->beginTransaction();
                        try {
                            //executa o comando
                            //primeiro cria a tabela temporária
                            $command = $connection->createCommand($tabela);
                            $command->execute();

                            //depois insere os registros e atualiza a tabela do banco
                            $command = $connection->createCommand($insert);
                            $command->execute();

                            $command = $connection->createCommand($update);
                            $command->execute();

//                            //exclui a tabela
//                            $command = $connection->createCommand($dropTable);
//                            $command->execute();
                            $transaction->commit();
                            $sucess = true;
                        } catch (Exception $ex) {
                            Yii::log($ex->getMessage(), Clogger::LEVEL_ERROR);
                            $transaction->rollback();
                        }
                    }
                    //uma conexão foi repassada
                    else {
                        //executa o comando
                        //primeiro cria a tabela temporária
                        $command = $connection->createCommand($tabela);
                        $command->execute();

                        //depois insere os registros e atualiza a tabela do banco
                        $command = $connection->createCommand($insert);
                        $command->execute();

                        $command = $connection->createCommand($update);
                        $command->execute();

//                        //exclui a tabela
//                        $command = $connection->createCommand($dropTable);
//                        $command->execute();
                    }
                }
            }
        } catch (Exception $ex) {
            throw $ex;
        }
        return $sucess;
    }

    /**
     *
     * @param string $tableName nome da tabela
     * @param string $tempTableName nome temporário da tabela
     * @return string Comando SQL gerado para criar a tabela temporária 
     */
    private function createSQLTempTable($tableName, $tempTableName) {
        $sql = null;
        try {
            $command = Yii::app()->db->createCommand('SHOW CREATE TABLE ' . $tableName . ';');
            $resultSet = $command->queryAll();
            foreach ($resultSet as $row) {
                $sql = strtoupper($row['Create Table']);
            }
            //agora zera a geração de id;

            $sql = str_replace('ENGINE=INNODB', 'ENGINE=memory', $sql);
            $sql = str_replace('ENGINE=MYISAM', 'ENGINE=memory', $sql);
            $sql = str_replace('CREATE TABLE', 'CREATE TEMPORARY TABLE IF NOT EXISTS ', $sql);
            $sql = str_replace(strtoupper($tableName), $tempTableName, $sql);
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), CLogger::LEVEL_ERROR);
        }
        return $sql . ';';
    }

    /**
     *
     * @param CModel[] $listModels um vetor com instâncias de CModel
     * @return string Comando SQL gerado para inserir 
     */
    private function createInsert($listModels, $classe) {
        $insert = "INSERT INTO " . $classe->tableName() . '(';

        $attributes = $classe->getAttributes();
        $cont = 0;
        //monta os campos da tabela
        foreach ($attributes as $atri => $value) {
            if ($cont !== 0) {
                $insert = "$insert,$atri";
            } else {
                $insert = $insert . $atri;
            }
            $cont++;
        }
        $insert = "$insert ) VALUES ";
        //monta a clausula values
        $cont = 0;
        foreach ($listModels as $key => $model) {

            //mais de um registro por insert
            if ($cont !== 0) {
                $insert = "$insert, ";
            }
            $contador = 0;
            foreach ($attributes as $atri => $value) {
                //não é primeiro campo
                $v = $model->{$atri};
                if (strlen($v) === 0) {
                    if ($contador !== 0) {
                        $insert = "$insert, NULL";
                    }
                    //é o primeiro campo
                    else {
                        $insert = "$insert (NULL ";
                    }
                } else {
                    if ($contador !== 0) {
                        $insert = "$insert, '" . $v . "'";
                    }
                    //é o primeiro campo
                    else {
                        $insert = "$insert ( '" . $v . "'";
                    }
                }
                $contador++;
            }

            $insert = $insert . ')';
            $cont++;
        }
        return $insert = $insert . ';';
    }

    /**
     *
     * @param CModel $classe uma instância de CModel
     * @param string $tableName o nome da tabela
     * @param string $tempTableName nome temporário para  a tabela
     * @param array $primaryKey comtém a chave primária (pode ser composta) ou
     * ainda os campos que não serão atualizados e serão utilizados para fazer a seleção
     * @return string comando SQL gerado para atualização de uma table a com base em outra temporária 
     */
    private function createUpdate($classe, $tableName, $tempTableName, $primaryKey) {
        $update = "UPDATE " . $tableName . ' tbl INNER JOIN ' . $tempTableName . ' t ON ';

        //gera a restrição
        $cont = 0;
        foreach ($primaryKey as $field) {
            if ($cont === 0) {
                $update = $update . ' tbl.' . $field . ' = t.' . $field;
            }
            //tem mais de um item
            else {
                $update = $update . ' AND tbl.' . $field . ' = t.' . $field;
            }
            $cont++;
        }
        //gerar os dados que serão tualizados
        $attributes = $classe->getAttributes();
        $cont = 0;
        //monta os campos da tabela
        foreach ($attributes as $atri => $value) {
            //verifica se o atributo é diferente do campo na chave primária
            if (!in_array($atri, $primaryKey)) {
                if ($cont !== 0) {
                    $update = $update . ' , tbl.' . $atri . ' = t.' . $atri;
                } else {
                    $update = $update . ' SET tbl.' . $atri . ' = t.' . $atri;
                }
                $cont++;
            }
        }

        return $update = $update . ';';
    }

    /**
     *
     * @param string $tableName nome da tabela
     * @param array() $fieldValues um vetor map. A chave é o campo e o valor
     * deve ser um vetor com os valores para exclusão
     * @return string comando SQL gerado para deletar os registros 
     */
    private function createDelete($tableName, $fieldValues) {
        $sql = 'DELETE FROM ' . $tableName . ' WHERE ';
        $cont = 0;
        foreach ($fieldValues as $field => $values) {
            if ($cont === 0) {
                $sql = $sql . $field . ' IN (';
            } else {
                $sql = $sql . $field . ' AND IN (';
            }
            $cont2 = 0;
            foreach ($values as $value) {
                if ($cont2 === 0) {
                    $sql = $sql . $value;
                } else {
                    $sql = $sql . ',' . $value;
                }
                $cont2++;
            }
            //fecha a cláusula
            $sql = $sql . ')';
            $cont++;
        }
        return $sql;
    }

    /**
     * Devolve SQL para deletar uma tabela
     * @param String $tableName noma da tabela que será deletada
     */
    private function createDropTable($tableName) {
        return "DROP TABLE $tableName ;";
    }

}

?>
