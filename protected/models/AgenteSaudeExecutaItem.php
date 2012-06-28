<?php

/**
 * This is the model class for table "agente_saude_executa_item".
 *
 * The followings are the available columns in table 'agente_saude_executa_item':
 * @property string $agente_saude_cpf
 * @property integer $item_id
 * @property string $agente_saude_unidade_cnes
 * @property integer $quantidade
 * @property integer $competencia
 */
class AgenteSaudeExecutaItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AgenteSaudeExecutaItem the static model class
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
		return 'agente_saude_executa_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('agente_saude_cpf, item_id, competencia', 'required'),
			array('item_id, quantidade, competencia', 'numerical', 'integerOnly'=>true),
			array('agente_saude_cpf', 'length', 'max'=>11),
			array('agente_saude_unidade_cnes', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('agente_saude_cpf, item_id, agente_saude_unidade_cnes, quantidade, competencia', 'safe', 'on'=>'search'),
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
			'competencia0' => array(self::BELONGS_TO, 'Competencia', 'competencia'),
			'agente_saude_cpf0' => array(self::BELONGS_TO, 'AgenteSaude', 'agente_saude_cpf'),
			'agente_saude_unidade_cnes0' => array(self::BELONGS_TO, 'AgenteSaude', 'agente_saude_unidade_cnes'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'agente_saude_cpf' => 'Agente Saude Cpf',
			'item_id' => 'Item',
			'agente_saude_unidade_cnes' => 'Agente Saude Unidade Cnes',
			'quantidade' => 'Quantidade',
			'competencia' => 'Competencia',
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

		$criteria->compare('agente_saude_cpf',$this->agente_saude_cpf,true);

		$criteria->compare('item_id',$this->item_id);

		$criteria->compare('agente_saude_unidade_cnes',$this->agente_saude_unidade_cnes,true);

		$criteria->compare('quantidade',$this->quantidade);

		$criteria->compare('competencia',$this->competencia);

		return new CActiveDataProvider('AgenteSaudeExecutaItem', array(
			'criteria'=>$criteria,
		));
	}
}