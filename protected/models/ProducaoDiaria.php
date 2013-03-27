<?php

/**
 * This is the model class for table "producao_diaria".
 *
 * The followings are the available columns in table 'producao_diaria':
 * @property string $unidade_cnes
 * @property string $servidor_cpf
 * @property string $profissao_codigo
 * @property string $quantidade
 * @property string $data
 *
 * The followings are the available model relations:
 * @property Unidade $unidadeCnes
 * @property Servidor $servidorCpf
 * @property Profissao $profissaoCodigo
 */
class ProducaoDiaria extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProducaoDiaria the static model class
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
		return 'producao_diaria';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('unidade_cnes, servidor_cpf, quantidade,profissao_codigo, data', 'required'),
                        array('unidade_cnes, servidor_cpf, quantidade','numerical','integerOnly'=>true),
			array('unidade_cnes', 'length', 'min'=>7,'max'=>7),
			array('servidor_cpf', 'length','min'=>11, 'max'=>11),
			array('profissao_codigo', 'length','min'=>6, 'max'=>6),
			array('quantidade', 'length', 'min'=>1,'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('unidade_cnes, servidor_cpf, profissao_codigo, quantidade, data', 'safe', 'on'=>'search'),
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
			'gestor' => array(self::BELONGS_TO, 'Servidor', 'servidor_cpf'),
			'especialidade' => array(self::BELONGS_TO, 'Profissao', 'profissao_codigo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'unidade_cnes' => 'Unidade',
			'servidor_cpf' => 'Gestor',
			'profissao_codigo' => 'Especialidade',
			'quantidade' => 'Quantidade',
			'data' => 'Data',
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
		$criteria->compare('servidor_cpf',$this->servidor_cpf,true);
		$criteria->compare('profissao_codigo',$this->profissao_codigo,true);
		$criteria->compare('quantidade',$this->quantidade,true);
		$criteria->compare('data',$this->data,true);
                $criteria->with=array('unidade','especialidade');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}