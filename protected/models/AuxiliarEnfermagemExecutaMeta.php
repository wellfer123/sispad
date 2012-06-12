<?php

/**
 * This is the model class for table "auxiliar_enfermagem_executa_meta".
 *
 * The followings are the available columns in table 'auxiliar_enfermagem_executa_meta':
 * @property string $auxiliar_enfermagem_cpf
 * @property string $unidade_cnes
 * @property integer $meta_id
 * @property integer $total
 * @property string $data_inicio
 * @property string $data_fim
 */
class AuxiliarEnfermagemExecutaMeta extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AuxiliarEnfermagemExecutaMeta the static model class
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
		return 'auxiliar_enfermagem_executa_meta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('meta_id, total', 'numerical', 'integerOnly'=>true),
			array('auxiliar_enfermagem_cpf', 'length', 'max'=>11),
			array('unidade_cnes', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('auxiliar_enfermagem_cpf, unidade_cnes, meta_id, total, data_inicio, data_fim', 'safe', 'on'=>'search'),
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
			'auxiliar_enfermagem_cpf' => 'Auxiliar Enfermagem Cpf',
			'unidade_cnes' => 'Unidade Cnes',
			'meta_id' => 'Meta',
			'total' => 'Total',
			'data_inicio' => 'Data Inicio',
			'data_fim' => 'Data Fim',
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

		$criteria->compare('unidade_cnes',$this->unidade_cnes,true);

		$criteria->compare('meta_id',$this->meta_id);

		$criteria->compare('total',$this->total);

		$criteria->compare('data_inicio',$this->data_inicio,true);

		$criteria->compare('data_fim',$this->data_fim,true);

		return new CActiveDataProvider('auxiliar_enfermagem_executa_meta', array(
			'criteria'=>$criteria,
		));
	}
}