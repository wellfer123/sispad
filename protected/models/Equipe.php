<?php

/**
 * This is the model class for table "Equipe".
 *
 * The followings are the available columns in table 'Equipe':
 * @property integer $codigo_segmento
 * @property integer $codigo_area
 * @property integer $tipo
 * @property string $unidade_cnes
 * @property integer $codigo_microarea
 */
class Equipe extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Equipe the static model class
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
		return 'equipe';
	}

        public $cpf;
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo_area, tipo, unidade_cnes, codigo_microarea', 'required'),
			array('codigo_segmento, codigo_area, tipo, codigo_microarea', 'numerical', 'integerOnly'=>true),
			array('unidade_cnes', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('codigo_segmento, codigo_area, tipo, unidade_cnes, codigo_microarea', 'safe', 'on'=>'search'),
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
			'unidade' => array(self::BELONGS_TO, 'Unidade', 'unidade_cnes'),
                        'servidor'=>array(self::HAS_MANY,'Servidor','equipe_codigo_segmento'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'codigo_segmento' => 'Codigo Segmento',
			'codigo_area' => 'Codigo Area',
			'tipo' => 'Tipo',
			'unidade_cnes' => 'Unidade Cnes',
			'codigo_microarea' => 'Codigo Microarea',
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

		$criteria->compare('codigo_segmento',$this->codigo_segmento);

		$criteria->compare('codigo_area',$this->codigo_area);

		$criteria->compare('tipo',$this->tipo);

		$criteria->compare('unidade_cnes',$this->unidade_cnes,true);

		$criteria->compare('codigo_microarea',$this->codigo_microarea);

		return new CActiveDataProvider('Equipe', array(
			'criteria'=>$criteria,
		));
	}
}