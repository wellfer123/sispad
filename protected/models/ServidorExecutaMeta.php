<?php

/**
 * This is the model class for table "Servidor_Executa_Meta".
 *
 * The followings are the available columns in table 'Servidor_Executa_Meta':
 * @property string $servidor_cpf
 * @property integer $meta_id
 * @property integer $total
 * @property integer $competencia
 */
class ServidorExecutaMeta extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Servidor_Executa_Meta the static model class
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
		return 'servidor_executa_meta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('meta_id, total,servidor_cpf,competencia', 'required'),
			array('meta_id, total,competencia', 'numerical', 'integerOnly'=>true),
			array('servidor_cpf', 'length', 'max'=>11),
                        array('competencia', 'length', 'max'=>6),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('servidor_cpf, meta_id, total, competencia', 'safe', 'on'=>'search'),
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
			'servidor' => array(self::BELONGS_TO, 'Servidor', 'servidor_cpf'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'servidor_cpf' => 'Servidor',
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
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('servidor_cpf',$this->servidor_cpf,true);

		$criteria->compare('meta_id',$this->meta_id);

		$criteria->compare('total',$this->total);

		$criteria->compare('competencia',$this->competencia,true);

		return new CActiveDataProvider('ServidorExecutaMeta', array(
			'criteria'=>$criteria,
		));
	}
        /**
         * Calcula o valor de cada meta referente ao Servidor em uma determinada competência
         * para isso soma os valores dos procedimentos executados pelo Servidor e que fazem parte de uma meta
         * Exemplo: meta com 3 proccedimentos: o valor da meta vai ser a soma da quantidade de execução desses procedimentos
         * IMPORTANTE: os registros devolvidos não estão salvos no banco!
         * @param int competencia que a meta deve ser calculada
         * @param int offset número de início para pegar os registros
         * @param int pageSize quantidade de registros que devem ser trazidas do banco de dados
         * @return ServidorExecutaMeta[] devolve um vetor com o s valores de cada meta executada por um Servidor na competência
         */
        public static function calculeMetasComProcedimentos($competencia){
            $sql="SELECT SUM(serv.quantidade) AS total, serv.competencia,serv.servidor_cpf AS servidor, m.id AS meta";
            $sql=" $sql FROM servidor_executa_procedimento serv INNER JOIN  meta_procedimento mp ON mp.procedimento_codigo=serv.procedimento_codigo";
            $sql=" $sql INNER JOIN meta m ON m.id=mp.meta_id";
            $sql=" $sql GROUP BY serv.competencia,m.id,serv.servidor_cpf HAVING serv.competencia=:competencia; ";
            $sql=" $sql LIMIT :offset , :pageSize;";
            //
            $dbC=Yii::app()->db->createCommand($sql);
            $dbC->setFetchMode(PDO::FETCH_OBJ);
            $dbC->bindParam(':competencia', $competencia, PDO::PARAM_STR);
            $dbC->bindParam(':pageSize', $pageSize , PDO::PARAM_INT);
            $dbC->bindParam(':offset', $offset, PDO::PARAM_INT);
            $resul=array();
            foreach($dbC->queryAll() as $m){
                $servExec= new ServidorExecutaMeta();
                
                //popula
                $servExec->servidor_cpf= $m->servidor;
                $servExec->total=$m->total;
                $servExec->meta_id=$m->meta;
                $servExec->competencia=$m->competencia;
                //coloca o objeto no vetor
                $resul[]=$servExec;
            }
            return $resul;
        }
        
        /**
         * Calcula o valor de cada meta referente ao Servidor em uma determinada competência
         * para isso soma os valores dos itens executados pelo Servidor e que fazem parte de uma meta
         * Exemplo: meta com 3 itens: o valor da meta vai ser a soma da quantidade de execução desses itens
         * IMPORTANTE: os registros devolvidos não estão salvos no banco!
         * @param int competência que a meta deve ser calculada
         * @param int offset número de início para pegar os registros
         * @param int pageSize quantidade de registros que devem ser trazidas do banco de dados
         * @return ServidorExecutaMeta[] devolve um vetor com os valores de cada meta executada por um Servidor na competência
         */
        public static function calculeMetasComItens($competencia,$offset,$pageSize){
            $sql="SELECT SUM(serv.quantidade) AS total, serv.competencia,serv.servidor_cpf AS servidor, m.id AS meta";
            $sql=" $sql FROM servidor_executa_item serv INNER JOIN  item it ON it.id=serv.item_id";
            $sql=" $sql INNER JOIN meta m ON m.id=it.meta_id";
            $sql=" $sql GROUP BY serv.competencia,m.id,serv.odontologo_cpf HAVING serv.competencia=:competencia ";
            $sql=" $sql LIMIT :offset , :pageSize;";
            //
            $dbC=Yii::app()->db->createCommand($sql);
            $dbC->setFetchMode(PDO::FETCH_OBJ);
            $dbC->bindParam(':pageSize', $pageSize , PDO::PARAM_INT);
            $dbC->bindParam(':offset', $offset, PDO::PARAM_INT);
            $dbC->bindParam(':competencia', $competencia, PDO::PARAM_STR);
            Yii::log($sql);
            $resul=array();
            foreach($dbC->queryAll() as $m){
                $servExec= new ServidorExecutaMeta();
                
                //popula
                $servExec->servidor_cpf= $m->servidor;
                $servExec->total=$m->total;
                $servExec->meta_id=$m->meta;
                $agExec->competencia=$competencia;
                //coloca o objeto no vetor
                $resul[]=$servExec;
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