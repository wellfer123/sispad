<?php

/**
 * This is the model class for table "Servidor".
 *
 * The followings are the available columns in table 'Servidor':
 * @property string $cpf
 * @property string $matricula
 * @property string $nome
 * @property string $estado_civil
 * @property integer $endereco_id
 * @property string $unidade_cnes
 */
class Servidor extends CActiveRecord
{
    
    
        public static $ESTADOS_CIVIS=array('S'=>'SOLTEIRO','C'=>'CASADO','D'=>'DIVORCIADO');
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
			array('cpf, matricula,nome,estado_civil', 'required'),
			array('endereco_id, matricula, cpf', 'numerical', 'integerOnly'=>true),
			array('cpf', 'length', 'max'=>11, 'min'=>11),
			array('matricula', 'length', 'max'=>20),
			array('nome', 'length', 'max'=>40),
			array('estado_civil', 'length', 'max'=>1),
			array('unidade_cnes', 'length', 'max'=>10,'min'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cpf, matricula, nome, estado_civil, endereco_id, unidade_cnes', 'safe', 'on'=>'search'),
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
			'dadosTrabalho' => array(self::HAS_ONE, 'DadosTrabalho', 'servidor_cpf'),
			'identidade' => array(self::HAS_ONE, 'Identidade', 'servidor_cpf'),
			'endereco' => array(self::BELONGS_TO, 'Endereco', 'endereco_id'),
			'unidade' => array(self::BELONGS_TO, 'Unidade', 'unidade_cnes'),
			'tituloEleitor' => array(self::HAS_ONE, 'TituloEleitor', 'servidor_cpf'),
                        'user'=>array(self::HAS_MANY, 'user', 'servidor_cpf'),
                        'relatorio'=>array(self::HAS_MANY, 'servidor', 'servidor_cpf'),
                        'totalRelatorio'=>array(self::HAS_MANY,'TotalRelatorio','servidor_cpf'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cpf' => 'CPF',
			'matricula' => 'Matrícula',
			'nome' => 'Nome',
			'estado_civil' => 'Estado Civil',
			'endereco_id' => 'Endereço',
			'unidade_cnes' => 'Unidade Pertencente',
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

		//$criteria->compare('estado_civil',$this->estado_civil,true);

		//$criteria->compare('endereco_id',$this->endereco_id);

		//$criteria->compare('unidade_cnes',$this->unidade_cnes,true);



		return new CActiveDataProvider('Servidor', array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>20
                        )
		));
	}

           public function searchAllNotSendReport($ano, $mes)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

                $dados=Yii::app()->db->createCommand('SELECT serv.nome, serv.cpf FROM servidor serv
                                                       WHERE (SELECT r.servidor_cpf FROM total_relatorio r 
                                                       WHERE r.servidor_cpf=serv.cpf AND 
                                                       r.ano='.$ano.' AND r.mes='.$mes.') IS NULL')->queryAll();

		return new CArrayDataProvider($dados, array(
                                    'id'=>'servidor',
                                    'sort'=>array(
                                            'attributes'=>array(
                                                'cpf', 'nome',
                                             ),
                                     ),
                                    'pagination'=>array(
                                            'pageSize'=>20
                                    )

		));
		
	}

        public static function existeEmTotalRelatorio($cpf) {
            if(TotalRelatorio::model()->find('servidor_cpf= :cpf',array(':cpf'=>$cpf))){
                return true;
            }

            return false;

        }
        protected function beforeSave() {
            $this->upperCaseAllFields();
            return parent::beforeSave();
        }

        public function upperCaseAllFields(){
            $this->nome=strtoupper($this->nome);
        }
        
        public function getLabelEstadoCivil(){
            return Servidor::$ESTADOS_CIVIS[$this->estado_civil];
        }
}