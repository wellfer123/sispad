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
			array('data_admissao, carga_horaria, salario', 'required'),
			array('carga_horaria', 'numerical', 'integerOnly'=>true),
			array('servidor_cpf, pis', 'length', 'max'=>11),
			array('turno, vinculo', 'length', 'max'=>1),
			array('profissao, conselho_classe', 'length', 'max'=>20),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'servidor_cpf' => 'Servidor Cpf',
			'data_admissao' => 'Data Admissao',
			'pis' => 'Pis',
			'carga_horaria' => 'Carga Horaria',
			'turno' => 'Turno',
			'profissao' => 'Profissao',
			'salario' => 'Salario',
			'conselho_classe' => 'Conselho Classe',
			'data_afastamento' => 'Data Afastamento',
			'data_retorno' => 'Data Retorno',
			'situacao_funcional' => 'Situacao Funcional',
			'vinculo' => 'Vinculo',
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

		$criteria->compare('data_admissao',$this->data_admissao,true);

		$criteria->compare('pis',$this->pis,true);

		$criteria->compare('carga_horaria',$this->carga_horaria);

		$criteria->compare('turno',$this->turno,true);

		$criteria->compare('profissao',$this->profissao,true);

		$criteria->compare('salario',$this->salario,true);

		$criteria->compare('conselho_classe',$this->conselho_classe,true);

		$criteria->compare('data_afastamento',$this->data_afastamento,true);

		$criteria->compare('data_retorno',$this->data_retorno,true);

		$criteria->compare('situacao_funcional',$this->situacao_funcional,true);

		$criteria->compare('vinculo',$this->vinculo,true);

		return new CActiveDataProvider('Dados_Trabalho', array(
			'criteria'=>$criteria,
		));
	}
}