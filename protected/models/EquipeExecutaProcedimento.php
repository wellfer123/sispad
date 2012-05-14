<?php

/**
 * This is the model class for table "equipe_executa_procedimento".
 *
 * The followings are the available columns in table 'equipe_executa_procedimento':
 */
class EquipeExecutaProcedimento extends CActiveRecord
{
    
        
	/**
	 * Returns the static model of the specified AR class.
	 * @return equipe_executa_procedimento the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        /**
         *@var int
         *@soap   
         */
         public $equipe_codigo_area;
         
         /**
         *@var int
         *@soap   
         */
         public $equipe_codigo_micro_area;
         
         /**
         *@var string
         *@soap  
         */
         public $unidade_cnes;
         
         /**
         *@var string
         *@soap  
         */
         public $procedimento_codigo;
         
         /**
         *@var int
         *@soap   
         */
         public $competencia;
         
         /**
         *@var int
         *@soap   
         */
         public $quantidade;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'equipe_executa_procedimento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
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
			'unidade_cnes0' => array(self::BELONGS_TO, 'Unidade', 'unidade_cnes'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'equipe_codigo_area' => 'Equipe Codigo Area',
			'equipe_codigo_microarea' => 'Equipe Codigo Microarea',
			'unidade_cnes' => 'Unidade Cnes',
			'procedimento_codigo' => 'Procedimento Codigo',
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

		$criteria->compare('equipe_codigo_area',$this->equipe_codigo_area);

		$criteria->compare('equipe_codigo_microarea',$this->equipe_codigo_microarea);

		$criteria->compare('unidade_cnes',$this->unidade_cnes,true);

		$criteria->compare('procedimento_codigo',$this->procedimento_codigo,true);

		$criteria->compare('quantidade',$this->quantidade);

		$criteria->compare('competencia',$this->competencia);

		return new CActiveDataProvider('equipe_executa_procedimento', array(
			'criteria'=>$criteria,
		));
	}
}