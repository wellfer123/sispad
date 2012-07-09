<?php

/**
 * This is the model class for table "total_falta".
 *
 * The followings are the available columns in table 'total_falta':
 * @property string $ano
 * @property string $mes
 * @property string $servidor_cpf
 * @property string $quantidade
 */
class TotalFalta extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return total_falta the static model class
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
		return 'total_falta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ano', 'length', 'max'=>4),
			array('mes, quantidade', 'length', 'max'=>2),
			array('servidor_cpf', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ano, mes, servidor_cpf, quantidade', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ano' => 'Ano',
			'mes' => 'Mes',
			'servidor_cpf' => 'Servidor Cpf',
			'quantidade' => 'Quantidade',
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

		$criteria->compare('ano',$this->ano,true);

		$criteria->compare('mes',$this->mes,true);

		$criteria->compare('servidor_cpf',$this->servidor_cpf,true);

		$criteria->compare('quantidade',$this->quantidade,true);

		return new CActiveDataProvider('total_falta', array(
			'criteria'=>$criteria,
		));
	}

         public function searchMensal($mes, $ano) {

        return new CActiveDataProvider('TotalFalta', array(
            'criteria' => array(
                'select' => 'quantidade',
                'condition' => 'mes=:mes AND ano=:ano',
                'params' => array(':mes' => $mes, ':ano' => $ano),
                'with' => array(
                    'servidor'=>array('select'=>'nome')
                ),
            ),
        ));
    }
    
     public function searchMensalPorUnidade($mes, $ano,$unidade_cnes) {

                $dados=Yii::app()->db->createCommand('select serv.nome as nome,serv.cpf as id,serv.unidade_cnes, tot.quantidade as quantidade
                                                      from total_falta as tot INNER JOIN servidor as serv
                                                      ON tot.servidor_cpf = serv.cpf where  tot.mes='.$mes.' AND tot.ano='.$ano.
                                                     ' AND serv.unidade_cnes='.$unidade_cnes.' ORDER BY serv.nome')->queryAll();

		return new CArrayDataProvider($dados, array(
                                    'id'=>'totalfalta',
                                    'pagination'=>false

		));

    }

     public function searchMensal2($mes, $ano,$unidade_cnes=null) {
             
                $dados=Yii::app()->db->createCommand('select serv.nome, tot.quantidade as total
                                                      from total_falta as tot INNER JOIN servidor as serv
                                                      ON tot.servidor_cpf = serv.cpf where  tot.mes='.$mes.' AND tot.ano='.$ano.' AND serv.unidade_cnes='.$unidade_cnes.' ORDER BY serv.nome')->queryAll();

		return new CArrayDataProvider($dados, array(
                                    'id'=>'totalfalta',
                                    'pagination'=>false

		));

    }
}