<?php

/**
 * This is the model class for table "total_frequencia".
 *
 * The followings are the available columns in table 'total_frequencia':
 * @property integer $ano
 * @property integer $mes
 * @property integer $quantidade
 * @property string $data_envio
 * @property string $servidor_cpf
 */
class TotalFrequencia extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return total_frequencia the static model class
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
		return 'total_frequencia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('servidor_cpf,ano,mes,quantidade', 'required'),
                        array('ano','numerical','min'=>2012, 'max'=>date('Y')+1),
                        array('mes','numerical','max'=>12,'min'=>1),
                        array('quantidade','numerical','max'=>25,'min'=>0),
			array('ano, mes, quantidade', 'numerical', 'integerOnly'=>true),
			array('servidor_cpf', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ano, mes, quantidade, data_envio, servidor_cpf', 'safe', 'on'=>'search'),
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
                    'servidor'=>array(self::BELONGS_TO,'Servidor','servidor_cpf')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ano' => 'Ano',
			'mes' => 'Mês',
			'quantidade' => 'Quantidade',
			'data_envio' => 'Data de Envio',
			'servidor_cpf' => 'Servidor',
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
                
                $criteria->

		$criteria->compare('ano',$this->ano,true);

		$criteria->compare('mes',$this->mes);

		$criteria->compare('quantidade',$this->quantidade,true);

		$criteria->compare('data_envio',$this->data_envio,true);

		$criteria->compare('servidor_cpf',$this->servidor_cpf,true);

		return new CActiveDataProvider('TotalFrequencia', array(
			'criteria'=>$criteria,
		));
	}
        
}