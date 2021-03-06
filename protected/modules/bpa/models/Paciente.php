<?php

/**
 * This is the model class for table "bpa_paciente".
 *
 * The followings are the available columns in table 'bpa_paciente':
 * @property string $cns
 * @property string $nome
 * @property string $sexo
 * @property string $data_nascimento
 * @property string $cidade
 * @property string $nacionalidade
 * @property string $raca
 * @property string $etnia
 * @property string $ultima_atualizacao
 * @property string $data_cadastro
 * @property integer $id
 */
class Paciente extends CActiveRecord {

    /**
     * @var string número do cns
     * @soap
     */
    public $cns;

    /**
     * @var string nome
     * @soap
     */
    public $nome;

    /**
     * @var string sexo
     * @soap
     */
    public $sexo;

    /**
     * @var date data de nascimento
     * @soap
     */
    public $data_nascimento;

    /**
     * @var string código IBGE da cidade
     * @soap
     */
    public $cidade;

    /**
     * @var string código da nacionalidade
     * @soap
     */
    public $nacionalidade;

    /**
     * @var string raça
     * @soap
     */
    public $raca;

    /**
     * @var string etnia, caso seja de raça indígena
     * @soap
     */
    public $etnia;

//         function __construct($paciente=null) {
//             if($paciente!= null){
//                 $this->cidade=$paciente->cidade;
//                 $this->cns=$paciente->cns;
//                 $this->data_nascimento=$paciente->data_nascimento;
//                 $this->etnia=$paciente->etnia;
//                 $this->nacionalidade=$paciente->nacionalidade;
//                 $this->nome=$paciente->nome;
//                 $this->raca=$paciente->raca;
//                 $this->sexo=$paciente->sexo;
//             }
//             
//         }

    public function setPaciente($paciente) {

        $this->cidade = $paciente->cidade;
        $this->cns = $paciente->cns;
        $this->data_nascimento = $paciente->data_nascimento;
        $this->etnia = $paciente->etnia;
        $this->nacionalidade = $paciente->nacionalidade;
        $this->nome = $paciente->nome;
        $this->raca = $paciente->raca;
        $this->sexo = $paciente->sexo;
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Paciente the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'bpa_paciente';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nome, sexo, data_nascimento, cidade, nacionalidade,  raca, ultima_atualizacao', 'required'),
            array('cns', 'length', 'max' => 15),
            array('nome', 'length', 'max' => 30),
            array('sexo', 'length', 'max' => 1),
            array('cidade', 'length', 'max' => 6),
            array('nacionalidade', 'length', 'max' => 3),
            array('raca', 'length', 'max' => 2),
            array('etnia', 'length', 'max' => 4),
            array('data_cadastro,id,etnia', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('cns, nome, sexo, data_nascimento, cidade, nacionalidade,  raca, etnia, ultima_atualizacao, data_cadastro', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'cns' => 'Cns',
            'nome' => 'Nome',
            'sexo' => 'Sexo',
            'data_nascimento' => 'Data Nascimento',
            'cidade' => 'Cidade',
            'nacionalidade' => 'Nacionalidade',
            'raca' => 'Raca',
            'etnia' => 'Etnia',
            'ultima_atualizacao' => 'Ultima Atualizacao',
            'data_cadastro' => 'Data Cadastro',
            'id' => 'ID',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('cns', $this->cns, true);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('sexo', $this->sexo, true);
        $criteria->compare('data_nascimento', $this->data_nascimento, true);
        $criteria->compare('cidade', $this->cidade, true);
        $criteria->compare('nacionalidade', $this->nacionalidade, true);
        $criteria->compare('raca', $this->raca, true);
        $criteria->compare('etnia', $this->etnia, true);
        $criteria->compare('ultima_atualizacao', $this->ultima_atualizacao, true);
        $criteria->compare('data_cadastro', $this->data_cadastro, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function getCnsNome() {
        return $this->cns . '/' . $this->nome;
    }

    /**
     * Deleta os pacientes de acordo com os ids passados
     * @param array $ids todos os pacientes que deve ser deletados
     */
    public static function deleteAllNovosESemCNS($ids) {
        $sql = 'DELETE FROM bpa_paciente WHERE (cns IS NULL) AND id IN(';
        $cont = 0;
        foreach ($ids as $key => $value) {
            if ($cont === 0) {
                $sql = $sql . ':' . $key;
                $cont++;
            } else {
                $sql = $sql . ',:' . $key;
            }
        }
        $sql = $sql . ');';

        $con = Yii::app()->db;
        $transc = $con->beginTransaction();
        try {
            $command = $con->createCommand($sql);
            //bind os parâmetros
            foreach ($ids as $key => $value) {

                $command->bindParam(':' . $key, $value, PDO::PARAM_INT);
            }
            $command->execute();
            $transc->commit();
        } catch (Exception $ex) {
            $transc->rollback();
            Yii::log($ex->getMessage(), CLogger::LEVEL_ERROR);
        }
    }
    /**
     * Exclui todos os pacientes relacionados à produção daquela competência (Movimento) e unidade.
     * Caso $connection seja passada, precisa-se abrir uma transação e comitar.
     * @param string $competencia
     * @param string $unidade
     * @param CDBConnection $connection 
     */
    public static function deleteAllOfProducaoESemCNS($competencia,$unidade,$connection=null){
        $sql='DELETE pac FROM bpa_paciente pac INNER JOIN bpa_procedimento_realizado p ON (p.id_paciente=pac.id AND pac.cns IS NULL)';
        $sql=$sql.' WHERE p.competencia=:competencia AND p.unidade=:unidade;';
        if ($connection === null){
            $connection=Yii::app()->db;
            $transaction=$connection->beginTransaction();
            try{
                $command=$connection->createCommand($sql);
                $command->bindParam(':competencia', $competencia,PDO::PARAM_STR);
                $command->bindParam(':unidade', $unidade,PDO::PARAM_STR);
                $command->execute();
                $transaction->commit();
            }  catch (Exception $ex){
                $transaction->rollback(); 
                throw $ex;
            }
        }
        else{
            $command=$connection->createCommand($sql);
                $command->bindParam(':competencia', $competencia,PDO::PARAM_STR);
                $command->bindParam(':unidade', $unidade,PDO::PARAM_STR);
                $command->execute();
        }
    }
    public function __toString() {
        return $this->cns;
    }

}