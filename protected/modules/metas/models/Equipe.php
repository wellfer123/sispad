<?php

/**
 * This is the model class for table "Equipe".
 *
 * The followings are the available columns in table 'Equipe':
 * @property integer $codigo_segmento
 * @property integer $codigo_area
 * @property integer $tipo
 * @property string $unidade_cnes
 */
class Equipe extends CActiveRecord
{
        //chave=>valor
         public static $tipos_equipe=array('01'=>'EQUIPE DE SF (SEM BUCAL)','02'=>'ESFSB MODALIDADE I (ESF COM SB MODALIDADE 1)',
                                 '03'=>'ESFSB MODALIDADE II (ESF COM SB MODALIDADE 2)',
                                 '04'=>'EQUIPE DE SF SEM O MÉDICO (INCOMPLETA)',
                                 '05'=>'EQUIPE PENITENCIÁRIA', '06'=>'EQUIPE NASF I', '07'=>'EQUIPE NASF II',
                                 '08'=>'EQUIPE MULTIDISCIPLINAR S. INDIGENA',
                                 '09'=>'EQUIPE MULTIDISCIPLINAR S. INDIGENA NA AMAZÔNIA LEGAL',
                                 '10'=>'EACS COM SB MODALIDADE 1',
                                 '11'=>'EACS COM SB MODALIDADE 2');
        //chave=>valor
        public static  $tipo_segmentos=array('10'=>'10','21'=>'21','22'=>'22','31'=>'31','32'=>'32',
                                    '33'=>'33','40'=>'40','51'=>'51','52'=>'52','53'=>'53');
	/**
	 * Returns the static model of the specified AR class.
	 * @return Equipe the static model class
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
		return 'equipe';
	}

        public $cpf;
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo_area, tipo, unidade_cnes', 'required'),
			array('codigo_segmento, codigo_area, tipo', 'numerical', 'integerOnly'=>true),
			array('unidade_cnes', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('codigo_segmento, codigo_area, tipo, unidade_cnes, codigo_microarea', 'safe', 'on'=>'search'),
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
			'unidade' => array(self::BELONGS_TO, 'Unidade', 'unidade_cnes'),
                        'servidor'=>array(self::HAS_MANY,'Servidor','equipe_codigo_segmento'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'codigo_segmento' => 'Código do Segmento',
			'codigo_area' => 'Código da Área',
			'tipo' => 'Tipo',
			'unidade_cnes' => 'Unidade',
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
                
                $criteria->with='unidade';

		$criteria->compare('codigo_segmento',$this->codigo_segmento);

		$criteria->compare('codigo_area',$this->codigo_area);

		$criteria->compare('tipo',$this->tipo);

		$criteria->compare('unidade_cnes',$this->unidade_cnes,true);

		return new CActiveDataProvider('Equipe', array(
			'criteria'=>$criteria,
		));
	}
        
        public static function getListCodigoArea(){
            $tmp=array();
            //valores
            for($i=0;$i<100;$i++){
                $tmp[$i]=$i;
            }
            return $tmp;
        }

}