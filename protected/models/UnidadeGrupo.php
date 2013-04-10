<?php

/**
 * This is the model class for table "unidade_grupo".
 *
 * The followings are the available columns in table 'unidade_grupo':
 * @property string $unidade_cnes
 * @property integer $grupo_codigo
 */
class UnidadeGrupo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UnidadeGrupo the static model class
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
		return 'unidade_grupo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('grupo_codigo', 'numerical', 'integerOnly'=>true),
			array('unidade_cnes', 'length', 'max'=>10),
                        array('unidade_cnes,grupo_codigo', 'validaUnidadeGrupoExistente','on'=>'create'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('unidade_cnes, grupo_codigo', 'safe', 'on'=>'search'),
		);
	}

        
           public function  validaUnidadeGrupoExistente($attribute,$params){

             if((UnidadeGrupo::model()->find('grupo_codigo= :codigo and unidade_cnes=:unidade',array(':codigo'=>$this->grupo_codigo,':unidade'=>$this->unidade_cnes)))==null){
                 return true;
             }
             $this->addError('','Unidade/Grupo já existe');
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
                    'unidade' => array(self::BELONGS_TO, 'Unidade', 'unidade_cnes'),
                    'grupo' => array(self::BELONGS_TO, 'Grupo', 'grupo_codigo'),
                    
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}