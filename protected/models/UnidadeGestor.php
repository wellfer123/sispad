<?php

/**
 * This is the model class for table "unidade_gestor".
 *
 * The followings are the available columns in table 'unidade_gestor':
 * @property string $unidade_cnes
 * @property string $servidor_cpf
 */
class UnidadeGestor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UnidadeGestor the static model class
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
		return 'unidade_gestor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('unidade_cnes', 'length', 'max'=>10),
			array('servidor_cpf', 'length', 'max'=>11),
			array('unidade_cnes,servidor_cpf', 'required'),
			array('unidade_cnes,servidor_cpf', 'validaUnidadeGestorExistente','on'=>'create'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('unidade_cnes, servidor_cpf', 'safe', 'on'=>'search'),
		);
	}

        
          public function  validaUnidadeGestorExistente($attribute,$params){

             if((UnidadeGestor::model()->find('servidor_cpf= :cpf and unidade_cnes=:unidade',array(':cpf'=>$this->servidor_cpf,':unidade'=>$this->unidade_cnes)))==null){
                 return true;
             }
             $this->addError('','Unidade/Gestor já existe');
             return false;
        }
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'servidor' => array(self::BELONGS_TO, 'Servidor', 'servidor_cpf'),
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
			'servidor_cpf' => 'Gestor'
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
                $criteria->with = 'servidor';
		$criteria->compare('unidade_cnes',$this->unidade_cnes,true);
		$criteria->compare('servidor_cpf',$this->servidor_cpf,true);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria
		));
	}
}