<?php

/**
 * This is the model class for table "agente_saude_executa_procedimento".
 *
 * The followings are the available columns in table 'agente_saude_executa_procedimento':
 * @property string $agente_saude_cpf
 * @property string $procedimento_codigo
 * @property string $agente_saude_unidade_cnes
 * @property integer $quantidade
 * @property integer $competencia
 * @property integer $agente_saude_micro_area
 */
class AgenteSaudeExecutaProcedimento extends CActiveRecord
{
    
    
        /**
         * @var string unidade que  faz parte
         * @soap
         */
        public $agente_saude_unidade_cnes;
        
        /**
         * @var string cpf do servidor
         * @soap
         */
        public $agente_saude_cpf;
        
        /**
         * @var int numero da competencia 
         * @soap
         */
        public $competencia;
        
        /**
         * @var int quantidade de execução do procedimento
         * @soap
         */
        public $quantidade;
        
        /**
         * @var string codigo do procedimento executado
         * @soap
         */
        public $procedimento_codigo;
        
        /**
         * @var int microarea do agente
         * @soap
         */
        public $agente_saude_micro_area;
    
	/**
	 * Returns the static model of the specified AR class.
	 * @return agente_saude_executa_procedimento the static model class
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
		return 'agente_saude_executa_procedimento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('quantidade, competencia, agente_saude_micro_area', 'numerical', 'integerOnly'=>true),
			array('procedimento_codigo, agente_saude_unidade_cnes', 'length', 'max'=>10),
                        array('agente_saude_cpf', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('agente_saude_cpf, procedimento_codigo, agente_saude_unidade_cnes, quantidade, competencia, agente_saude_micro_area', 'safe', 'on'=>'search'),
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
			'agente_saude_cpf0' => array(self::BELONGS_TO, 'AgenteSaude', 'agente_saude_cpf'),
			'agente_saude_unidade_cnes0' => array(self::BELONGS_TO, 'AgenteSaude', 'agente_saude_unidade_cnes'),
			'procedimento_codigo0' => array(self::BELONGS_TO, 'Procedimento', 'procedimento_codigo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'agente_saude_cpf' => 'Agente Saude Cpf',
			'procedimento_codigo' => 'Procedimento Codigo',
			'agente_saude_unidade_cnes' => 'Agente Saude Unidade Cnes',
			'quantidade' => 'Quantidade',
			'competencia' => 'Competencia',
			'agente_saude_micro_area' => 'Agente Saude Micro Area',
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

		$criteria->compare('agente_saude_cpf',$this->agente_saude_cpf,true);

		$criteria->compare('procedimento_codigo',$this->procedimento_codigo,true);

		$criteria->compare('agente_saude_unidade_cnes',$this->agente_saude_unidade_cnes,true);

		$criteria->compare('quantidade',$this->quantidade);

		$criteria->compare('competencia',$this->competencia);

		$criteria->compare('agente_saude_micro_area',$this->agente_saude_micro_area);

		return new CActiveDataProvider('agente_saude_executa_procedimento', array(
			'criteria'=>$criteria,
		));
	}
        public function getAgente_saude_unidade_cnes() {
            return $this->agente_saude_unidade_cnes;
        }

        public function getAgente_saude_cpf() {
            return $this->agente_saude_cpf;
        }

        public function getCompetencia() {
            return $this->competencia;
        }

        public function getQuantidade() {
            return $this->quantidade;
        }

        public function getProcedimento_codigo() {
            return $this->procedimento_codigo;
        }

        public function getAgente_saude_micro_area() {
            return $this->agente_saude_micro_area;
        }

        public function setAgente_saude_unidade_cnes($agente_saude_unidade_cnes) {
            $this->agente_saude_unidade_cnes = $agente_saude_unidade_cnes;
        }

        public function setAgente_saude_cpf($agente_saude_cpf) {
            $this->agente_saude_cpf = $agente_saude_cpf;
        }

        public function setCompetencia($competencia) {
            $this->competencia = $competencia;
        }

        public function setQuantidade($quantidade) {
            $this->quantidade = $quantidade;
        }

        public function setProcedimento_codigo($procedimento_codigo) {
            $this->procedimento_codigo = $procedimento_codigo;
        }

        public function setAgente_saude_micro_area($agente_saude_micro_area) {
            $this->agente_saude_micro_area = $agente_saude_micro_area;
        }


}