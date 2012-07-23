<?php

/**
 * This is the model class for table "medico_executa_item".
 *
 * The followings are the available columns in table 'medico_executa_item':
 * @property string $medico_cpf
 * @property integer $item_id
 * @property string $medico_unidade_cnes
 * @property integer $quantidade
 * @property integer $competencia
 */
class MedicoExecutaItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return MedicoExecutaItem the static model class
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
		return 'medico_executa_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('medico_cpf, competencia,medico_unidade_cnes,item_id,quantidade', 'required','on'=>'create'),
                        array('medico_cpf, competencia,medico_unidade_cnes', 'required','on'=>'valTemp'),
                        array('item_id, quantidade', 'safe', 'on'=>'valTemp'),
			array('item_id, quantidade, competencia', 'numerical', 'integerOnly'=>true),
			array('medico_cpf', 'length', 'max'=>11),
                        array('quantidade', 'length', 'min'=>1,'max'=>11),
			array('medico_unidade_cnes', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('medico_cpf, item_id, medico_unidade_cnes, quantidade, competencia', 'safe', 'on'=>'search'),
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
			'item' => array(self::BELONGS_TO, 'Item', 'item_id'),
			'competencia' => array(self::BELONGS_TO, 'Competencia', 'competencia'),
			'medico' => array(self::BELONGS_TO, 'Medico', 'medico_cpf, medico_unidade_cnes'),
                        'unidade' => array(self::BELONGS_TO, 'Unidade', 'medico_unidade_cnes'),
                        'unidade2' => array(self::BELONGS_TO, 'Medico', 'medico_unidade_cnes'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'medico_cpf' => 'Médico',
			'item_id' => 'Item',
			'medico_unidade_cnes' => 'Unidade do médico',
			'quantidade' => 'Quantidade',
			'competencia' => 'Competência',
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

		$criteria->compare('medico_cpf',$this->medico_cpf,true);

		$criteria->compare('item_id',$this->item_id);

		$criteria->compare('medico_unidade_cnes',$this->medico_unidade_cnes,true);

		$criteria->compare('quantidade',$this->quantidade);

		$criteria->compare('competencia',$this->competencia);
                
                $criteria->with=array('item','medico.servidor','unidade');
                
                $criteria->order=" competencia DESC";

		return new CActiveDataProvider('MedicoExecutaItem', array(
			'criteria'=>$criteria,
		));
	}
}