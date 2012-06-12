<?php

/**
 * This is the model class for table "servidor_executa_procedimento".
 *
 * The followings are the available columns in table 'servidor_executa_procedimento':
 * @property string $servidor_cpf
 * @property string $procedimento_codigo
 * @property integer $quantidade
 * @property integer $competencia
 */
class ServidorExecutaProcedimento extends CActiveRecord
{
    
        /**
         * @var string cpf do servidor do procedimento
         * @soap
         */
        public $servidor_cpf;
        /**
         * @var string codigo do procedimento
         * @soap
         */
        public $procedimento_codigo;
        /**
         * @var integer quantidade de procedimentos executados naquela competencia
         * @soap
         */
        public $quantidade;
        /**
         * @var integer competencia
         * @soap
         */
        public $competencia;
        
        /**
         * @var string unidade que  faz parte
         * @soap
         */
        public $unidade_cnes;
	/**
	 * Returns the static model of the specified AR class.
	 * @return servidor_executa_procedimento the static model class
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
		return 'servidor_executa_procedimento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('quantidade, competencia', 'numerical', 'integerOnly'=>true),
			array('servidor_cpf', 'length', 'max'=>11),
			array('procedimento_codigo', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('servidor_cpf, procedimento_codigo, quantidade, competencia', 'safe', 'on'=>'search'),
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
			'servidor_cpf' => 'Servidor Cpf',
			'procedimento_codigo' => 'Procedimento Codigo',
			'quantidade' => 'Quantidade',
			'competencia' => 'Competencia',
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

		$criteria->compare('servidor_cpf',$this->servidor_cpf,true);

		$criteria->compare('procedimento_codigo',$this->procedimento_codigo,true);

		$criteria->compare('quantidade',$this->quantidade);

		$criteria->compare('competencia',$this->competencia);

		return new CActiveDataProvider('servidor_executa_procedimento', array(
			'criteria'=>$criteria,
		));
	}
        public function getServidor_cpf() {
            return $this->servidor_cpf;
        }

        public function getProcedimento_codigo() {
            return $this->procedimento_codigo;
        }

        public function getQuantidade() {
            return $this->quantidade;
        }

        public function getCompetencia() {
            return $this->competencia;
        }

        public function setServidor_cpf($servidor_cpf) {
            $this->servidor_cpf = $servidor_cpf;
        }

        public function setProcedimento_codigo($procedimento_codigo) {
            $this->procedimento_codigo = $procedimento_codigo;
        }

        public function setQuantidade($quantidade) {
            $this->quantidade = $quantidade;
        }

        public function setCompetencia($competencia) {
            $this->competencia = $competencia;
        }

        public function getUnidade_cnes() {
            return $this->unidade_cnes;
        }
        public function setUnidade_cnes($unidade_cnes) {
            $this->unidade_cnes = $unidade_cnes;
        }



}