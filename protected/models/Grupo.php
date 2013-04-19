<?php

/**
 * This is the model class for table "grupo".
 *
 * The followings are the available columns in table 'grupo':
 * @property integer $codigo
 * @property string $nome
 *
 * The followings are the available model relations:
 * @property Profissao[] $profissaos
 */
class Grupo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Grupo the static model class
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
		return 'grupo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome', 'required'),
			array('nome', 'length', 'max'=>80),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('codigo, nome', 'safe', 'on'=>'search'),
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
			'profissaos' => array(self::HAS_MANY, 'Profissao', 'grupo_codigo'),
                        'unidades' => array(self::MANY_MANY, 'Unidade', 'unidade_gestor(grupo_codigo,unidade_cnes)'),
                        'especialidades' => array(self::MANY_MANY, 'Profissao', 'especialidade_grupo(grupo_codigo,profissao_codigo)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'codigo' => 'Codigo',
			'nome' => 'Nome',
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

		$criteria->compare('codigo',$this->codigo);
		$criteria->compare('nome',$this->nome,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}