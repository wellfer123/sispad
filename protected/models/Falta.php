<?php

/**
 * This is the model class for table "Falta".
 *
 * The followings are the available columns in table 'Falta':
 * @property string $dia
 * @property string $mes
 * @property string $servidor_cpf
 * @property string $data_envio
 * @property string $motivo
 * @property string $motivo_id
 * @property string $ano
 */
class Falta extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Falta the static model class
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
		return 'Falta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('servidor_cpf', 'length', 'max'=>11),
                       // array('mes','ano','dia','required'),
			array('motivo', 'length', 'max'=>45),
			array('motivo_id', 'length', 'max'=>10),
			//array('data_envio', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('dia, mes, servidor_cpf, data_envio, motivo, motivo_id, ano', 'safe', 'on'=>'search'),
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
                        'servidor'=>array(self::BELONGS_TO,'Servidor','servidor_cpf'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'dia' => 'Dia',
			'mes' => 'Mes',
			'servidor_cpf' => 'Servidor Cpf',
			'data_envio' => 'Data Envio',
			'motivo' => 'Motivo',
			'motivo_id' => 'Motivo',
			'ano' => 'Ano',
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

		$criteria->compare('dia',$this->dia,true);

		$criteria->compare('mes',$this->mes,true);

		$criteria->compare('servidor_cpf',$this->servidor_cpf,true);

		$criteria->compare('data_envio',$this->data_envio,true);

		$criteria->compare('motivo',$this->motivo,true);

		$criteria->compare('motivo_id',$this->motivo_id,true);

		$criteria->compare('ano',$this->ano,true);

		return new CActiveDataProvider('Falta', array(
			'criteria'=>$criteria,
		));
	}
}