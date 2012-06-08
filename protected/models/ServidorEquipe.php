<?php

/**
 * This is the model class for table "Servidor_Equipe".
 *
 * The followings are the available columns in table 'Servidor_Equipe':
 * @property integer $equipe_codigo_area
 * @property string $equipe_unidade_cnes
 * @property string $servidor_cpf
 * @property int $ativo
 * @property string $funcao
 */
class ServidorEquipe extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Servidor_Equipe the static model class
	 */

        const ATIVO=1;
        const DESATIVO=0;

        public $erro;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'servidor_equipe';
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
                        array('servidor_cpf','verificaServidorExistente','on'=>'create'),
                        array('funcao','verificaFuncaoExistente','on'=>'create active'),
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

        public function  verificaServidorExistente($attribute,$params){
             $servidor = ServidorEquipe::model()->find('servidor_cpf= :servidor_cpf',array(':servidor_cpf'=>$this->servidor_cpf));
             $servidor_count = ServidorEquipe::model()->count('servidor_cpf= :servidor_cpf',array(':servidor_cpf'=>$this->servidor_cpf));
             if(($servidor)==null || ($servidor->funcao=='Medico' && $servidor_count<=1) || ($servidor->funcao=='Odontologo' && $servidor_count<=1)  ){
                 return true;
             }else if($servidor->ativo==1){
                  $this->addError('servidor_cpf','Este servidor já existe nessa ou em outra equipe');

             }  else {
                   $this->addError('servidor_cpf','Este servidor já existe mas está inativo, vá no menu "Gerenciar Membros" e o ative');
             }
            
             return false;
        }

        public function  verificaFuncaoExistente($attribute,$params){

             $quantFuncao = count(ServidorEquipe::model()->findAll('funcao= :funcao AND ativo=1 AND equipe_codigo_area= :codigo_area
                  AND equipe_unidade_cnes= :unidade_cnes',array(':funcao'=>$this->funcao,
                      ':codigo_area'=>$this->equipe_codigo_area,':unidade_cnes'=>$this->equipe_unidade_cnes)));


             if($this->funcao=='Odontologo' || $this->funcao=='Medico' || $this->funcao=='Enfermeiro'){
                 if($quantFuncao==1){
                     $this->erro = 'Já existe 1 (um) servidor com esta função na equipe';
                       $this->addError('funcao',$this->erro);
                        
                       return false;
                 }
             }elseif($this->funcao=='AgenteSaude'){
                 if($quantFuncao==5){
                       $this->erro = 'Já existem 5 (cinco) servidores com esta função na equipe';
                       $this->addError('funcao',$this->erro);
                        
                       return false;
                 }
             }else
                return true;
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
                        'funcao'=>'Função'
		);
	}

         public function labelStatus(){
            if($this->ativo== User::ATIVO){
                return 'ATIVO';
            }
            else if($this->ativo==User::DESATIVO){
                return 'DESATIVO';
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

        public function searchServidoresAtivos($codigo_area,$unidade_cnes) {

                $dados=Yii::app()->db->createCommand('select ser_equ.*,ser.nome,ser.cpf,ser_equ.ativo as id from servidor_equipe as ser_equ INNER JOIN servidor as ser
                                                      ON ser_equ.servidor_cpf = ser.cpf where ser_equ.equipe_codigo_area='
                                                      .$codigo_area.' AND ser_equ.equipe_unidade_cnes='.$unidade_cnes.' AND ser_equ.ativo=1')->queryAll();



                 return  new CArrayDataProvider($dados, array(
                                    'id'=>'servidorEquipe',
                                    'pagination'=>false

		));

    }
    public function equals($record) {
        if($record!=null){
          if($record instanceof ServidorEquipe){
            if($this->equipe_unidade_cnes==$record->equipe_unidade_cnes){
                if($this->servidor_cpf==$record->servidor_cpf){
                    if($this->funcao==$record->funcao){
                        return true;
                    }
                }
            }
          }
        }
        return false;
    }

    
    public function getEquipeCodigoArea(){
        return $this->equipe_codigo_area;
    }
    
    public function setEquipeCodigoArea($equipe_codigo_area){
        $this->equipe_codigo_area=$equipe_codigo_area;
    }
    
    public function getEquipeUnidadeCNES(){
        return $this->equipe_unidade_cnes;
    }
    
    public function setEquipeUnidadeCNES($equipe_unidade_cnes){
        $this->equipe_unidade_cnes=$equipe_unidade_cnes;
    }
    
    public function getServidorCPF(){
        return $this->servidor_cpf;
    }
    
    public function setServidorCPF($servidor_cpf){
        $this->servidor_cpf=$servidor_cpf;
    }
    
    public function getFuncao(){
        return $this->funcao;
    }
    
    public function setFuncao($funcao){
        $this->funcao=$funcao;
    }
}