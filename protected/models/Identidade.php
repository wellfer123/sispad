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
                        array('servidor_cpf', 'cpfExiste', 'on'=>'create'),
                        array('numero', 'identidadeExiste', 'on'=>'create'),
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
        
        
        protected function beforeSave() {
            $this->data_nascimento=ParserDate::inverteDataPtToEn($this->data_nascimento);
            $this->upperAllFields();
            return parent::beforeSave();
        }

        
        public function cpfExiste($attribute, $params) {
         
         $identidade= $this->model()->findByAttributes(array('servidor_cpf'=>$this->servidor_cpf));
         if($identidade!=null){
             $this->addError('nome',"O servidor já tem uma identidade cadastrada!");
             return false;
          }
         return true;
        }
        
        public function identidadeExiste($attribute, $params) {
         
         $identidade= $this->model()->findByAttributes(array('numero'=>$this->numero));
         if($identidade!=null){
             $this->addError('nome',"Essa identidade já encontra-se cadastro no sistema!");
             return false;
             }
         return true;
        }
        
        public function getLabelSexo(){
            return Identidade::$SEXOS[$this->sexo];
        }
        
        public function getLabelOrgaoExpedidor(){
            return Identidade::$ORGAO_EXPEDIDOR[$this->orgao_expedidor];
        }
        
        public function upperAllFields(){
            $this->nome_mae=strtoupper($this->nome_mae);
            $this->nome_pai=strtoupper($this->nome_pai);
        }
        
        protected function afterFind() {
            $this->data_nascimento=ParserDate::inverteDataEnToPt($this->data_nascimento);
            parent::afterFind();
        }

}