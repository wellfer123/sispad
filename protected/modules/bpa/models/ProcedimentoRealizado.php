<?php

/**
 * This is the model class for table "bpa_procedimento_realizado".
 *
 * The followings are the available columns in table 'bpa_procedimento_realizado':
 * @property string $unidade
 * @property string $competencia
 * @property string $profissional_cns
 * @property string $profissional_cbo
 * @property string $folha
 * @property string $sequencia
 * @property string $procedimento
 * @property string $paciente_cns
 * @property string $data_atendimento
 * @property string $cid
 * @property string $quantidade
 * @property string $caracter_atendimento
 * @property string $numero_autorizacao
 * @property string $origem
 * @property string $competencia_movimento
 * @property string $servico
 * @property string $equipe
 * @property string $classificacao
 * @property string $data_cadastro
 * @property integer $idade_paciente
 * @property integer $id_paciente
 * @property string $ultima_atualizacao
 * @property string $equipe_sequencia
 * @property string $equipe_area
 * @property string $cnpj
 */
class ProcedimentoRealizado extends CActiveRecord
{
         
         /**
          *
          * @var string cns da unidade 
          * @soap 
          */
         public $unidade;
         /**
          *
          * @var string competência que o procedimento executado 
          * @soap 
          */
         public $competencia;
         /**
          *
          * @var string cns do profissional
          * @soap 
          */
         public $profissional_cns;
         /**
          *
          * @var Paciente cns do profissional
          * @soap 
          */
         public $paciente;
         /**
          *
          * @var string CBO do profissional
          * @soap 
          */
         public $profissional_cbo;
         /**
          *
          * @var string número da folha 
          * @soap 
          */
         public $folha;
         /**
          *
          * @var string sequência na folha
          * @soap 
          */
         public $sequencia;
         /**
          *
          * @var string código do procedimento
          * @soap 
          */
         public $procedimento;
         /**
          *
          * @var date data de atendimento
          * @soap 
          */
         public $data_atendimento;
         /**
          *
          * @var string CID
          * @soap 
          */
         public $cid;
         /**
          *
          * @var integer quantidade de execuções
          * @soap 
          */
         public $quantidade;
         /**
          *
          * @var string código do caráter de atendimento
          * @soap 
          */
         public $caracter_atendimento;
         /**
          *
          * @var string número de autorização
          * @soap 
          */
         public $numero_autorizacao;
         /**
          *
          * @var string origem do procedimento 
          * @soap 
          */
         public $origem;
         /**
          *
          * @var string competência do sistema
          * @soap 
          */
         public $competencia_movimento;
         /**
          *
          * @var string código do serviço
          * @soap 
          */
         public $servico;
         /**
          *
          * @var string código da equipe
          * @soap 
          */
         public $equipe;
         /**
          *
          * @var string cnpj
          * @soap 
          */
         public $cnpj;
         /**
          *
          * @var string código da área da equipe
          * @soap 
          */
         public $equipe_area;
         /**
          *
          * @var string código da sequência da equipe
          * @soap 
          */
         public $equipe_sequencia;
         /**
          *
          * @var string código da classificacao do servico
          * @soap 
          */
         public $classificacao;
         /**
          *
          * @var integer código da classificacao do servico
          * @soap 
          */
         public $idade_paciente;
         
         public function setProcedimentoRealizado($procedimentoRealizado) {
             if($procedimentoRealizado!= null){
                 $this->caracter_atendimento=$procedimentoRealizado->caracter_atendimento;
                 $this->cid=$procedimentoRealizado->cid;
                 $this->classificacao=$procedimentoRealizado->classificacao;
                 $this->competencia=$procedimentoRealizado->competencia;
                 $this->competencia_movimento=$procedimentoRealizado->competencia_movimento;
                 $this->data_atendimento=$procedimentoRealizado->data_atendimento;
                 $this->equipe=$procedimentoRealizado->equipe;
                 $this->equipe_area=$procedimentoRealizado->equipe_area;
                 $this->equipe_sequencia=$procedimentoRealizado->equipe_sequencia;
                 $this->cnpj=$procedimentoRealizado->cnpj;
                 $this->folha=$procedimentoRealizado->folha;
                 $this->idade_paciente=$procedimentoRealizado->idade_paciente;
                 $this->numero_autorizacao=$procedimentoRealizado->numero_autorizacao;
                 $this->origem=$procedimentoRealizado->origem;
                 $this->procedimento=$procedimentoRealizado->procedimento;
                 $this->profissional_cbo=$procedimentoRealizado->profissional_cbo;
                 $this->profissional_cns=$procedimentoRealizado->profissional_cns;
                 $this->quantidade=$procedimentoRealizado->quantidade;
                 $this->sequencia=$procedimentoRealizado->sequencia;
                 $this->servico=$procedimentoRealizado->servico;
                 $this->unidade=$procedimentoRealizado->unidade;
            }

         }
         
         public function setPaciente($paciente){
             if($paciente!=null){
                 $this->paciente=$paciente;
                 $this->paciente_cns=$paciente->cns;
             }
         }
         
         
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProcedimentoRealizado the static model class
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
		return 'bpa_procedimento_realizado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('unidade,competencia, profissional_cns, profissional_cbo, folha, sequencia, procedimento, data_atendimento, quantidade, caracter_atendimento, origem, competencia_movimento', 'required'),
			array('unidade, procedimento, quantidade', 'length', 'max'=>10),
			array('competencia, profissional_cbo, competencia_movimento', 'length', 'max'=>6),
			array('profissional_cns, paciente_cns', 'length', 'max'=>15),
			array('folha,idade_paciente, origem, servico, classificacao', 'length', 'max'=>3),
			array('sequencia, caracter_atendimento', 'length', 'max'=>2),
			array('cid', 'length', 'max'=>4),
			array('numero_autorizacao', 'length', 'max'=>13),
			array('equipe', 'length', 'max'=>12),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('unidade, ultima_atualizacao,competencia, idade_paciente,profissional_cns, profissional_cbo, folha, sequencia, procedimento, paciente_cns, data_atendimento, cid, quantidade, caracter_atendimento, numero_autorizacao, origem, competencia_movimento, servico, equipe, classificacao, data_cadastro', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'unidade' => 'Unidade',
			'competencia' => 'Competencia',
			'profissional_cns' => 'Profissional Cns',
			'profissional_cbo' => 'Profissional Cbo',
			'folha' => 'Folha',
			'sequencia' => 'Sequencia',
			'procedimento' => 'Procedimento',
			'paciente_cns' => 'Paciente Cns',
			'data_atendimento' => 'Data Atendimento',
			'cid' => 'Cid',
                        'idade_paciente'=>'Idade do Paciente',
			'quantidade' => 'Quantidade',
			'caracter_atendimento' => 'Caracter Atendimento',
			'numero_autorizacao' => 'Numero Autorizacao',
			'origem' => 'Origem',
			'competencia_movimento' => 'Competencia Movimento',
			'servico' => 'Servico',
			'equipe' => 'Equipe',
                        'equipe_area' => 'Área da Equipe',
                        'cnpj' => 'CNPJ',
                        'equipe_sequencia' => 'Sequência da Equipe',
			'classificacao' => 'Classificacao',
			'data_cadastro' => 'Data Cadastro',
                        'id_paciente' => 'Id Paciente',
                        'ultima_atualizacao' => 'Ultima Atualização',
		);
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

		$criteria->compare('unidade',$this->unidade,true);
		$criteria->compare('competencia',$this->competencia,true);
		$criteria->compare('profissional_cns',$this->profissional_cns,true);
		$criteria->compare('profissional_cbo',$this->profissional_cbo,true);
		$criteria->compare('folha',$this->folha,true);
		$criteria->compare('sequencia',$this->sequencia,true);
		$criteria->compare('procedimento',$this->procedimento,true);
		$criteria->compare('paciente_cns',$this->paciente_cns,true);
		$criteria->compare('data_atendimento',$this->data_atendimento,true);
		$criteria->compare('cid',$this->cid,true);
                $criteria->compare('idade_paciente',$this->idade_paciente,true);
		$criteria->compare('quantidade',$this->quantidade,true);
		$criteria->compare('caracter_atendimento',$this->caracter_atendimento,true);
		$criteria->compare('numero_autorizacao',$this->numero_autorizacao,true);
		$criteria->compare('origem',$this->origem,true);
		$criteria->compare('competencia_movimento',$this->competencia_movimento,true);
		$criteria->compare('servico',$this->servico,true);
		$criteria->compare('equipe',$this->equipe,true);
                $criteria->compare('equipe_sequencia',$this->equipe_sequencia,true);
                $criteria->compare('equipe_area',$this->equipe_area,true);
                $criteria->compare('cnpj',$this->cnpj,true);
		$criteria->compare('classificacao',$this->classificacao,true);
		$criteria->compare('data_cadastro',$this->data_cadastro,true);
                $criteria->compare('ultima_atualizacao',$this->ultima_atualizacao,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getCriteriaPrimaryKey(){
            $criteria= new CDbCriteria;
            $criteria->condition="unidade=:unidade AND competencia=:comp AND profissional_cns=:cns AND profissional_cbo=:cbo AND folha=:folha AND sequencia=:seq";
            $criteria->params=array(':unidade'=>$this->unidade,':comp'=>$this->competencia,
                                    ':cns'=>$this->profissional_cns,':cbo'=>$this->profissional_cbo,
                                    ':folha'=>$this->folha,':seq'=>$this->sequencia);
            return $criteria;
        }
        
        public static function getCompetencias(){
            $sql="SELECT competencia FROM bpa_procedimento_realizado GROUP BY competencia;";
            $dbC=Yii::app()->db->createCommand($sql);
            $dbC->setFetchMode(PDO::FETCH_OBJ);
            $competencias=array();
            foreach ($dbC->queryAll() as $comp){
                $c=$comp->competencia;
                $competencias[$c]= substr($c, 4) .'/'.substr($c, 0, 4);
            }
            return $competencias;
        }
        
        public static function getCompetenciasMovimento(){
            $sql="SELECT competencia_movimento FROM bpa_procedimento_realizado GROUP BY competencia_movimento;";
            $dbC=Yii::app()->db->createCommand($sql);
            $dbC->setFetchMode(PDO::FETCH_OBJ);
            $competencias_movimento=array();
            foreach ($dbC->queryAll() as $comp){
                $c=$comp->competencia_movimento;
                $competencias_movimento[$c]= substr($c, 4) .'/'.substr($c, 0, 4);
            }
            return $competencias_movimento;
        }
}