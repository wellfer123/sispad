<?php

/**
 * This is the model class for table "Falta".
 *
 * The followings are the available columns in table 'Falta':
 * @property string $dia
 * @property string $mes
 * @property string $servidor_cpf
 * @property string $data_envio
 * @property string $motivo
 * @property string $motivo_id
 * @property string $ano
 */
class Falta extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @return Falta the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'Falta';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('servidor_cpf', 'length', 'max' => 11),
            array('dia', 'verificaFaltaExistente'),
            // array('mes','ano','dia','required'),
            //array('obs_motivo', 'length', 'max'=>45),
            array('motivo_id', 'length', 'max' => 10),
            //array('data_envio', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('dia, mes, servidor_cpf, data_envio, obs_motivo, motivo_id, ano', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'servidor' => array(self::BELONGS_TO, 'Servidor', 'servidor_cpf'),
            'motivo' => array(self::BELONGS_TO, 'Motivo', 'motivo_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'dia' => 'Dia',
            'mes' => 'Mes',
            'servidor_cpf' => 'Servidor Cpf',
            'data_envio' => 'Data Envio',
            'obs_motivo' => 'Observação',
            'motivo_id' => 'Motivo',
            'ano' => 'Ano',
        );
    }

    public function verificaFaltaExistente($attribute, $params) {

        if ((Falta::model()->findByPk(array('dia' => $this->dia, 'mes' => $this->mes, 'ano' => $this->ano,
            'servidor_cpf'=>$this->servidor_cpf))) == null) {
            return true;
        }
        $this->addError('dia', 'falta ja existe');
        return false;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('dia', $this->dia, true);

        $criteria->compare('mes', $this->mes, true);

        $criteria->compare('servidor_cpf', $this->servidor_cpf, true);

        $criteria->compare('data_envio', $this->data_envio, true);

        $criteria->compare('obs_motivo', $this->obs_motivo, true);

        $criteria->compare('motivo_id', $this->motivo_id, true);

        $criteria->compare('ano', $this->ano, true);

        return new CActiveDataProvider('Falta', array(
            'criteria' => $criteria,
        ));
    }

    public function searchporServidor($servidorCpf, $mes, $ano) {
             
        return new CActiveDataProvider('Falta', array(
            'criteria' => array(
                'select' => 'dia,obs_motivo',
                'condition' => 'servidor_cpf=:servidor_cpf AND mes=:mes AND ano=:ano',
                'params' => array(':servidor_cpf' => $servidorCpf, ':mes' => $mes, ':ano' => $ano),
                'with' => array(
                    'motivo' => array('select' => 'descricao'),
                ),
            ),
        ));
    }

    public function searchporServidor2($servidorCpf, $mes, $ano) {

                $dados=Yii::app()->db->createCommand('select fal.dia, fal.obs_motivo as observacao,mot.descricao
                          
                                                      from falta as fal INNER JOIN motivo as mot
                                                      ON fal.motivo_id = mot.id where fal.servidor_cpf='.$servidorCpf.'
                                                      AND fal.mes='.$mes.' AND fal.ano='.$ano.' ORDER BY fal.dia')->queryAll();

		 $tes=new CArrayDataProvider($dados, array(
                                    'id'=>'falta',
                                    'pagination'=>false

		));
                 $tes->rawData[]=array('dia'=>'','observacao'=>'','descricao'=>'');
                 $tes->rawData[]=array('dia'=>'','observacao'=>'TOTAL DE FALTAS:','descricao'=>$tes->getTotalItemCount()-1);

                 return $tes;

    }

    


}