<?php

/**
 * This is the model class for table "Regionais".
 *
 * The followings are the available columns in table 'Regionais':
 * @property string $id
 * @property string $regional_nome
 * @property string $regional_codigo_ibge
 * @property string $regional_estado
 */
class Regionais extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Regionais the static model class
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
		return 'Regionais';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('regional_estado', 'required'),
			array('regional_nome', 'length', 'max'=>50),
			array('regional_codigo_ibge', 'length', 'max'=>4),
			array('regional_estado', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, regional_nome, regional_codigo_ibge, regional_estado', 'safe', 'on'=>'search'),
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
                    'cidades'=>array(self::HAS_MANY,'Cidades','cidade_id_regional')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'regional_nome' => 'Regional Nome',
			'regional_codigo_ibge' => 'Regional Codigo Ibge',
			'regional_estado' => 'Regional Estado',
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

		$criteria->compare('regional_nome',$this->regional_nome,true);

		$criteria->compare('regional_codigo_ibge',$this->regional_codigo_ibge,true);

		$criteria->compare('regional_estado',$this->regional_estado,true);

		return new CActiveDataProvider('Regionais', array(
			'criteria'=>$criteria,
		));
	}
}