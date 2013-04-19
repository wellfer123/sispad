<?php

/**
 * This is the model class for table "unidade_grupo".
 *
 * The followings are the available columns in table 'especialidade_grupo':
 * @property string $profissao_codigo
 * @property integer $grupo_codigo
 */
class EspecialidadeGrupo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UnidadeGrupo the static model class
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
		return 'especialidade_grupo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('grupo_codigo', 'numerical', 'integerOnly'=>true),
			array('profissao_codigo', 'length', 'max'=>6),
                        array('profissao_codigo,grupo_codigo', 'required'),
                        array('profissao_codigo,grupo_codigo', 'validaEspecialidadeGrupoExistente','on'=>'create'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('especialidade_grupo, grupo_codigo', 'safe', 'on'=>'search'),
		);
	}

        
           public function  validaEspecialidadeGrupoExistente($attribute,$params){

             if((EspecialidadeGrupo::model()->find('grupo_codigo= :codigo and profissao_codigo=:profissao',array(':codigo'=>$this->grupo_codigo,':profissao'=>$this->profissao_codigo)))==null){
                 return true;
             }
             $this->addError('','Especialidade/Grupo já existe');
             return false;
        }
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'especialidade' => array(self::BELONGS_TO, 'Profissao', 'profissao_codigo'),
                    'grupo' => array(self::BELONGS_TO, 'Grupo', 'grupo_codigo'),
                    
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'profissao_codigo' => 'Especialidade',
			'grupo_codigo' => 'Grupo',
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

		$criteria->compare('profissao_codigo',$this->profissao_codigo,true);
		$criteria->compare('grupo_codigo',$this->grupo_codigo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}