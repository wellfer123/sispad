<?php

/**
 * This is the model class for table "Setor".
 *
 * The followings are the available columns in table 'Setor':
 * @property string $id
 * @property string $nome
 * @property string $descricao
 * @property integer $departamento_id
 */
class Setor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Setor the static model class
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
		return 'Setor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('descricao', 'required'),
			array('departamento_id', 'numerical', 'integerOnly'=>true),
			array('nome', 'length', 'max'=>40),
			array('descricao', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(' nome, descricao', 'safe', 'on'=>'search'),
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
                    'departamento'=>array(self::BELONGS_TO,'Departamento','departamento_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Código',
			'nome' => 'Nome',
			'descricao' => 'Descricao',
			'departamento_id' => 'Departamento',
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

		$criteria->compare('departamento_id',$this->departamento_id);

		return new CActiveDataProvider('Setor', array(
			'criteria'=>$criteria,
		));
	}
}