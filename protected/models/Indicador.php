<?php

/**
 * This is the model class for table "Indicador".
 *
 * The followings are the available columns in table 'Indicador':
 * @property integer $id
 * @property string $nome
 * @property string $descricao
 * @property integer $profissao_codigo
 * @property string $status
 * @property string $afericao
 */
class Indicador extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Indicador the static model class
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
		return 'Indicador';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome, descricao', 'required'),
			array('profissao_codigo', 'numerical', 'integerOnly'=>true),
			array('nome', 'length', 'max'=>30),
			array('descricao', 'length', 'max'=>100),
			array('status', 'length', 'max'=>1),
			array('afericao', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nome, descricao, profissao_codigo, status, afericao', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array('profissao'=>array(self::BELONGS_TO,'profissao','profissao_codigo'),
                            'meta'=>array(self::HAS_MANY,'meta','indicador_id')
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
			'descricao' => 'Descricao',
			'profissao_codigo' => 'Profissao Codigo',
			'status' => 'Status',
			'afericao' => 'Afericao',
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

		$criteria->compare('descricao',$this->descricao,true);

		$criteria->compare('profissao_codigo',$this->profissao_codigo);

		$criteria->compare('status',$this->status,true);

		$criteria->compare('afericao',$this->afericao,true);

		return new CActiveDataProvider('Indicador', array(
			'criteria'=>$criteria,
		));
	}
}