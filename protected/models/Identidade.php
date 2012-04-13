<?php

/**
 * This is the model class for table "Identidade".
 *
 * The followings are the available columns in table 'Identidade':
 * @property string $servidor_cpf
 * @property string $data_nascimento
 * @property string $numero
 * @property string $orgao_expedidor
 * @property string $uf
 * @property string $sexo
 * @property integer $estado_naturalidade_id
 * @property integer $cidade_naturalidade_id
 * @property string $nome_pai
 * @property string $nome_mae
 */
class Identidade extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Identidade the static model class
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
		return 'Identidade';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('data_nascimento, numero, orgao_expedidor, uf, sexo', 'required'),
			array('estado_naturalidade_id, cidade_naturalidade_id', 'numerical', 'integerOnly'=>true),
			array('servidor_cpf', 'length', 'max'=>11),
			array('numero', 'length', 'max'=>20),
			array('orgao_expedidor', 'length', 'max'=>10),
			array('uf', 'length', 'max'=>2),
			array('sexo', 'length', 'max'=>1),
			array('nome_pai, nome_mae', 'length', 'max'=>60),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('servidor_cpf, data_nascimento, numero, orgao_expedidor, uf, sexo, estado_naturalidade_id, cidade_naturalidade_id, nome_pai, nome_mae', 'safe', 'on'=>'search'),
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
			'servidor_cpf0' => array(self::BELONGS_TO, 'Servidor', 'servidor_cpf'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'servidor_cpf' => 'Servidor Cpf',
			'data_nascimento' => 'Data Nascimento',
			'numero' => 'Numero',
			'orgao_expedidor' => 'Orgao Expedidor',
			'uf' => 'Uf',
			'sexo' => 'Sexo',
			'estado_naturalidade_id' => 'Estado Naturalidade',
			'cidade_naturalidade_id' => 'Cidade Naturalidade',
			'nome_pai' => 'Nome Pai',
			'nome_mae' => 'Nome Mae',
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

		$criteria->compare('servidor_cpf',$this->servidor_cpf,true);

		$criteria->compare('data_nascimento',$this->data_nascimento,true);

		$criteria->compare('numero',$this->numero,true);

		$criteria->compare('orgao_expedidor',$this->orgao_expedidor,true);

		$criteria->compare('uf',$this->uf,true);

		$criteria->compare('sexo',$this->sexo,true);

		$criteria->compare('estado_naturalidade_id',$this->estado_naturalidade_id);

		$criteria->compare('cidade_naturalidade_id',$this->cidade_naturalidade_id);

		$criteria->compare('nome_pai',$this->nome_pai,true);

		$criteria->compare('nome_mae',$this->nome_mae,true);

		return new CActiveDataProvider('Identidade', array(
			'criteria'=>$criteria,
		));
	}
}