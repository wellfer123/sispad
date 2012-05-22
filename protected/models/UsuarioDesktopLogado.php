<?php

/**
 * This is the model class for table "usuario_desktop_logado".
 *
 * The followings are the available columns in table 'usuario_desktop_logado':
 * @property string $usuario_desktop_cpf
 * @property string $usuario_token
 * @property string $usuario_aplicacao
 * @property string $data_hora
 */
class UsuarioDesktopLogado extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return usuario_desktop_logado the static model class
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
		return 'usuario_desktop_logado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('data_hora', 'required'),
			array('usuario_desktop_cpf', 'length', 'max'=>11),
			array('usuario_token, usuario_aplicacao', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('usuario_desktop_cpf, usuario_token, usuario_aplicacao, data_hora', 'safe', 'on'=>'search'),
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
			'usuario_desktop_cpf0' => array(self::BELONGS_TO, 'UsuarioDesktop', 'usuario_desktop_cpf'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'usuario_desktop_cpf' => 'Usuario Desktop Cpf',
			'usuario_token' => 'Usuario Token',
			'usuario_aplicacao' => 'Usuario Aplicacao',
			'data_hora' => 'Data Hora',
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

		$criteria->compare('usuario_desktop_cpf',$this->usuario_desktop_cpf,true);

		$criteria->compare('usuario_token',$this->usuario_token,true);

		$criteria->compare('usuario_aplicacao',$this->usuario_aplicacao,true);

		$criteria->compare('data_hora',$this->data_hora,true);

		return new CActiveDataProvider('usuario_desktop_logado', array(
			'criteria'=>$criteria,
		));
	}
}