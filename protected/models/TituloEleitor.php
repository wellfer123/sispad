<?php

/**
 * This is the model class for table "Titulo_Eleitor".
 *
 * The followings are the available columns in table 'Titulo_Eleitor':
 * @property string $servidor_cpf
 * @property string $numero
 * @property string $zona
 * @property string $secao
 */
class TituloEleitor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Titulo_Eleitor the static model class
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
		return 'Titulo_Eleitor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('numero, zona, secao', 'required'),
			array('servidor_cpf', 'length', 'max'=>11),
			array('numero', 'length', 'max'=>20),
			array('zona, secao', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('servidor_cpf, numero, zona, secao', 'safe', 'on'=>'search'),
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
			'numero' => 'Numero',
			'zona' => 'Zona',
			'secao' => 'Secao',
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

		$criteria->compare('numero',$this->numero,true);

		$criteria->compare('zona',$this->zona,true);

		$criteria->compare('secao',$this->secao,true);

		return new CActiveDataProvider('Titulo_Eleitor', array(
			'criteria'=>$criteria,
		));
	}
}