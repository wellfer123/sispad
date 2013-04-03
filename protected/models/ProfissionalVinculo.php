<?php

/**
 * This is the model class for table "profissional_vinculo".
 *
 * The followings are the available columns in table 'profissional_vinculo':
 * @property string $cpf
 * @property string $unidade_cnes
 * @property string $codigo_profissao
 */
class ProfissionalVinculo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProfissionalVinculo the static model class
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
		return 'profissional_vinculo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                      
			array('cpf', 'length', 'max'=>11),
			array('unidade_cnes', 'length', 'max'=>10),
			array('codigo_profissao', 'length', 'max'=>6),
                        array('cpf','validaVinculoExistente'),
			array('cpf,unidade_cnes,codigo_profissao', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cpf, unidade_cnes, codigo_profissao', 'safe', 'on'=>'search'),
                       
		);
	}
        public function  validaVinculoExistente($attribute,$params){

             if((ProfissionalVinculo::model()->find('cpf= :cpf and unidade_cnes=:unidade and codigo_profissao=:profissao',array(':cpf'=>$this->cpf,':unidade'=>$this->unidade_cnes,':profissao'=>$this->codigo_profissao)))==null){
                 return true;
             }
             $this->addError('','Vinculo já existe');
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
                    'servidor' => array(self::BELONGS_TO, 'Servidor', 'cpf'),
                    'unidade' => array(self::BELONGS_TO, 'Unidade', 'unidade_cnes'),
                    'profissao' => array(self::BELONGS_TO, 'Profissao', 'codigo_profissao'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cpf' => 'Cpf',
			'unidade_cnes' => 'Unidade Cnes',
			'codigo_profissao' => 'Profissao',
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

		$criteria->compare('cpf',$this->cpf,true);
		$criteria->compare('unidade_cnes',$this->unidade_cnes,true);
		$criteria->compare('codigo_profissao',$this->codigo_profissao,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}