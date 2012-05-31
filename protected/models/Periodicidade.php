<?php

/**
 * This is the model class for table "Periodicidade".
 *
 * The followings are the available columns in table 'Periodicidade':
 * @property integer $id
 * @property string $nome
 * @property integer $valor_dias
 */
class Periodicidade extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Periodicidade the static model class
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
		return 'periodicidade';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('valor_dias', 'numerical', 'integerOnly'=>true),
			array('nome', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nome, valor_dias', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array('meta'=>array(self::HAS_MANY,'meta','periodicidade_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'nome' => 'Nome',
			'valor_dias' => 'Valor Dias',
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

		$criteria->compare('nome',$this->nome,true);

		$criteria->compare('valor_dias',$this->valor_dias);

		return new CActiveDataProvider('Periodicidade', array(
			'criteria'=>$criteria,
		));
	}
}