<?php

/**
 * This is the model class for table "relatorio".
 *
 * The followings are the available columns in table 'relatorio':
 * @property integer $id
 * @property string $conteudo
 * @property string $data_envio
 * @property string $data_trabalho
 * @property integer $servidor_cpf
 */
class relatorio extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return relatorio the static model class
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
		return 'relatorio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('conteudo, data_envio', 'required'),
			array('servidor_cpf', 'numerical', 'integerOnly'=>true),
			array('data_trabalho', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, conteudo, data_envio, data_trabalho, servidor_cpf', 'safe', 'on'=>'search'),
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
			'id' => 'Id',
			'conteudo' => 'Conteudo',
			'data_envio' => 'Data Envio',
			'data_trabalho' => 'Data Trabalho',
			'servidor_cpf' => 'Servidor Cpf',
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

		$criteria->compare('conteudo',$this->conteudo,true);

		$criteria->compare('data_envio',$this->data_envio,true);

		$criteria->compare('data_trabalho',$this->data_trabalho,true);

		$criteria->compare('servidor_cpf',$this->servidor_cpf);

		return new CActiveDataProvider('relatorio', array(
			'criteria'=>$criteria,
		));
	}
}