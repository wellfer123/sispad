<?php

/**
 * This is the model class for table "User".
 *
 * The followings are the available columns in table 'User':
 * @property integer $id
 * @property string $password
 * @property string $email
 * @property string $username
 * @property string $servidor_cpf
 * @property string $ativo
 */
class User extends CActiveRecord
{
    
    
    
        const ATIVO=1;
        const DESATIVO=0;
        
        private $_identity;
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
        
        /*public function servidorExistente($attribute, $params){
            
            $servidor= Servidor::model()->findb
        }*/
        
     

     public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('password, email, username, servidor_cpf', 'required', 'on'=>'register'),
                        array('password,username' ,'required', 'on'=>'login'),
			array('password', 'length', 'max'=>32),
                        array('email', 'email', 'on'=>'register'),
			array('email, username', 'length', 'max'=>30, 'on'=>'register'),
                        array('servidor_cpf','servidorExiste', 'on'=>'register'),
			array('servidor_cpf', 'servidorIsUser', 'on'=>'register'),
                        array('username', 'usernameExiste', 'on'=>'register'),
			array('email', 'emailExiste', 'on'=>'register'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('email, username, servidor_cpf', 'safe', 'on'=>'search'),
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
			'servidor' => array(self::BELONGS_TO, 'Servidor', 'servidor_cpf'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Código',
			'password' => 'Senha',
			'email' => 'E-mail',
			'username' => 'Nome do usuário',
			'servidor_cpf' => 'CPF',
                        'ativo'=>'Ativo',
		);
	}
        
        public function labelStatus(){
            if($this->ativo== User::ATIVO){
                return 'ATIVO';
            }
            else if($this->ativo==User::DESATIVO){
                return 'DESATIVO';
            }
            return 'DESCONHECIDO';
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

		$criteria->compare('email',$this->email,true);

		$criteria->compare('username',$this->username,true);

		$criteria->compare('servidor_cpf',$this->servidor_cpf,true);

		return new CActiveDataProvider('User', array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                                      'pageSize'=>20
                        )
		));
	}
        
        public function login()
	{
		if($this->_identity===null)
		{
                        
			$this->_identity=new UserIdentity($this->username,$this->password);
                        //autentica o usuário
			$this->_identity->authenticate();
		}
                //o usuário está tem acesso ao sistema
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=1200; // 20 minutes
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
                //o usuário errou o nome
                else if($this->_identity->errorCode===UserIdentity::ERROR_USERNAME_INVALID){
                        $this->addError('username','Usuário Incorreto.');                
                        
                        }
                //o usuário errou a senha
                else if($this->_identity->errorCode===UserIdentity::ERROR_PASSWORD_INVALID){
                        $this->addError('password','Senha incorreta.'.md5($this->_identity->password));                
                        
                        }
                else if($this->_identity->errorCode===UserIdentity::ERROR_USER_INACTIVE){
                        $this->addError('username','Usuário desativado.');                
                        
                        }
                else if($this->_identity->errorCode===UserIdentity::ERROR_UNKNOWN_IDENTITY){
                        $this->addError('username','Usuário inexistente.');                
                        
                        }
		else
			return false;
	}
        
        public function servidorExiste($attribute, $params) {
         
         $servid= Servidor::model()->findByPk($this->servidor_cpf);
         if($servid==null){
             $this->addError('servidor_cpf',"Servidor não existe em nosso sistema!");
             return false;
             }
         return true;
        }
        
        public function usernameExiste($attribute, $params) {
         
         $user= $this->model()->findByAttributes(array('username'=>$this->username));
         if($user!=null){
             $this->addError('username',"Usuário com esse nome já existe!");
             return false;
             }
         return true;
        }
        
        public function emailExiste($attribute, $params) {
         
         $user= $this->model()->findByAttributes(array('email'=>$this->email));
         if($user!=null){
             $this->addError('email',"Usuário com esse email já existe!");
             return false;
             }
         return true;
        }
        
        public function servidorIsUser($attribute, $params) {
         
         $user= $this->model()->findByAttributes(array('servidor_cpf'=>$this->servidor_cpf));
         if($user!=null){
             $this->addError('servidor_cpf',"Este servidor já está cadastrado como usuário em nosso sistema!");
             return false;
             }
         return true;
        }
        

        public function criptografarPassword(){
           $this->password=md5($this->password); 
        }
        
}