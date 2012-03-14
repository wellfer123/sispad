<?php

/**
 * This is the model class for table "Cidades".
 *
 * The followings are the available columns in table 'Cidades':
 * @property string $id
 * @property string $cidade_nome
 * @property string $cidade_codigo_ibge
 * @property string $cidade_id_estado
 * @property string $cidade_id_regional
 * @property string $cidade_codigo_estado_ibge
 */
class Cidades extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cidades the static model class
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
		return 'Cidades';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cidade_codigo_estado_ibge', 'required'),
			array('cidade_nome', 'length', 'max'=>50),
			array('cidade_codigo_ibge, cidade_id_estado, cidade_id_regional', 'length', 'max'=>10),
			array('cidade_codigo_estado_ibge', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cidade_nome, cidade_codigo_ibge, cidade_id_estado, cidade_id_regional, cidade_codigo_estado_ibge', 'safe', 'on'=>'search'),
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
                    'unidades'=>array(self::HAS_MANY,'Unidade','cidade_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'cidade_nome' => 'Cidade Nome',
			'cidade_codigo_ibge' => 'Cidade Codigo Ibge',
			'cidade_id_estado' => 'Cidade Id Estado',
			'cidade_id_regional' => 'Cidade Id Regional',
			'cidade_codigo_estado_ibge' => 'Cidade Codigo Estado Ibge',
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

		$criteria->compare('cidade_nome',$this->cidade_nome,true);

		$criteria->compare('cidade_codigo_ibge',$this->cidade_codigo_ibge,true);

		$criteria->compare('cidade_id_estado',$this->cidade_id_estado,true);

		$criteria->compare('cidade_id_regional',$this->cidade_id_regional,true);

		$criteria->compare('cidade_codigo_estado_ibge',$this->cidade_codigo_estado_ibge,true);

		return new CActiveDataProvider('Cidades', array(
			'criteria'=>$criteria,
		));
	}
}