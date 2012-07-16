<?php

/**
 * This is the model class for table "tecnico_enfermagem_executa_meta".
 *
 * The followings are the available columns in table 'tecnico_enfermagem_executa_meta':
 * @property string $tecnico_enfermagem_cpf
 * @property string $unidade_cnes
 * @property integer $meta_id
 * @property integer $total
 * @property integer $competencia
 */
class TecnicoEnfermagemExecutaMeta extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TecnicoEnfermagemExecutaMeta the static model class
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
		return 'tecnico_enfermagem_executa_meta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('meta_id, total,tecnico_enfermagem_cpf,unidade_cnes,competencia', 'required'),
			array('meta_id, total,competencia', 'numerical', 'integerOnly'=>true),
			array('tecnico_enfermagem_cpf', 'length', 'max'=>11),
                        array('competencia', 'length', 'max'=>6),
			array('unidade_cnes', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('tecnico_enfermagem_cpf, unidade_cnes, meta_id, total, competencia', 'safe', 'on'=>'search'),
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
                        //Esse faz referência ao Técnico de Enfermagem presente na tabela tecnico_enfermagem,
                        //mas para buscar buscá-lo, aqui, referencia a tabela servidor
			'tecnico_enfermagem' => array(self::BELONGS_TO, 'TecnicoEnfermagem', 'tecnico_enfermagem_cpf,unidade_cnes'),
                        //essa unidade faz referência a unidade presente na tabela tecnico_enfermagem,
                        //mas para buscar a unidade, aqui, referencia a tabela unidade
			'unidade_tecnico_enfermagem' => array(self::BELONGS_TO, 'Unidade', 'unidade_cnes'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'tecnico_enfermagem_cpf' => 'Técnico Enfermagem',
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

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('tecnico_enfermagem_cpf',$this->tecnico_enfermagem_cpf,true);

		$criteria->compare('unidade_cnes',$this->unidade_cnes,true);

		$criteria->compare('meta_id',$this->meta_id);

		$criteria->compare('total',$this->total);

		$criteria->compare('competencia',$this->competencia,true);

		return new CActiveDataProvider('TecnicoEnfermagemExecutaMeta', array(
			'criteria'=>$criteria,
		));
	}
        /**
         * Calcula o valor de cada meta referente ao Técnico de Enfermagem em uma determinada competência
         * para isso soma os valores dos procedimentos executados pelo Técnico de Enfermagem e que fazem parte de uma meta
         * Exemplo: meta com 3 proccedimentos: o valor da meta vai ser a soma da quantidade de execução desses procedimentos
         * IMPORTANTE: os registros devolvidos não estão salvos no banco!
         * @param int competencia que a meta deve ser calculada
         * @param int offset número de início para pegar os registros
         * @param int pageSize quantidade de registros que devem ser trazidas do banco de dados
         * @return TecnicoEnfermagemExecutaMeta[] devolve um vetor com o s valores de cada meta executada por um Técnico de Enfermagem na competência
         */
        public static function calculeMetasComProcedimentos($competencia,$offset,$pageSize){
            $sql="SELECT tec.tecnico_enfermagem_unidade_cnes AS cnes,SUM(tec.quantidade) AS total, tec.competencia,tec.tecnico_enfermagem_cpf AS tecnico_enfermagem, m.id AS meta";
            $sql=" $sql FROM tecnico_enfermagem_executa_procedimento tec INNER JOIN  meta_procedimento mp ON mp.procedimento_codigo=tec.procedimento_codigo";
            $sql=" $sql INNER JOIN meta m ON m.id=mp.meta_id";
            $sql=" $sql GROUP BY tec.competencia,m.id,tec.tecnico_enfermagem_cpf, tec.tecnico_enfermagem_unidade_cnes HAVING tec.competencia=:competencia ";
            $sql=" $sql LIMIT :offset , :pageSize;";
            //
            $dbC=Yii::app()->db->createCommand($sql);
            $dbC->setFetchMode(PDO::FETCH_OBJ);
            $dbC->bindParam(':pageSize', $pageSize , PDO::PARAM_INT);
            $dbC->bindParam(':offset', $offset, PDO::PARAM_INT);
            $dbC->bindParam(':competencia', $competencia, PDO::PARAM_STR);
            $resul=array();
            foreach($dbC->queryAll() as $m){
                $tecExec= new TecnicoEnfermagemExecutaMeta();
                
                //popula
                $tecExec->tecnico_enfermagem_cpf= $m->tecnico_enfermagem;
                $tecExec->total=$m->total;
                $tecExec->meta_id=$m->meta;
                $tecExec->unidade_cnes=$m->cnes;
                $tecExec->competencia=$m->competencia;
                //coloca o objeto no vetor
                $resul[]=$tecExec;
            }
            return $resul;
        }
        /**
         * Calcula o valor de cada meta referente ao Técnico de Enfermagem em uma determinada competência
         * para isso soma os valores dos itens executados pelo Técnico de Enfermagem e que fazem parte de uma meta
         * Exemplo: meta com 3 itens: o valor da meta vai ser a soma da quantidade de execução desses itens
         * IMPORTANTE: os registros devolvidos não estão salvos no banco!
         * @param int competência que a meta deve ser calculada
         * @param int offset número de início para pegar os registros
         * @param int pageSize quantidade de registros que devem ser trazidas do banco de dados
         * @return TecnicoEnfermagemExecutaMeta[] devolve um vetor com os valores de cada meta executada por um Odontólogo na Técnico de Enfermagem
         */
        public static function calculeMetasComItens($competencia,$offset,$pageSize){
            $sql="SELECT tec.tecnico_enfermagem_unidade_cnes AS cnes,SUM(tec.quantidade) AS total, tec.competencia,tec.tecnico_enfermagem_cpf AS tecnico_enfermagem, m.id AS meta";
            $sql=" $sql FROM tecnico_enfermagem_executa_item tec INNER JOIN  item it ON it.id=tec.item_id";
            $sql=" $sql INNER JOIN meta m ON m.id=it.meta_id";
            $sql=" $sql GROUP BY tec.competencia,m.id,tec.tecnico_enfermagem_cpf, tec.tecnico_enfermagem_unidade_cnes HAVING tec.competencia=:competencia ";
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
                $tecExec= new TecnicoEnfermagemExecutaMeta();
                
                //popula
                $tecExec->tecnico_enfermagem_cpf= $m->tecnico_enfermagem;
                $tecExec->total=$m->total;
                $tecExec->meta_id=$m->meta;
                $tecExec->unidade_cnes=$m->cnes;
                $tecExec->competencia=$competencia;
                //coloca o objeto no vetor
                $resul[]=$tecExec;
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