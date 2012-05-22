<?php

/**
 * This is the model class for table "Servidor_Executa_Item".
 *
 * The followings are the available columns in table 'Servidor_Executa_Item':
 * @property string $servidor_cpf
 * @property integer $item_id
 * @property integer $total
 * @property string $data_inicio
 * @property string $data_fim
 */
class ServidorExecutaItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Servidor_Executa_Item the static model class
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
		return 'servidor_executa_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('servidor_cpf, item_id, total, data_inicio, data_fim', 'required'),
			array('item_id, total', 'numerical', 'integerOnly'=>true),
			array('servidor_cpf', 'length', 'max'=>11),
                        array('servidor_cpf','existe','on'=>'send'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('servidor_cpf, item_id, total, data_inicio, data_fim', 'safe', 'on'=>'search'),
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
                    'item'=>array(self::BELONGS_TO,'Item','item_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'servidor_cpf' => 'Servidor',
			'item_id' => 'Item',
			'total' => 'Total',
			'data_inicio' => 'Data Início',
			'data_fim' => 'Data Fim',
		);
	}
        
       public function existe($attribute, $params) {
         
         $servidor= $this->model()->findByPk(array(
                                                'servidor_cpf'=>$this->servidor_cpf,
                                                'item_id'=>$this->item_id,
                                                'data_inicio'=>ParserDate::inverteDataPtToEn($this->data_inicio),
                                                 'data_fim'=>ParserDate::inverteDataPtToEn($this->data_fim),
                                ));
         if($servidor!=null){
             $this->addError('servidor_cpf',"Já existe uma lançamento desses dados para o servidor informado e o período!");
             return false;
             }
         return true;
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

		$criteria->compare('item_id',$this->item_id);

		$criteria->compare('total',$this->total);

		$criteria->compare('data_inicio',$this->data_inicio,true);

		$criteria->compare('data_fim',$this->data_fim,true);

		return new CActiveDataProvider('Servidor_Executa_Item', array(
			'criteria'=>$criteria,
		));
	}
        
        protected function afterFind() {
            $this->data_fim=ParserDate::inverteDataEnToPt($this->data_fim);
            $this->data_inicio=ParserDate::inverteDataEnToPt($this->data_inicio);
            parent::afterFind();
        }

        protected function beforeSave() {
            $this->data_fim=ParserDate::inverteDataPtToEn($this->data_fim);
            $this->data_inicio=ParserDate::inverteDataPtToEn($this->data_inicio);
            return parent::beforeSave();
        }

}