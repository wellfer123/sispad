<?php

/**
 * 
 * feel free to mod this Class
 *
 */
class User extends CActiveRecord 
{
	private $_identity;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		// DO NOT CHANGE
		return 'user';//Yii::app()->controller->module->tableUser;

		// or use your known table name like
		// return 'TableUser';
	}

	public function rules()
	{
		return array(
                    array('username','required','on'=>'login'),
                    array('password','required','on'=>'login'),
                );
	}

	public function relations()
	{
		return array();
	}

	public function attributeLabels()
	{
		return array();
	}



        public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password','Incorrect username or password.');
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
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