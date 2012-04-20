<?php

/**
 * This is the model class for table "Dados_Trabalho".
 *
 * The followings are the available columns in table 'Dados_Trabalho':
 * @property string $servidor_cpf
 * @property string $data_admissao
 * @property string $pis
 * @property integer $carga_horaria
 * @property string $turno
 * @property string $profissao
 * @property string $salario
 * @property string $conselho_classe
 * @property string $data_afastamento
 * @property string $data_retorno
 * @property string $situacao_funcional
 * @property string $vinculo
 */
class DadosTrabalho extends CActiveRecord
{
    
    public static $SITUACOES_FUNCIONAIS=array('AT'=>'ATIVO','DE'=>'DESATIVO');
    public static $TIPOS_VINCULOS=array('C'=>'CONTRATADO','P'=>'CONCURSO PÚBLICO','S'=>'PRESTADOR DE SERVIÇO');
    public static $TIPOS_TURNOS=array('M'=>'MANHÃ','T'=>'TARDE','N'=>'NOTURNO','D'=>'DIURNO');

    /**
	 * Returns the static model of the specified AR class.
	 * @return Dados_Trabalho the static model class
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
		return 'Dados_Trabalho';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('servidor_cpf,profissao_codigo,vinculo,situacao_funcional,turno,data_admissao, carga_horaria, salario', 'required'),
			array('carga_horaria,profissao_codigo', 'numerical', 'integerOnly'=>true),
			array('servidor_cpf, pis', 'length', 'max'=>11),
			array('turno, vinculo', 'length', 'max'=>1),
			array(' conselho_classe', 'length', 'max'=>20),
			array('salario', 'length', 'max'=>7),
			array('situacao_funcional', 'length', 'max'=>2),
			array('data_afastamento, data_retorno', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('servidor_cpf, data_admissao, pis, carga_horaria, turno, profissao, salario, conselho_classe, data_afastamento, data_retorno, situacao_funcional, vinculo', 'safe', 'on'=>'search'),
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
                    'profissao'=>array(self::BELONGS_TO,'Profissao','profissao_codigo'),
                    'servidor'=>array(self::HAS_ONE,'Servidor','cpf'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'servidor_cpf' => 'CPF',
			'data_admissao' => 'Data de Admissão',
			'pis' => 'PIS/PASEF/NIT',
			'carga_horaria' => 'Carga Horária',
			'turno' => 'Turno',
			'profissao_codigo' => 'Profissão',
			'salario' => 'Salário',
			'conselho_classe' => 'Conselho de Classe',
			'data_afastamento' => 'Data de Afastamento',
			'data_retorno' => 'Data de Retorno',
			'situacao_funcional' => 'Situacao Funcional',
			'vinculo' => 'Vínculo',
		);
	}

	public function getLabelSituacaoFuncional(){
            return DadosTrabalho::$SITUACOES_FUNCIONAIS[$this->situacao_funcional];
        }
        
        public function getLabelVinculo(){
            return DadosTrabalho::$TIPOS_VINCULOS[$this->vinculo];
        }
        
        public function getLabelTurno(){
            return DadosTrabalho::$TIPOS_TURNOS[$this->turno];
        }


        public function upperCaseAllFields(){
       $this->conselho_classe=strtoupper($this->conselho_classe);
   }
   
   protected function beforeSave() {
       $this->upperCaseAllFields();
       return parent::beforeSave();
   }

}