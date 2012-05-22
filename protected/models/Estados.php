<?php

/**
 * This is the model class for table "Estados".
 *
 * The followings are the available columns in table 'Estados':
 * @property string $id
 * @property string $estado_nome
 * @property string $estado_sigla
 * @property string $estado_codigo_ibge
 */
class Estados extends CActiveRecord




{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Estados the static model class
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
		return 'Estados';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('estado_nome', 'length', 'max'=>30),
			array('estado_sigla, estado_codigo_ibge', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, estado_nome, estado_sigla, estado_codigo_ibge', 'safe', 'on'=>'search'),
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
			'estado_nome' => 'Estado Nome',
			'estado_sigla' => 'Estado Sigla',
			'estado_codigo_ibge' => 'Estado Codigo Ibge',
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

		$criteria->compare('id',$this->id,true);

		$criteria->compare('estado_nome',$this->estado_nome,true);

		$criteria->compare('estado_sigla',$this->estado_sigla,true);

		$criteria->compare('estado_codigo_ibge',$this->estado_codigo_ibge,true);

		return new CActiveDataProvider('Estados', array(
			'criteria'=>$criteria,
		));
	}
}