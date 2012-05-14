<?php

/**
 * This is the model class for table "enfermeiro_executa_procedimento".
 *
 * The followings are the available columns in table 'enfermeiro_executa_procedimento':
 * @property string $enfermeiro_cpf
 * @property string $procedimento_codigo
 * @property string $enfermeiro_unidade_cnes
 * @property integer $quantidade
 * @property integer $competencia
 */
class EnfermeiroExecutaProcedimento extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return enfermeiro_executa_procedimento the static model class
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
		return 'enfermeiro_executa_procedimento';
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
			array('enfermeiro_cpf, procedimento_codigo, enfermeiro_unidade_cnes', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('enfermeiro_cpf, procedimento_codigo, enfermeiro_unidade_cnes, quantidade, competencia', 'safe', 'on'=>'search'),
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
			'enfermeiro_cpf0' => array(self::BELONGS_TO, 'Enfermeiro', 'enfermeiro_cpf'),
			'enfermeiro_unidade_cnes0' => array(self::BELONGS_TO, 'Enfermeiro', 'enfermeiro_unidade_cnes'),
			'procedimento_codigo0' => array(self::BELONGS_TO, 'Procedimento', 'procedimento_codigo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'enfermeiro_cpf' => 'Enfermeiro Cpf',
			'procedimento_codigo' => 'Procedimento Codigo',
			'enfermeiro_unidade_cnes' => 'Enfermeiro Unidade Cnes',
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

		$criteria->compare('enfermeiro_cpf',$this->enfermeiro_cpf,true);

		$criteria->compare('procedimento_codigo',$this->procedimento_codigo,true);

		$criteria->compare('enfermeiro_unidade_cnes',$this->enfermeiro_unidade_cnes,true);

		$criteria->compare('quantidade',$this->quantidade);

		$criteria->compare('competencia',$this->competencia);

		return new CActiveDataProvider('enfermeiro_executa_procedimento', array(
			'criteria'=>$criteria,
		));
	}
}