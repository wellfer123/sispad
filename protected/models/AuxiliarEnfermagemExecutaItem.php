<?php

/**
 * This is the model class for table "auxiliar_enfermagem_executa_item".
 *
 * The followings are the available columns in table 'auxiliar_enfermagem_executa_item':
 * @property string $auxiliar_enfermagem_cpf
 * @property integer $item_id
 * @property string $auxiliar_enfermagem_unidade_cnes
 * @property integer $quantidade
 * @property integer $competencia
 */
class AuxiliarEnfermagemExecutaItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AuxiliarEnfermagemExecutaItem the static model class
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
		return 'auxiliar_enfermagem_executa_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('auxiliar_enfermagem_cpf, item_id, competencia', 'required'),
			array('item_id, quantidade, competencia', 'numerical', 'integerOnly'=>true),
			array('auxiliar_enfermagem_cpf', 'length', 'max'=>11),
			array('auxiliar_enfermagem_unidade_cnes', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('auxiliar_enfermagem_cpf, item_id, auxiliar_enfermagem_unidade_cnes, quantidade, competencia', 'safe', 'on'=>'search'),
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
			'item' => array(self::BELONGS_TO, 'Item', 'item_id'),
			'competencia0' => array(self::BELONGS_TO, 'Competencia', 'competencia'),
			'auxiliar_enfermagem_cpf0' => array(self::BELONGS_TO, 'AuxiliarEnfermagem', 'auxiliar_enfermagem_cpf'),
			'auxiliar_enfermagem_unidade_cnes0' => array(self::BELONGS_TO, 'AuxiliarEnfermagem', 'auxiliar_enfermagem_unidade_cnes'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'auxiliar_enfermagem_cpf' => 'Auxiliar Enfermagem Cpf',
			'item_id' => 'Item',
			'auxiliar_enfermagem_unidade_cnes' => 'Auxiliar Enfermagem Unidade Cnes',
			'quantidade' => 'Quantidade',
			'competencia' => 'Competencia',
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

		$criteria->compare('auxiliar_enfermagem_cpf',$this->auxiliar_enfermagem_cpf,true);

		$criteria->compare('item_id',$this->item_id);

		$criteria->compare('auxiliar_enfermagem_unidade_cnes',$this->auxiliar_enfermagem_unidade_cnes,true);

		$criteria->compare('quantidade',$this->quantidade);

		$criteria->compare('competencia',$this->competencia);

		return new CActiveDataProvider('AuxiliarEnfermagemExecutaItem', array(
			'criteria'=>$criteria,
		));
	}
}