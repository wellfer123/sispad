<?php

/**
 * This is the model class for table "Odontologo".
 *
 * The followings are the available columns in table 'Odontologo':
 * @property string $servidor_cpf
 * @property string $unidade_cnes
 * @property string $ativo
 * @property string $data_cadastro
 * @property string $data_desativacao
 */
class Odontologo extends CActiveRecord
{
        
        const CODIGO_PROFISSAO='717';
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
	 * @return Odontologo the static model class
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
		return 'odontologo';
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
			'odontologo_executa_procedimentos' => array(self::HAS_MANY, 'OdontologoExecutaProcedimento', 'odontologo_unidade_cnes'),
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

		return new CActiveDataProvider('Odontologo', array(
			'criteria'=>$criteria,
		));
	}
        
        
        public function getServidorUnidade(){
            return $this->servidor->nome.'/'.$this->unidade->nome;
        }
}