<?php

/**
 * This is the model class for table "Departamento".
 *
 * The followings are the available columns in table 'Departamento':
 * @property string $id
 * @property string $nome
 * @property string $descricao
 * @property integer $unidade_cnes
 */
class Departamento extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Departamento the static model class
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
		return 'Departamento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, descricao', 'required'),
			array('unidade_cnes', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>10),
			array('nome', 'length', 'max'=>40),
			array('descricao', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nome, descricao, unidade_cnes', 'safe', 'on'=>'search'),
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
			'nome' => 'Nome',
			'descricao' => 'Descricao',
			'unidade_cnes' => 'Unidade Cnes',
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

		$criteria->compare('nome',$this->nome,true);

		$criteria->compare('descricao',$this->descricao,true);

		$criteria->compare('unidade_cnes',$this->unidade_cnes);

		return new CActiveDataProvider('Departamento', array(
			'criteria'=>$criteria,
		));
	}
}