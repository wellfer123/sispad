<?php

/**
 * This is the model class for table "odontologo_executa_procedimento".
 *
 * The followings are the available columns in table 'odontologo_executa_procedimento':
 * @property string $odontologo_cpf
 * @property string $procedimento_codigo
 * @property string $odontologo_unidade_cnes
 * @property integer $quantidade
 * @property integer $competencia
 */
class OdontologoExecutaProcedimento extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return odontologo_executa_procedimento the static model class
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
		return 'odontologo_executa_procedimento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('quantidade, competencia', 'numerical', 'integerOnly'=>true),
			array('odontologo_cpf, procedimento_codigo, odontologo_unidade_cnes', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('odontologo_cpf, procedimento_codigo, odontologo_unidade_cnes, quantidade, competencia', 'safe', 'on'=>'search'),
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
			'odontologo_cpf0' => array(self::BELONGS_TO, 'Odontologo', 'odontologo_cpf'),
			'odontologo_unidade_cnes0' => array(self::BELONGS_TO, 'Odontologo', 'odontologo_unidade_cnes'),
			'procedimento_codigo0' => array(self::BELONGS_TO, 'Procedimento', 'procedimento_codigo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'odontologo_cpf' => 'Odontologo Cpf',
			'procedimento_codigo' => 'Procedimento Codigo',
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

		$criteria->compare('procedimento_codigo',$this->procedimento_codigo,true);

		$criteria->compare('odontologo_unidade_cnes',$this->odontologo_unidade_cnes,true);

		$criteria->compare('quantidade',$this->quantidade);

		$criteria->compare('competencia',$this->competencia);

		return new CActiveDataProvider('odontologo_executa_procedimento', array(
			'criteria'=>$criteria,
		));
	}
}