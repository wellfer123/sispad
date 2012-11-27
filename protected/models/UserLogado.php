<?php

/**
 * This is the model class for table "user_logado".
 *
 * The followings are the available columns in table 'user_logado':
 * @property integer $user_id
 * @property string $user_username
 * @property string $token
 * @property string $data_hora
 */
class UserLogado extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserLogado the static model class
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
		return 'user_logado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, user_username, token', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('user_username', 'length', 'max'=>30),
			array('token', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, user_username, token, data_hora', 'safe', 'on'=>'search'),
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
			'user_id' => 'Id do usuarioI',
			'user_username' => 'Nome do usuário',
			'token' => 'Token',
			'data_hora' => 'Data/Hora',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_username',$this->user_username,true);
		$criteria->compare('token',$this->token,true);
		$criteria->compare('data_hora',$this->data_hora,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function isValideToken(){
            $dia_hora=ParserDate::separarDataEHora($this->data_hora);
            if( $dia_hora != null){
                //calcula a diferença entre data/hora de login com a atual
                
                $horas= ParserDate::calculeDiferencaData($dia_hora[1], ParserDate::inverteDataEnToPt( $dia_hora[0]), Date('h:i:s'), Date('d/m/Y'));
                Yii::log($horas);
                if ($horas != null ? $horas<= 1 : false){
                    return true;
                }
            }
            return false;
        }
}