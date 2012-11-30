<?php

/**
 * This is the model class for table "bpa_cid".
 *
 * The followings are the available columns in table 'bpa_cid':
 * @property string $codigo
 * @property string $nome
 * @property string $tipo_agravo
 * @property string $tipo_sexo
 * @property string $tipo_estadio
 * @property string $valor_campos_irradiados
 */
class Cid extends CActiveRecord
{
    /**
     *
     * @var array com chave e valor. Onde a chave representa o nome
     * da coluna no arquivo referente aa tabela CID no arquivo Tabela Unificada
     * do SIGTAP. E o valor é atributo desta cllasse que corresponde a coluna do arquivo.
     */
    public static final $MAPEAMENTO_CAMPO_ARQUIVO=array('CO_CID'=>'codigo','NO_CID'=>'nome',
                                                  'TP_AGRAVO'=>'tipo_agravo','TP_SEXO'=>'tipo_sexo',
                                                  'TP_ESTADIO'=>'tipo_estadio','VL_CAMPOS_IRRADIADOS'=>'valor_campos_irradiados'
                                                  );
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cid the static model class
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
		return 'bpa_cid';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo, nome, tipo_agravo, tipo_sexo, tipo_estadio, valor_campos_irradiados', 'required'),
			array('codigo, valor_campos_irradiados', 'length', 'max'=>4),
			array('nome', 'length', 'max'=>100),
			array('tipo_agravo, tipo_sexo, tipo_estadio', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('codigo, nome, tipo_agravo, tipo_sexo, tipo_estadio, valor_campos_irradiados', 'safe', 'on'=>'search'),
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
			'codigo' => 'Codigo',
			'nome' => 'Nome',
			'tipo_agravo' => 'Tipo Agravo',
			'tipo_sexo' => 'Tipo Sexo',
			'tipo_estadio' => 'Tipo Estadio',
			'valor_campos_irradiados' => 'Valor Campos Irradiados',
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
		$criteria->compare('tipo_agravo',$this->tipo_agravo,true);
		$criteria->compare('tipo_sexo',$this->tipo_sexo,true);
		$criteria->compare('tipo_estadio',$this->tipo_estadio,true);
		$criteria->compare('valor_campos_irradiados',$this->valor_campos_irradiados,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}