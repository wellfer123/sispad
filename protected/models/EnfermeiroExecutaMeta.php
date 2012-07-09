<?php

/**
 * This is the model class for table "enfermeiro_executa_meta".
 *
 * The followings are the available columns in table 'enfermeiro_executa_meta':
 * @property string $enfermeiro_cpf
 * @property string $unidade_cnes
 * @property integer $meta_id
 * @property integer $total
 * @property string $competencia
 */
class EnfermeiroExecutaMeta extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return EnfermeiroExecutaMeta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'enfermeiro_executa_meta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('meta_id,enfermeiro_cpf,competencia,unidade_cnes', 'required'),
			array('meta_id,competencia', 'numerical', 'integerOnly'=>true),
			array('enfermeiro_cpf', 'length', 'max'=>11),
                        array('competencia', 'length', 'max'=>6),
			array('unidade_cnes', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('enfermeiro_cpf, competencia, unidade_cnes, meta_id, total', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'meta' => array(self::BELONGS_TO, 'Meta', 'meta_id'),
                        //Esse faz referência ao Enfermeiro presente na tabela enfermeiro,
                        //mas para buscar buscá-lo, aqui, referencia a tabela servidor
			'enfermeiro' => array(self::BELONGS_TO, 'Enfermeiro', 'enfermeiro_cpf,unidade_cnes'),
                        //essa unidade faz referência a unidade presente na tabela enfermeiro,
                        //mas para buscar a unidade, aqui, referencia a tabela unidade
			'unidade_enfermeiro' => array(self::BELONGS_TO, 'Unidade', 'unidade_cnes'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'enfermeiro_cpf' => 'Enfermeiro',
			'unidade_cnes' => 'Unidade',
			'meta_id' => 'Meta',
			'total' => 'Total',
                        'competencia' => 'Competência',
			
		);
	}
        /**
         * NOTA: método só deve ser chmado se o objeto meta existir!
         * Calcula se a meta foi batida ou não.
         * @return String representa uma mensagem dizendo se foi ou não batida.
         */
        public function isMetaBatida(){
            if($this->meta!==null){
                $tmp=($this->total*100)/$this->meta->valor;
                //compara os valores das metas
                $per=$this->meta->percentagem;
                if($tmp>=$per){
                    return "META BATIDA. FEZ $tmp%";
                }
                //formata o numero
                else{
                    $tmp = number_format($tmp, 2);
                    return "META NÃO BATIDA. FEZ SOMENTE $tmp%. É NECESSÁRIO FAZER $per%.";
                }
            }
        }
        
         public function listaCompetencias() {
             //recupera um array com as competenicas do banco
             $competencias = CHtml::listData($this->searchCompetencias(),'competencia','competencia');
             //se for nulo set opção nehuma
             if($competencias==null)
                 $competencias[NULL] = 'Nehuma';
             else//senão set a opção todas
                $competencias[NULL] = 'Todas';
             
             return $competencias;
    }
     public function searchCompetencias() {

                 $query = $this->findAllBySql('select distinct competencia from enfermeiro_executa_meta');
                 
                 
                 return $query;
                
     }  
     
        public function searchMetasExecutadas($competencia) {
                $where='';
                if($competencia!=null){
                    $where = "where enferm_exec_meta.competencia='$competencia'";
                }

                $dados=Yii::app()->db->createCommand('select meta.nome as meta,serv.nome as enfermeiro,unid.nome as unidade,meta.valor as TotalEsperado,enferm_exec_meta.total as TotalExecutado 
                                                      from enfermeiro_executa_meta as enferm_exec_meta INNER JOIN meta
                                                      ON enferm_exec_meta.meta_id = meta.id INNER JOIN servidor as serv
                                                      ON serv.cpf = enferm_exec_meta.enfermeiro_cpf INNER JOIN unidade as unid
                                                      ON unid.cnes = enferm_exec_meta.unidade_cnes '.$where)->queryAll();

		 $tes=new CArrayDataProvider($dados, array(
                                    'id'=>'enfermeiro_executa_meta',
                                    'pagination'=>false

		));
                 
                 return $tes;
        }   
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                
                $criteria->alias="enferExec";
		$criteria->compare('enfermeiro_cpf',$this->enfermeiro_cpf,true);

		$criteria->compare('enferExec.unidade_cnes',$this->unidade_cnes,true);

		$criteria->compare('meta_id',$this->meta_id);

		$criteria->compare('total',$this->total);

		$criteria->compare('competencia',$this->competencia,true);
                 
                $criteria->with=array('meta','enfermeiro.servidor');
		return new CActiveDataProvider('enfermeiroExecutaMeta', array(
			'criteria'=>$criteria,
		));
	}
        /**
         * Calcula o valor de cada meta referente ao Enfermeiro em uma determinada competência
         * para isso, soma os valores dos procedimentos executados pelo Enfermeiro e que fazem parte de uma meta
         * Exemplo: meta com 3 procedimentos: o valor da meta vai ser a soma da quantidade de execução desses procedimentos
         * IMPORTANTE: os registros devolvidos não estão salvos no banco!
         * @param int competência que a meta deve ser calculada
         * @param int offset número de início para pegar os registros
         * @param int pageSize quantidade de registros que devem ser trazidas do banco de dados
         * @return EnfermeiroExecutaMeta[] devolve um vetor com os valores de cada meta executada por um Enfermeiro na competência
         */
        public static function calculeMetasComProcedimentos($competencia,$offset,$pageSize){
            $sql="SELECT enf.enfermeiro_unidade_cnes AS cnes,SUM(enf.quantidade) AS total, enf.competencia,enf.enfermeiro_cpf AS enfermeiro, m.id AS meta";
            $sql=" $sql FROM enfermeiro_executa_procedimento enf INNER JOIN  meta_procedimento mp ON mp.procedimento_codigo=enf.procedimento_codigo";
            $sql=" $sql INNER JOIN meta m ON m.id=mp.meta_id";
            $sql=" $sql GROUP BY enf.competencia,m.id,enf.enfermeiro_cpf HAVING enf.competencia=:competencia ";
            $sql=" $sql LIMIT :offset , :pageSize;";
            //
            $dbC=Yii::app()->db->createCommand($sql);
            $dbC->setFetchMode(PDO::FETCH_OBJ);
            $dbC->bindParam(':pageSize', $pageSize , PDO::PARAM_INT);
            $dbC->bindParam(':offset', $offset, PDO::PARAM_INT);
            $dbC->bindParam(':competencia', $competencia, PDO::PARAM_STR);
            $resul=array();
            foreach($dbC->queryAll() as $m){
                $enfExec= new EnfermeiroExecutaMeta();
                
                //popula
                $enfExec->enfermeiro_cpf= $m->enfermeiro;
                $enfExec->total=$m->total;
                $enfExec->meta_id=$m->meta;
                $enfExec->unidade_cnes=$m->cnes;
                $agExec->competencia=$competencia;
                //coloca o objeto no vetor
                $resul[]=$enfExec;
            }
            return $resul;
        }
        
        /**
         * Calcula o valor de cada meta referente ao Enfermeiro em uma determinada competência
         * para isso soma os valores dos itens executados pelo Enfermeiro e que fazem parte de uma meta
         * Exemplo: meta com 3 itens: o valor da meta vai ser a soma da quantidade de execução desses itens
         * IMPORTANTE: os registros devolvidos não estão salvos no banco!
         * @param int competência que a meta deve ser calculada
         * @param int offset número de início para pegar os registros
         * @param int pageSize quantidade de registros que devem ser trazidas do banco de dados
         * @return EnfermeiroExecutaMeta[] devolve um vetor com os valores de cada meta executada por um Enfermeiro na competência
         */
        public static function calculeMetasComItens($competencia,$offset,$pageSize){
            $sql="SELECT enf.enfermeiro_unidade_cnes AS cnes,SUM(enf.quantidade) AS total, enf.competencia,enf.enfermeiro_cpf AS enfermeiro, m.id AS meta";
            $sql=" $sql FROM enfermeiro_executa_item enf INNER JOIN  item it ON it.id=enf.item_id";
            $sql=" $sql INNER JOIN meta m ON m.id=it.meta_id";
            $sql=" $sql GROUP BY enf.competencia,m.id,enf.enfermeiro_cpf HAVING enf.competencia=:competencia ";
            $sql=" $sql LIMIT :offset , :pageSize;";
            //
            $dbC=Yii::app()->db->createCommand($sql);
            $dbC->setFetchMode(PDO::FETCH_OBJ);
            $dbC->bindParam(':pageSize', $pageSize , PDO::PARAM_INT);
            $dbC->bindParam(':offset', $offset, PDO::PARAM_INT);
            $dbC->bindParam(':competencia', $competencia, PDO::PARAM_STR);
            $resul=array();
            foreach($dbC->queryAll() as $m){
                $enfExec= new EnfermeiroExecutaMeta();
                
                //popula
                $enfExec->enfermeiro_cpf= $m->enfermeiro;
                $enfExec->total=$m->total;
                $enfExec->meta_id=$m->meta;
                $enfExec->unidade_cnes=$m->cnes;
                $agExec->competencia=$competencia;
                //coloca o objeto no vetor
                $resul[]=$enfExec;
            }
            return $resul;
        }
        
        protected function afterFind() {
            
            parent::afterFind();
        }

        protected function beforeSave() {
            return parent::beforeSave();
        }
}
