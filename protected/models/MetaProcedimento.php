<?php

/**
 * This is the model class for table "meta_procedimento".
 *
 * The followings are the available columns in table 'meta_procedimento':
 * @property integer $meta_id
 * @property string $procedimento_codigo
 */
class MetaProcedimento extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return meta_procedimento the static model class
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
		return 'meta_procedimento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('meta_id', 'numerical', 'integerOnly'=>true),
			array('procedimento_codigo', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('meta_id, procedimento_codigo', 'safe', 'on'=>'search'),
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
                    'procedimento'=>array(self::BELONGS_TO,'Procedimento','procedimento_codigo'),
                    'meta'=>array(self::BELONGS_TO,'Meta','meta_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'meta_id' => 'Meta',
			'procedimento_codigo' => 'Procedimento',
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

		$criteria->compare('meta_id',$this->meta_id);

		$criteria->compare('procedimento_codigo',$this->procedimento_codigo,true);

		return new CActiveDataProvider('meta_procedimento', array(
			'criteria'=>$criteria,
		));
	}

         public function searchMetaId($metaId)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
               
		$criteria->compare('meta_id',$metaId);
            


		return new CActiveDataProvider('metaProcedimento', array(
			'criteria'=>$criteria,
		));
	}
}