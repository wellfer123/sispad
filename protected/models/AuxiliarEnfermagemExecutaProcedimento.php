<?php

/**
 * This is the model class for table "auxiliar_enfermagem_executa_procedimento".
 *
 * The followings are the available columns in table 'auxiliar_enfermagem_executa_procedimento':
 * @property string $auxiliar_enfermagem_cpf
 * @property string $procedimento_codigo
 * @property string $auxiliar_enfermagem_unidade_cnes
 * @property integer $quantidade
 * @property integer $competencia
 */
class AuxiliarEnfermagemExecutaProcedimento extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AuxiliarEnfermagemExecutaProcedimento the static model class
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
		return 'auxiliar_enfermagem_executa_procedimento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('auxiliar_enfermagem_cpf', 'required'),
			array('quantidade, competencia', 'numerical', 'integerOnly'=>true),
			array('auxiliar_enfermagem_cpf', 'length', 'max'=>11),
			array('procedimento_codigo, auxiliar_enfermagem_unidade_cnes', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('auxiliar_enfermagem_cpf, procedimento_codigo, auxiliar_enfermagem_unidade_cnes, quantidade, competencia', 'safe', 'on'=>'search'),
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
			'auxiliar_enfermagem_cpf0' => array(self::BELONGS_TO, 'AuxiliarEnfermagem', 'auxiliar_enfermagem_cpf'),
			'auxiliar_enfermagem_unidade_cnes0' => array(self::BELONGS_TO, 'AuxiliarEnfermagem', 'auxiliar_enfermagem_unidade_cnes'),
			'procedimento_codigo0' => array(self::BELONGS_TO, 'Procedimento', 'procedimento_codigo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'auxiliar_enfermagem_cpf' => 'Auxiliar Enfermagem Cpf',
			'procedimento_codigo' => 'Procedimento Codigo',
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

		$criteria->compare('procedimento_codigo',$this->procedimento_codigo,true);

		$criteria->compare('auxiliar_enfermagem_unidade_cnes',$this->auxiliar_enfermagem_unidade_cnes,true);

		$criteria->compare('quantidade',$this->quantidade);

		$criteria->compare('competencia',$this->competencia);

		return new CActiveDataProvider('auxiliar_enfermagem_executa_procedimento', array(
			'criteria'=>$criteria,
		));
	}
}