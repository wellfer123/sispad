<?php

/**
 * This is the model class for table "Procedimento".
 *
 * The followings are the available columns in table 'Procedimento':
 * @property string $codigo
 * @property string $nome
 * @property string $tipo_complexidade
 * @property string $tipo_sexo
 * @property string $quantidade_maxima_execucao
 * @property string $quantidade_dias_permanencia
 * @property string $quantidade_pontos
 * @property string $validade_idade_minima
 * @property string $validade_idade_maxima
 * @property string $validade_sh
 * @property string $validade_sa
 * @property string $validade_sp
 * @property string $codigo_financiamento
 * @property string $codigo_rubrica
 * @property string $data_competencia
 */
class Procedimento extends CActiveRecord
{
    
        /**
         * @var string nome do procedimento
         * @soap
         */
        public $nome;
        
        /**
         * @var string nome do procedimento
         * @soap
         */
        public $codigo;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Procedimento the static model class
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
		return 'procedimento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo, nome, tipo_complexidade, tipo_sexo, quantidade_maxima_execucao, quantidade_dias_permanencia, quantidade_pontos, validade_idade_minima, validade_idade_maxima, validade_sh, validade_sa, validade_sp, codigo_financiamento, codigo_rubrica, data_competencia', 'required'),
			array('codigo, validade_sh, validade_sa, validade_sp', 'length', 'max'=>10),
			array('nome', 'length', 'max'=>250),
			array('tipo_complexidade, tipo_sexo', 'length', 'max'=>1),
			array('quantidade_maxima_execucao, quantidade_dias_permanencia, quantidade_pontos, validade_idade_minima, validade_idade_maxima', 'length', 'max'=>4),
			array('codigo_financiamento', 'length', 'max'=>2),
			array('codigo_rubrica, data_competencia', 'length', 'max'=>6),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('codigo, nome, tipo_complexidade, tipo_sexo, quantidade_maxima_execucao, quantidade_dias_permanencia, quantidade_pontos, validade_idade_minima, validade_idade_maxima, validade_sh, validade_sa, validade_sp, codigo_financiamento, codigo_rubrica, data_competencia', 'safe', 'on'=>'search'),
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
                    'metaProcedimento'=>array(self::HAS_MANY,'MetaProcedimento','procedimento_codigo')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'codigo' => 'Codigo',
			'nome' => 'Nome',
			'tipo_complexidade' => 'Tipo Complexidade',
			'tipo_sexo' => 'Tipo Sexo',
			'quantidade_maxima_execucao' => 'Quantidade Maxima Execucao',
			'quantidade_dias_permanencia' => 'Quantidade Dias Permanencia',
			'quantidade_pontos' => 'Quantidade Pontos',
			'validade_idade_minima' => 'Validade Idade Minima',
			'validade_idade_maxima' => 'Validade Idade Maxima',
			'validade_sh' => 'Validade Sh',
			'validade_sa' => 'Validade Sa',
			'validade_sp' => 'Validade Sp',
			'codigo_financiamento' => 'Codigo Financiamento',
			'codigo_rubrica' => 'Codigo Rubrica',
			'data_competencia' => 'Data Competencia',
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

		$criteria->compare('codigo',$this->codigo,true);

		$criteria->compare('nome',$this->nome,true);

		$criteria->compare('tipo_complexidade',$this->tipo_complexidade,true);

		$criteria->compare('tipo_sexo',$this->tipo_sexo,true);

		$criteria->compare('quantidade_maxima_execucao',$this->quantidade_maxima_execucao,true);

		$criteria->compare('quantidade_dias_permanencia',$this->quantidade_dias_permanencia,true);

		$criteria->compare('quantidade_pontos',$this->quantidade_pontos,true);

		$criteria->compare('validade_idade_minima',$this->validade_idade_minima,true);

		$criteria->compare('validade_idade_maxima',$this->validade_idade_maxima,true);

		$criteria->compare('validade_sh',$this->validade_sh,true);

		$criteria->compare('validade_sa',$this->validade_sa,true);

		$criteria->compare('validade_sp',$this->validade_sp,true);

		$criteria->compare('codigo_financiamento',$this->codigo_financiamento,true);

		$criteria->compare('codigo_rubrica',$this->codigo_rubrica,true);

		$criteria->compare('data_competencia',$this->data_competencia,true);

		return new CActiveDataProvider('Procedimento', array(
			'criteria'=>$criteria,
		));
	}

        protected function afterSave() {
            parent::afterSave();

            $modelMetaProcedimento = new MetaProcedimento();
            $modelMetaProcedimento->procedimento_id = $this->codigo;
            $modelMetaProcedimento->meta_id=$_GET['meta_id'];
        }
}