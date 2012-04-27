<?php

/**
 * This is the model class for table "Endereco".
 *
 * The followings are the available columns in table 'Endereco':
 * @property integer $id
 * @property string $logradouro
 * @property integer $numero
 * @property string $complemento
 * @property string $bairro
 * @property integer $cidade_id
 * @property string $telefone
 * @property string $email
 */
class Endereco extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Endereco the static model class
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
		return 'Endereco';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('logradouro, numero, bairro', 'required'),
			array('numero, cidade_id', 'numerical', 'integerOnly'=>true),
			array('logradouro, bairro, email', 'length', 'max'=>30),
			array('complemento', 'length', 'max'=>20),
			array('telefone', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, logradouro, numero, complemento, bairro, cidade_id, telefone, email', 'safe', 'on'=>'search'),
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
			'servidors' => array(self::HAS_MANY, 'Servidor', 'endereco_id'),
                        'cidade'=>  array(self::BELONGS_TO,'Cidades','cidade_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'logradouro' => 'Logradouro',
			'numero' => 'Numero',
			'complemento' => 'Complemento',
			'bairro' => 'Bairro',
			'cidade_id' => 'Cidade',
			'telefone' => 'Telefone',
			'email' => 'Email',
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

		$criteria->compare('logradouro',$this->logradouro,true);

		$criteria->compare('numero',$this->numero);

		$criteria->compare('complemento',$this->complemento,true);

		$criteria->compare('bairro',$this->bairro,true);

		$criteria->compare('cidade_id',$this->cidade_id);

		$criteria->compare('telefone',$this->telefone,true);

		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider('Endereco', array(
			'criteria'=>$criteria,
		));
	}

        public function toString(){
            return $this->logradouro.', Nº'.$this->numero.' '.
                    $this->complemento."\nBairro ".$this->bairro.' CEP '.$this->cidade->cidade_nome;
        }
        
}