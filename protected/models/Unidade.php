<?php

/**
 * This is the model class for table "Unidade".
 *
 * The followings are the available columns in table 'Unidade':
 * @property string $cnes
 * @property string $descricao
 * @property string $nome
 * @property integer $cidade_id
 * @property integer $regional_id
 */
class Unidade extends CActiveRecord
{
     /**
     *@var string
     *@soap
     */
     public $cnes;
     /**
     *@var string
     *@soap   
     */
     public $nome;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Unidade the static model class
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
		return 'unidade';
	}
        
        	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cnes, descricao,nome,cidade_id, regional_id', 'required'),
			array('cidade_id', 'numerical', 'integerOnly'=>true),
                        array('regional_id', 'numerical', 'integerOnly'=>true),
			array('cnes', 'length', 'max'=>10),
                        array('cnes', 'unique'),
                        array('cnes', 'numerical', 'integerOnly'=>true),
			array('descricao', 'length', 'max'=>100),
			array('nome', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cnes, descricao, nome, cidade_id', 'safe', 'on'=>'search'),
                        'profissionalVinculo' => array(self::HAS_MANY, 'ProfissionalVinculo', 'unidade_cnes'),
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
                    'cidade'=>array(self::BELONGS_TO,'Cidades','cidade_id'),
                    'regional'=>array(self::BELONGS_TO,'Regionais','regional_id'),
                    'departamentos'=>array(self::HAS_MANY,'Departamento','unidade_cnes'),
                    'servidor'=>array(self::HAS_MANY,'Servidor','unidade_cnes'),
                    'enfermeiro_executa_meta'=>array(self::HAS_MANY,'EnfermeiroExecutaMeta','unidade_cnes'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cnes' => 'CNES',
			'descricao' => 'Descricão',
			'nome' => 'Nome',
			'cidade_id' => 'Cidade',
                        'regional_id' => 'Regional',
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

		$criteria->compare('cnes',$this->cnes,true);

		$criteria->compare('nome',$this->nome,true);

		return new CActiveDataProvider('Unidade', array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                                      'pageSize'=>20
                        )
		));
	}
        
        
        public function getNomeDescricao(){
            return $this->cnes.'/'.$this->nome."-".$this->descricao;
        }
        
        public function upperCaseAllFieds(){
            $this->descricao=strtoupper($this->descricao);
            $this->nome=strtoupper($this->nome);
        }
        
        protected function beforeSave() {
            $this->upperCaseAllFieds();
            return parent::beforeSave();
        }
        
        public function getCnesNome(){
            return $this->cnes.'/'.$this->nome;
        }
        
}