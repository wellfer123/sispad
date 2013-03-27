<?php

/**
 * This is the model class for table "unidade_especialidade".
 *
 * The followings are the available columns in table 'unidade_especialidade':
 * @property string $unidade_cnes
 * @property integer $grupo_codigo
 * @property string $profissao_codigo
 *
 * The followings are the available model relations:
 * @property Grupo $grupoCodigo
 * @property Profissao $profissaoCodigo
 * @property Unidade $unidadeCnes
 */
class UnidadeEspecialidade extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UnidadeEspecialidade the static model class
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
		return 'unidade_especialidade';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('unidade_cnes, grupo_codigo, profissao_codigo', 'required'),
			array('grupo_codigo, unidade_cnes', 'numerical', 'integerOnly'=>true),
			array('unidade_cnes', 'length', 'max'=>10),
			array('profissao_codigo', 'length', 'max'=>6),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('unidade_cnes, grupo_codigo, profissao_codigo', 'safe', 'on'=>'search'),
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
			'grupo' => array(self::BELONGS_TO, 'Grupo', 'grupo_codigo'),
			'especialidade' => array(self::BELONGS_TO, 'Profissao', 'profissao_codigo'),
			'unidade' => array(self::BELONGS_TO, 'Unidade', 'unidade_cnes'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'unidade_cnes' => 'Unidade',
			'grupo_codigo' => 'Grupo',
			'profissao_codigo' => 'Especialidade',
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

		$criteria->compare('unidade_cnes',$this->unidade_cnes,true);
		$criteria->compare('grupo_codigo',$this->grupo_codigo);
		$criteria->compare('profissao_codigo',$this->profissao_codigo,true);
                $criteria->with=array('especialidade','grupo');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}