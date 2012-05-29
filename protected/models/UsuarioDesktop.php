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
                        array('servidor_cpf','servidorExisteAplicacao', 'on'=>'create'),
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
                    'servidor'=>array(self::BELONGS_TO,'Servidor','servidor_cpf'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'servidor_cpf' => 'CPF do Usuário (servidor)',
			'token' => 'Token',
			'serial_aplicacao' => 'Serial da Aplicação',
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

		return new CActiveDataProvider('UsuarioDesktop', array(
			'criteria'=>$criteria,
		));
	}
        
        public function servidorExisteAplicacao($attribute, $params) {
         
         if($servid= UsuarioDesktop::model()->exists('servidor_cpf=:cpf AND serial_aplicacao=:serial', array(':cpf'=>$this->servidor_cpf,':serial'=>$this->serial_aplicacao))){
             $this->addError('servidor_cpf',"Servidor Já está cadastrado para usar a aplicação!");
             return false;
             }
         return true;
        }
        
        public function gerarToken(){
            $this->token=sha1($this->serial_aplicacao.$this->servidor_cpf.$this->usuario_sistema);
        }
        
        
        protected function beforeSave() {
            $this->gerarToken();
            return parent::beforeSave();
        }
        
        public function getServidor_cpf() {
            return $this->servidor_cpf;
        }

        public function getToken() {
            return $this->token;
        }

        public function getUsuario_sistema() {
            return $this->usuario_sistema;
        }

        public function getSerial_aplicacao() {
            return $this->serial_aplicacao;
        }

        public function setServidor_cpf($servidor_cpf) {
            $this->servidor_cpf = $servidor_cpf;
        }

        public function setToken($token) {
            $this->token = $token;
        }

        public function setUsuario_sistema($usuario_sistema) {
            $this->usuario_sistema = $usuario_sistema;
        }

        public function setSerial_aplicacao($serial_aplicacao) {
            $this->serial_aplicacao = $serial_aplicacao;
        }


}