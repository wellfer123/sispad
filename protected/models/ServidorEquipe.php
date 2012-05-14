<?php

/**
 * This is the model class for table "Servidor_Equipe".
 *
 * The followings are the available columns in table 'Servidor_Equipe':
 * @property integer $equipe_codigo_area
 * @property string $equipe_unidade_cnes
 * @property string $servidor_cpf
 */
class ServidorEquipe extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Servidor_Equipe the static model class
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
		return 'Servidor_Equipe';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('equipe_codigo_area', 'numerical', 'integerOnly'=>true),
			array('equipe_unidade_cnes', 'length', 'max'=>10),
			array('servidor_cpf', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('equipe_codigo_area, equipe_unidade_cnes, servidor_cpf', 'safe', 'on'=>'search'),
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
                    'servidor'=>array(self::BELONGS_TO,'Servidor','servidor_cpf'),
                    

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'equipe_codigo_area' => 'Equipe Codigo Area',
			'equipe_unidade_cnes' => 'Equipe Unidade Cnes',
			'servidor_cpf' => 'Servidor Cpf',
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

		$criteria->compare('equipe_unidade_cnes',$this->equipe_unidade_cnes,true);

		$criteria->compare('servidor_cpf',$this->servidor_cpf,true);

		return new CActiveDataProvider('ServidorEquipe', array(
			'criteria'=>$criteria,
		));
	}

        public function searchServidores($codigo_area,$unidade_cnes)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('equipe_codigo_area',$codigo_area);

		$criteria->compare('equipe_unidade_cnes',$unidade_cnes,true);

		

		return new CActiveDataProvider('ServidorEquipe', array(
			'criteria'=>$criteria,
		));
	}
}