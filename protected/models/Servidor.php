<?php

/**
 * This is the model class for table "Servidor".
 *
 * The followings are the available columns in table 'Servidor':
 * @property string $cpf
 * @property string $matricula
 * @property string $nome
 * @property integer $setor_id
 */
class Servidor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Servidor the static model class
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
		return 'Servidor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cpf, matricula', 'required'),
			array('setor_id', 'numerical', 'integerOnly'=>true),
			array('cpf', 'length', 'max'=>11),
			array('matricula', 'length', 'max'=>20),
			array('nome', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cpf, matricula, nome, setor_id', 'safe', 'on'=>'search'),
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
                     'user'=>array(self::HAS_MANY, 'user', 'servidor_cpf'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cpf' => 'Cpf',
			'matricula' => 'Matricula',
			'nome' => 'Nome',
			'setor_id' => 'Setor',
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

		$criteria->compare('matricula',$this->matricula,true);

		$criteria->compare('nome',$this->nome,true);

		$criteria->compare('setor_id',$this->setor_id);

		return new CActiveDataProvider('Servidor', array(
			'criteria'=>$criteria,
		));
	}
        
        
        public function getNome(){
            return $this->nome;
        }
}