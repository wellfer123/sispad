<?php

/**
 * This is the model class for table "Departamento".
 *
 * The followings are the available columns in table 'Departamento':
 * @property string $id
 * @property string $nome
 * @property string $descricao
 * @property integer $unidade_cnes
 */
class Departamento extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Departamento the static model class
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
		return 'Departamento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome, descricao, unidade_cnes', 'required'),
			array('unidade_cnes', 'numerical', 'integerOnly'=>true),
			array('nome', 'length', 'max'=>40),
			array('descricao', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			//array('nome, descricao','safe', 'on'=>'search'),
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
                    'unidade'=>array(self::BELONGS_TO,'Unidade','unidade_cnes'),
                    'setores'=>array(self::HAS_MANY,'Setor','departamento_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Código',
			'nome' => 'Nome',
			'descricao' => 'Descrição',
			'unidade_cnes' => 'Unidade',
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


		$criteria->compare('nome',$this->nome,true);
                $criteria->compare('descricao',$this->descricao,true);

		return new CActiveDataProvider('Departamento', array(
			'criteria'=>$criteria,
		));
	}
}