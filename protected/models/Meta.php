<?php

/**
 * This is the model class for table "Meta".
 *
 * The followings are the available columns in table 'Meta':
 * @property integer $id
 * @property string $nome
 * @property integer $periodicidade_id
 * @property string $tipo
 * @property integer $valor
 * @property integer $percentagem
 * @property integer $item_id
 * @property integer $indicador_id
 */
class Meta extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Meta the static model class
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
		return 'Meta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome, periodicidade_id, tipo, valor', 'required'),
			array('periodicidade_id, valor, percentagem,indicador_id', 'numerical', 'integerOnly'=>true),
			array('nome', 'length', 'max'=>40),
			array('tipo', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nome, periodicidade_id, tipo, valor, percentagem, indicador_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array('indicador'=>array(self::BELONGS_TO,'indicador','indicador_id'),
                             'item'=>array(self::HAS_MANY,'item','meta_id'),
                             'periodicidade'=>array(self::BELONGS_TO,'periodicidade','periodicidade_id')
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
			'periodicidade_id' => 'Periodicidade',
			'tipo' => 'Tipo',
			'valor' => 'Valor',
			'percentagem' => 'Percentagem',
			'item_id' => 'Item',
			'indicador_id' => 'Indicador',
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

		$criteria->compare('id',$this->id);

		$criteria->compare('nome',$this->nome,true);

		$criteria->compare('periodicidade_id',$this->periodicidade_id);

		$criteria->compare('tipo',$this->tipo,true);

		$criteria->compare('valor',$this->valor);

		$criteria->compare('percentagem',$this->percentagem);

		$criteria->compare('item_id',$this->item_id);

		$criteria->compare('indicador_id',$this->indicador_id);

		return new CActiveDataProvider('Meta', array(
			'criteria'=>$criteria,
		));
	}

        public function searchIndicadorId($indicador_id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('indicador_id',$indicador_id);



		return new CActiveDataProvider('Meta', array(
			'criteria'=>$criteria,
		));
	}
}