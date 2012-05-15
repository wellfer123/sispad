<?php

/**
 * This is the model class for table "Usuario_desktop".
 *
 * The followings are the available columns in table 'Usuario_desktop':
 * @property string $servidor_cpf
 * @property string $token
 * @property string $serial_aplicacao
 */
class UsuarioDesktop extends CActiveRecord
{
    
        /**
         * @var string cpf do servidor
         * @soap
         */
        public $servidor_cpf;
        
        /**
         * @var string token para a sua aplicacao
         * @soap
         */
        public $token;
        
        /**
         * @var string usuário no sistema
         * @soap
         */
        public $usuario_sistema;
        
        /**
         * @var string
         * @soap
         */
        public $serial_aplicacao;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @return Usuario_desktop the static model class
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
		return 'usuario_desktop';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('servidor_cpf, token, serial_aplicacao', 'required'),
			array('servidor_cpf', 'length', 'max'=>11),
			array('token, serial_aplicacao', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('servidor_cpf, token, serial_aplicacao', 'safe', 'on'=>'search'),
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
			'token' => 'Token',
			'serial_aplicacao' => 'Serial Aplicacao',
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

		$criteria->compare('token',$this->token,true);

		$criteria->compare('serial_aplicacao',$this->serial_aplicacao,true);

		return new CActiveDataProvider('Usuario_desktop', array(
			'criteria'=>$criteria,
		));
	}
}