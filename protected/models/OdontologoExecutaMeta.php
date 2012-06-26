<?php

/**
 * This is the model class for table "odontologo_executa_meta".
 *
 * The followings are the available columns in table 'odontologo_executa_meta':
 * @property string $odontologo_cpf
 * @property string $unidade_cnes
 * @property integer $meta_id
 * @property integer $total
 * @property string $data_inicio
 * @property string $data_fim
 */
class OdontologoExecutaMeta extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return OdontologoExecutaMeta the static model class
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
		return 'odontologo_executa_meta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('meta_id, total,odontologo_cpf,unidade_cnes,data_inicio,data_fim', 'required'),
			array('meta_id, total', 'numerical', 'integerOnly'=>true),
			array('odontologo_cpf', 'length', 'max'=>11),
			array('unidade_cnes', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('odontologo_cpf, unidade_cnes, meta_id, total, data_inicio, data_fim', 'safe', 'on'=>'search'),
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
                        //Esse faz referência ao Odontólogo presente na tabela odontologo,
                        //mas para buscar buscá-lo, aqui, referencia a tabela servidor
			'odontologo' => array(self::BELONGS_TO, 'Odontologo', 'odontologo_cpf,unidade_cnes'),
                        //essa unidade faz referência a unidade presente na tabela odontologo,
                        //mas para buscar a unidade, aqui, referencia a tabela unidade
			'unidade_odontologo' => array(self::BELONGS_TO, 'Unidade', 'unidade_cnes'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'odontologo_cpf' => 'Odontologo Cpf',
			'unidade_cnes' => 'Unidade Cnes',
			'meta_id' => 'Meta',
			'total' => 'Total',
			'data_inicio' => 'Data Inicio',
			'data_fim' => 'Data Fim',
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
      
        
        public function searchMetasExecutadas($competencia) {

                $dados=Yii::app()->db->createCommand('select meta.nome as meta,serv.nome as odontologo,unid.nome as unidade,meta.valor as TotalEsperado,odonto_exec_meta.total as TotalExecutado 
                                                      from odontologo_executa_meta as odonto_exec_meta INNER JOIN meta
                                                      ON odonto_exec_meta.meta_id = meta.id INNER JOIN servidor as serv
                                                      ON serv.cpf = odonto_exec_meta.odontologo_cpf INNER JOIN unidade as unid
                                                      ON unid.cnes = odonto_exec_meta.unidade_cnes where odonto_exec_meta.competencia='.$competencia)->queryAll();

		 $tes=new CArrayDataProvider($dados, array(
                                    'id'=>'odontologo_executa_meta',
                                    'pagination'=>false

		));
                 
                
                

                 return $tes;

    }
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('odontologo_cpf',$this->odontologo_cpf,true);

		$criteria->compare('unidade_cnes',$this->unidade_cnes,true);

		$criteria->compare('meta_id',$this->meta_id);

		$criteria->compare('total',$this->total);

		$criteria->compare('competencia',$this->competencia,true);

		return new CActiveDataProvider('odontologoExecutaMeta', array(
			'criteria'=>$criteria,
		));
	}
        
                protected function afterFind() {
            
            parent::afterFind();
        }
        /**
         * Calcula o valor de cada meta referente ao medico em uma determinada competencia
         * para isso soma os valores dos procedimentos executados pelo medico e que fazem parte de uma meta
         * Exemplo: meta com 3 proccedimentos: o valor da meta vai ser a soma da quantidade de execução desses procedimentos
         * IMPORTANTE: os registros devolvidos não estão salvos no banco!
         * @param int competencia que a meta deve ser calculada
         * @return MedicoExecutaMeta[] devolve um vetor com o s valores de cada meta executada por um medico na competencia
         */
        public static function calculeMetasComProcedimentos($competencia){
            $sql="SELECT med.medico_unidade_cnes AS cnes,SUM(med.quantidade) AS total, med.competencia,med.medico_cpf AS medico, m.id AS meta";
            $sql=" $sql FROM medico_executa_procedimento med INNER JOIN  meta_procedimento mp ON mp.procedimento_codigo=med.procedimento_codigo";
            $sql=" $sql INNER JOIN meta m ON m.id=mp.meta_id";
            $sql=" $sql GROUP BY med.competencia,m.id,med.medico_cpf HAVING med.competencia=:competencia; ";
            //
            $dbC=Yii::app()->db->createCommand($sql);
            $dbC->setFetchMode(PDO::FETCH_OBJ);
            $dbC->bindParam(':competencia', $competencia, PDO::PARAM_STR);
            $resul=array();
            foreach($dbC->queryAll() as $m){
                $metExec= new MedicoExecutaMeta();
                
                //popula
                $metExec->medico_cpf= $m->medico;
                $metExec->total=$m->total;
                $metExec->meta_id=$m->meta;
                $metExec->unidade_cnes=$m->cnes;
                $metExec->data_fim=date("Y/m/d");
                $metExec->data_inicio=date("Y/m/d");
                //coloca o objeto no vetor
                $resul[]=$metExec;
            }
            return $resul;
        }

        protected function beforeSave() {
            $this->data_fim=ParserDate::inverteDataPtToEn($this->data_fim);
            $this->data_inicio=ParserDate::inverteDataPtToEn($this->data_inicio);
            return parent::beforeSave();
        }
}