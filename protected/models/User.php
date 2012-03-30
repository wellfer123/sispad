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
 */
class User extends CActiveRecord
{
    
    
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
		return 'User';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
        
        /*public function servidorExistente($attribute, $params){
            
            $servidor= Servidor::model()->findb
        }*/
        
     public function servidorExiste($attribute, $params) {
         
         $servid= Servidor::model()->findByPk($this->servidor_cpf);
         if($servid==null){
             $this->addError('servidor_cpf',"Servidor não existe em nosso sistema!");
             return false;
             }
         return true;
     }

     public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('password, email, username, servidor_cpf', 'required', 'on'=>'register'),
                        array('password,username' ,'required', 'on'=>'login'),
			array('password', 'length', 'max'=>15),
                        array('email', 'email'),
                        array('servidor_cpf','servidorExiste', 'on'=>'register'),
			array('email, username', 'length', 'max'=>30),
			array('servidor_cpf', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, password, email, username, servidor_cpf', 'safe', 'on'=>'search'),
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
			'username' => 'Nome de usuário',
			'servidor_cpf' => 'CPF',
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

		$criteria->compare('id',$this->id);

		$criteria->compare('password',$this->password,true);

		$criteria->compare('email',$this->email,true);

		$criteria->compare('username',$this->username,true);

		$criteria->compare('servidor_cpf',$this->servidor_cpf,true);

		return new CActiveDataProvider('User', array(
			'criteria'=>$criteria,
		));
	}
        
        public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password','Usuário ou senha incorretos.');
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=3600*24; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}