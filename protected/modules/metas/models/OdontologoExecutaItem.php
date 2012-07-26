<?php

/**
 * This is the model class for table "odontologo_executa_item".
 *
 * The followings are the available columns in table 'odontologo_executa_item':
 * @property string $odontologo_cpf
 * @property integer $item_id
 * @property string $odontologo_unidade_cnes
 * @property integer $quantidade
 * @property integer $competencia
 */
class OdontologoExecutaItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return OdontologoExecutaItem the static model class
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
		return 'odontologo_executa_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('odontologo_cpf, competencia,odontologo_unidade_cnes,item_id,quantidade', 'required','on'=>'create'),
                        array('odontologo_cpf, competencia,odontologo_unidade_cnes', 'required','on'=>'valTemp'),
                        array('item_id, quantidade', 'safe', 'on'=>'valTemp'),
			array('item_id, quantidade, competencia', 'numerical', 'integerOnly'=>true),
			array('odontologo_cpf', 'length', 'max'=>11),
                        array('quantidade', 'length', 'min'=>1,'max'=>11),
			array('odontologo_unidade_cnes', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('odontologo_cpf, item_id, odontologo_unidade_cnes, quantidade, competencia', 'safe', 'on'=>'search'),
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
			'competencia' => array(self::BELONGS_TO, 'Competencia', 'competencia'),
			'odontologo' => array(self::BELONGS_TO, 'Odontologo', 'odontologo_cpf,odontologo_unidade_cnes'),
			'unidade' => array(self::BELONGS_TO, 'Unidade', 'odontologo_unidade_cnes'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'odontologo_cpf' => 'Odontologo Cpf',
			'item_id' => 'Item',
			'odontologo_unidade_cnes' => 'Odontologo Unidade Cnes',
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

		$criteria->compare('odontologo_cpf',$this->odontologo_cpf,true);

		$criteria->compare('item_id',$this->item_id);

		$criteria->compare('odontologo_unidade_cnes',$this->odontologo_unidade_cnes,true);

		$criteria->compare('quantidade',$this->quantidade);

		$criteria->compare('competencia',$this->competencia);

		return new CActiveDataProvider('OdontologoExecutaItem', array(
			'criteria'=>$criteria,
		));
	}
}