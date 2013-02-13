<?php

/**
 * This is the model class for table "Competencia".
 *
 * The followings are the available columns in table 'Competencia':
 * @property integer $mes_ano
 * @property integer $ativo
 */
class Competencia extends CActiveRecord
{
    
        const FECHADA='0';
        const ABERTA='1';
        
//        function __construct($mes=null,$ano=null) {
//            if ($mes != null && $ano!= null)
//            $this->mes_ano=(int) $mes.$ano;
//        }

        /**
	 * Returns the static model of the specified AR class.
	 * @return Competencia the static model class
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
		return 'competencia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mes_ano, ativo', 'numerical', 'integerOnly'=>true),
                        array('mes_ano', 'length', 'min'=>6, 'max'=>6),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('mes_ano, ativo', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'mes_ano' => 'Mês/Ano',
			'ativo' => 'Status',
		);
	}
        
        public function labelStatus(){
            if($this->ativo === Competencia::ABERTA){
                return 'ABERTA';
            }
            else if($this->ativo === Competencia::FECHADA){
                return 'FECHADA';
            }
            return 'DESCONHECIDO';
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

		$criteria->compare('mes_ano',$this->mes_ano);

		$criteria->compare('ativo',$this->ativo);

		return new CActiveDataProvider('Competencia', array(
			'criteria'=>$criteria,
		));
	}
        
        public function __toString() {
            $str=(string) $this->mes_ano;
            if(strlen($str) === 5){
                $str="0$str";
            }
            return $str;
        }
        
        public function equals($record) {
            if($record!=null){
                if($record instanceof Competencia){
                    if($record->mes_ano===$this->mes_ano){
                        return true;
                    }
                }
            }
            return false;
        }
        
        public function getMesAno(){
            return $this->mes_ano;
        }
        
        public function setMesAno($mes_ano){
            $this->mes_ano=$mes_ano;
        }
        
        /**
         *
         * @return boolean true se a competencia estiver aberta, caso contrário false 
         */
        public function isAberta(){
            if ( $this->ativo === Competencia::ABERTA){
                return true;
            }
            return false;
        }


        /**
         * Recebe uma competencia no estilo ano/mes (201201) e inverte para
         * mês/ano (12012) 
         * Obs. transforma em um inteiro.
         * @param string $competencia no formato anomes (201212)
         * @return int 
         * @deprecated
         */
        public static function inverterCompetenciaMesAno($competencia){
            if (strlen($competencia) === 6){
                return (int)substr($competencia, -2).substr($competencia, 0, 4);
            }
        }
}