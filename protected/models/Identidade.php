<?php

/**
 * This is the model class for table "Identidade".
 *
 * The followings are the available columns in table 'Identidade':
 * @property string $servidor_cpf
 * @property string $data_nascimento
 * @property string $numero
 * @property string $orgao_expedidor
 * @property string $uf
 * @property string $sexo
 * @property integer $cidade_naturalidade_id
 * @property string $nome_pai
 * @property string $nome_mae
 */
class Identidade extends CActiveRecord
{
    
    public static $SEXOS=array('M'=>'MASCULINO', 'F'=>'FEMININO');
    public static $ORGAO_EXPEDIDOR=array('SDS'=>'SECRETARIA DE DEFESA SOCIAL', 'SSS'=>'SECRETARIA DE SEGURANÇA PÚBLICA');
	/**
	 * Returns the static model of the specified AR class.
	 * @return Identidade the static model class
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
		return 'identidade';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('data_nascimento, numero, orgao_expedidor, uf, sexo', 'required'),
			array('cidade_naturalidade_id, uf', 'numerical', 'integerOnly'=>true),
			array('servidor_cpf', 'length', 'max'=>11),
			array('numero', 'length', 'max'=>20),
			array('orgao_expedidor', 'length', 'max'=>10),
			array('uf', 'length', 'max'=>10),
			array('sexo', 'length', 'max'=>1),
			array('nome_pai, nome_mae', 'length', 'max'=>60),
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
			'servidor' => array(self::BELONGS_TO, 'Servidor', 'servidor_cpf'),
                        'cidadeNaturalidade'=>array(self::BELONGS_TO,'Cidades','cidade_naturalidade_id'),
                        'estado'=>array(self::BELONGS_TO,'Estados','uf'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'servidor_cpf' => 'CPF do Servidor',
			'data_nascimento' => 'Data de Nascimento',
			'numero' => 'Número',
			'orgao_expedidor' => 'Orgão Expedidor',
			'uf' => 'UF',
			'sexo' => 'Sexo',
			'cidade_naturalidade_id' => 'Cidade da Naturalidade',
			'nome_pai' => 'Nome do Pai',
			'nome_mae' => 'Nome da Mãe',
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

		$criteria->compare('servidor_cpf',$this->servidor_cpf,true);

		$criteria->compare('data_nascimento',$this->data_nascimento,true);

		$criteria->compare('numero',$this->numero,true);

		$criteria->compare('orgao_expedidor',$this->orgao_expedidor,true);

		$criteria->compare('uf',$this->uf,true);

		$criteria->compare('sexo',$this->sexo,true);

		$criteria->compare('cidade_naturalidade_id',$this->cidade_naturalidade_id);

		$criteria->compare('nome_pai',$this->nome_pai,true);

		$criteria->compare('nome_mae',$this->nome_mae,true);

		return new CActiveDataProvider('Identidade', array(
			'criteria'=>$criteria,
		));
	}
        
        
        public function getLabelSexo(){
            return Identidade::$SEXO[$this->sexo];
        }
        
        public function getLabelOrgaoExpedidor(){
            return Identidade::$ORGAO_EXPEDIDOR[$this->orgao_expedidor];
        }
}