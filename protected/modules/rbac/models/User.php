<?php
//Yii::import('protected.models.Servidor');
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
		return array(
                    'servidor'=>array(self::BELONGS_TO, 'servidor', 'servidor_cpf'),
                );
	}

	public function attributeLabels()
	{
		return array();
	}

}