<?php

/**
 * This is the model class for table "odontologo_executa_meta".
 *
 * The followings are the available columns in table 'odontologo_executa_meta':
 * @property string $odontologo_cpf
 * @property string $unidade_cnes
 * @property integer $meta_id
 * @property integer $total
 * @property integer $competencia
 */
class OdontologoExecutaMeta extends CActiveRecord
{
    
        const COMPETENCIA_INEXISTENTE = "Nenhuma Meta";
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
                        array('meta_id,odontologo_cpf,unidade_cnes,total,competencia', 'required'),
			array('meta_id,total,competencia', 'numerical', 'integerOnly'=>true),
			array('odontologo_cpf', 'length', 'max'=>11),
			array('unidade_cnes', 'length', 'max'=>10),
                        array('competencia', 'length', 'max'=>6),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('odontologo_cpf, unidade_cnes,competencia,total meta_id', 'safe', 'on'=>'search'),
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
			'odontologo_cpf' => 'Odontólogo',
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
      
        
        public function searchMetasExecutadas($competencia) {
                $where='';
                if($competencia!=null){
                    $where = "where odonto_exec_meta.competencia='$competencia'";
                }
                $dados=Yii::app()->db->createCommand("select meta.nome as meta,serv.nome as odontologo,unid.nome as unidade,meta.valor as TotalEsperado,odonto_exec_meta.total as TotalExecutado 
                                                      from odontologo_executa_meta as odonto_exec_meta INNER JOIN meta
                                                      ON odonto_exec_meta.meta_id = meta.id INNER JOIN servidor as serv
                                                      ON serv.cpf = odonto_exec_meta.odontologo_cpf INNER JOIN unidade as unid
                                                      ON unid.cnes = odonto_exec_meta.unidade_cnes ".$where)->queryAll();

		 $tes=new CArrayDataProvider($dados, array(
                                    'id'=>'odontologo_executa_meta',
                                    'pagination'=>false

		));
                 
                
                

                 return $tes;

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

                 $query = $this->findAllBySql('select distinct competencia from odontologo_executa_meta');
                 
                 
                 return $query;
                
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
         * Calcula o valor de cada meta referente ao Odontólogo em uma determinada competência
         * para isso soma os valores dos procedimentos executados pelo Odontólogo e que fazem parte de uma meta
         * Exemplo: meta com 3 proccedimentos: o valor da meta vai ser a soma da quantidade de execução desses procedimentos
         * IMPORTANTE: os registros devolvidos não estão salvos no banco!
         * @param int competencia que a meta deve ser calculada
         * @param int offset número de início para pegar os registros
         * @param int pageSize quantidade de registros que devem ser trazidas do banco de dados
         * @return OdontologoExecutaMeta[] devolve um vetor com o s valores de cada meta executada por um Odontólogo na competência
         */
        public static function calculeMetasComProcedimentos($competencia,$offset,$pageSize){
            $sql="SELECT odo.odontologo_unidade_cnes AS cnes,SUM(odo.quantidade) AS total, odo.competencia,odo.odontologo_cpf AS odontologo, m.id AS meta";
            $sql=" $sql FROM odontologo_executa_procedimento odo INNER JOIN  meta_procedimento mp ON mp.procedimento_codigo=odo.procedimento_codigo";
            $sql=" $sql INNER JOIN meta m ON m.id=mp.meta_id";
            $sql=" $sql GROUP BY odo.competencia,m.id,odo.medico_cpf HAVING odo.competencia=:competencia; ";
            $sql=" $sql LIMIT :offset , :pageSize;";
            //
            $dbC=Yii::app()->db->createCommand($sql);
            $dbC->setFetchMode(PDO::FETCH_OBJ);
            $dbC->bindParam(':pageSize', $pageSize , PDO::PARAM_INT);
            $dbC->bindParam(':offset', $offset, PDO::PARAM_INT);
            $dbC->bindParam(':competencia', $competencia, PDO::PARAM_STR);
            $resul=array();
            foreach($dbC->queryAll() as $m){
                $odoExec= new OdontologoExecutaMeta();
                
                //popula
                $odoExec->odontologo_cpf= $m->odontologo;
                $odoExec->total=$m->total;
                $odoExec->meta_id=$m->meta;
                $odoExec->unidade_cnes=$m->cnes;
                $odoExec->competencia=$m->competencia;
                //coloca o objeto no vetor
                $resul[]=$odoExec;
            }
            return $resul;
        }
        /**
         * Calcula o valor de cada meta referente ao Odontólogo em uma determinada competência
         * para isso soma os valores dos itens executados pelo Odontólogo e que fazem parte de uma meta
         * Exemplo: meta com 3 itens: o valor da meta vai ser a soma da quantidade de execução desses itens
         * IMPORTANTE: os registros devolvidos não estão salvos no banco!
         * @param int competência que a meta deve ser calculada
         * @param int offset número de início para pegar os registros
         * @param int pageSize quantidade de registros que devem ser trazidas do banco de dados
         * @return OdontologoExecutaMeta[] devolve um vetor com os valores de cada meta executada por um Odontólogo na competência
         */
        public static function calculeMetasComItens($competencia,$offset,$pageSize){
            $sql="SELECT odo.odontologo_unidade_cnes AS cnes,SUM(odo.quantidade) AS total, odo.competencia,odo.odontologo_cpf AS odontologo, m.id AS meta";
            $sql=" $sql FROM odontologo_executa_item odo INNER JOIN  item it ON it.id=odo.item_id";
            $sql=" $sql INNER JOIN meta m ON m.id=it.meta_id";
            $sql=" $sql GROUP BY odo.competencia,m.id,odo.odontologo_cpf HAVING odo.competencia=:competencia ";
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
                $odoExec= new OdontologoExecutaMeta();
                
                //popula
                $odoExec->odontologo_cpf= $m->odontologo;
                $odoExec->total=$m->total;
                $odoExec->meta_id=$m->meta;
                $odoExec->unidade_cnes=$m->cnes;
                $agExec->competencia=$competencia;
                //coloca o objeto no vetor
                $resul[]=$odoExec;
            }
            return $resul;
        }
        protected function beforeSave() {
           
            return parent::beforeSave();
        }
}