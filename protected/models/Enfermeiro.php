<?php

/**
 * This is the model class for table "Enfermeiro".
 *
 * The followings are the available columns in table 'Enfermeiro':
 * @property string $servidor_cpf
 * @property string $unidade_cnes
 * @property string $ativo
 * @property string $data_cadastro
 * @property string $data_desativacao
 */
class Enfermeiro extends CActiveRecord
{
        const CODIGO_PROFISSAO='532';
        const ATIVO=1;
        const DESATIVO=0;
        
        /**
         * @var string unidade que  faz parte
         * @soap
         */
        public $unidade_cnes;
        
        /**
         * @var string cpf do servidor
         * @soap
         */
        public $servidor_cpf;
        
        /**
         * @var string ativo: sim(1) não(0) 
         * @soap
         */
        public $ativo;
        
        /**
         * @var date data de cadastro
         * @soap
         */
        public $data_cadastro;
        
        /**
         * @var date data de desativacao
         * @soap
         */
        public $data_desativacao;
        
        
	/**
	 * Returns the static model of the specified AR class.
	 * @return Enfermeiro the static model class
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
		return 'enfermeiro';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('data_cadastro', 'required'),
			array('servidor_cpf', 'length', 'max'=>11),
                        array('unidade_cnes', 'length', 'max'=>10),
			array('ativo', 'length', 'max'=>1),
			array('data_desativacao', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('servidor_cpf, unidade_cnes, ativo, data_cadastro, data_desativacao', 'safe', 'on'=>'search'),
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
			'enfermeiro_executa_procedimentos' => array(self::HAS_MANY, 'EnfermeiroExecutaProcedimento', 'enfermeiro_unidade_cnes'),
                        'servidor'=>array(self::BELONGS_TO,'Servidor','servidor_cpf'),
                        'unidade'=>array(self::BELONGS_TO,'Unidade','unidade_cnes')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'servidor_cpf' => 'Servidor Cpf',
			'unidade_cnes' => 'Unidade Cnes',
			'ativo' => 'Ativo',
			'data_cadastro' => 'Data Cadastro',
			'data_desativacao' => 'Data Desativacao',
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

		$criteria->compare('unidade_cnes',$this->unidade_cnes,true);

		$criteria->compare('ativo',$this->ativo,true);

		$criteria->compare('data_cadastro',$this->data_cadastro,true);

		$criteria->compare('data_desativacao',$this->data_desativacao,true);

		return new CActiveDataProvider('Enfermeiro', array(
			'criteria'=>$criteria,
		));
	}
        
        public function getServidorUnidade(){
            return $this->servidor->nome.'/'.$this->unidade->nome;
        }
        
        public function getUnidade_cnes() {
            return $this->unidade_cnes;
        }

        public function getServidor_cpf() {
            return $this->servidor_cpf;
        }

        public function getAtivo() {
            return $this->ativo;
        }

        public function getData_cadastro() {
            return $this->data_cadastro;
        }

        public function getData_desativacao() {
            return $this->data_desativacao;
        }

        public function setUnidade_cnes($unidade_cnes) {
            $this->unidade_cnes = $unidade_cnes;
        }

        public function setServidor_cpf($servidor_cpf) {
            $this->servidor_cpf = $servidor_cpf;
        }

        public function setAtivo($ativo) {
            $this->ativo = $ativo;
        }

        public function setData_cadastro($data_cadastro) {
            $this->data_cadastro = $data_cadastro;
        }

        public function setData_desativacao($data_desativacao) {
            $this->data_desativacao = $data_desativacao;
        }


}