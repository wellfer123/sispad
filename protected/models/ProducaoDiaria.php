<?php

/**
 * This is the model class for table "producao_diaria".
 *
 * The followings are the available columns in table 'producao_diaria':
 * @property string $unidade_cnes
 * @property string $servidor_cpf
 * @property string $profissao_codigo
 * @property string $quantidade
 * @property string $profissional_cpf
 * @property string $grupo_codigo
 * @property string $data
 * @property string $detalhe
 *
 * The followings are the available model relations:
 * @property Unidade $unidade
 * @property Servidor $gestor
 * @property Servidor $profissional
 * @property Profissao $profissaoCodigo
 * @property Grupo $grupo
 */
class ProducaoDiaria extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ProducaoDiaria the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'producao_diaria';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('unidade_cnes,grupo_codigo, profissional_cpf,servidor_cpf, quantidade,profissao_codigo, data', 'required'),
            array('unidade_cnes, profissional_cpf, observacao_codigo,grupo_codigo,servidor_cpf, quantidade', 'numerical', 'integerOnly' => true),
            array('unidade_cnes', 'length', 'min' => 7, 'max' => 7),
            array('servidor_cpf, profissional_cpf', 'length', 'min' => 11, 'max' => 11),
            array('profissao_codigo', 'length', 'min' => 6, 'max' => 6),
            array('quantidade', 'length', 'min' => 1, 'max' => 5),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('unidade_cnes,detalhe, observacao_codigo,grupo_codigo,profissional_cpf,servidor_cpf, profissao_codigo, quantidade, data', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'unidade' => array(self::BELONGS_TO, 'Unidade', 'unidade_cnes'),
            'gestor' => array(self::BELONGS_TO, 'Servidor', 'servidor_cpf'),
            'grupo' => array(self::BELONGS_TO, 'Grupo', 'grupo_codigo'),
            'profissional' => array(self::BELONGS_TO, 'Servidor', 'profissional_cpf'),
            'especialidade' => array(self::BELONGS_TO, 'Profissao', 'profissao_codigo'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'unidade_cnes' => 'Unidade',
            'servidor_cpf' => 'Gestor',
            'detalhe' => 'Detalhe',
            'profissao_codigo' => 'Especialidade',
            'quantidade' => 'Quantidade',
            'grupo_codigo' => 'Grupo',
            'observacao_codigo' => 'Observação',
            'profissional_cpf' => 'Profissional',
            'data' => 'Data',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search($unidades = null) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
        $condition = null;
        $cont = 0;
        $params = array();

        if ($unidades != null) {
            if (is_array($unidades)) {
                $condition = 'pd.unidade_cnes IN (';
                //cria os parâmetros
                foreach ($unidades as $cnes => $nome) {
                    if ($cont > 0) {
                        $condition = $condition . ",:$cnes ";
                    } else {
                        $condition = $condition . " :$cnes ";
                    }
                    //seta o valor do parâmetro
                    $params[':' . $cnes] = $cnes;
                    $cont++;
                }
                $condition = $condition . ")";
            }
        }
        $criteria = new CDbCriteria;
        $criteria->alias = 'pd';
        $criteria->compare('pd.unidade_cnes', $this->unidade_cnes, true);
        $criteria->compare('pd.servidor_cpf', $this->servidor_cpf, true);
        $criteria->compare('pd.profissao_codigo', $this->profissao_codigo, true);
       //$criteria->compare('pd.quantidade', $this->quantidade, true);
        //inverte a data para o formatado estadunidense
        if ($this->data != null){
            $criteria->compare('pd.data', ParserDate::inverteDataPtToEn( $this->data), true);
        }
        $criteria->with = array('unidade', 'especialidade','grupo', 'profissional');

        
        if ($cont > 0) {
            $criteria->condition=$condition;
            $criteria->params = $params;
        }
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    
    

    public function getMaisRecente() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->alias = 'pd';

        $criteria->compare('pd.unidade_cnes', $this->unidade_cnes, true);
        $criteria->compare('pd.servidor_cpf', $this->servidor_cpf, true);
        $criteria->addBetweenCondition('pd.data', '' . Date('Y-m-d', strtotime("- 20days")) . '', '' . Date('Y-m-d') . '');
        $criteria->with = array('especialidade','grupo', 'profissional', 'unidade');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Devolve um CActiveDataProvider com toda a produção das unidades passadas como parâmetro.
     * @param array $unidades um array associativo de unidade. A chave é o CNES
     * @param boolean $maisRecente se for true devolve as produções dos últimos 20 dias
     *  baseado na data atual.
     * @param date $data data no formato d/m/Y.Exemplo: 22/03/2013
     * @return \CActiveDataProvider
     */
    public static function findAllPorUnidades($unidades, $maisRecente = true,$data=NULL) {
        $condition = null;
        $cont = 0;
        $params = array();
        if (is_array($unidades)) {
            $condition = 'pd.unidade_cnes IN (';
            //cria os parâmetros
            foreach ($unidades as $cnes => $nome) {
                if ($cont > 0) {
                    $condition = $condition . ",:$cnes ";
                } else {
                    $condition = $condition . " :$cnes ";
                }
                //seta o valor do parâmetro
                $params[':' . $cnes] = $cnes;
                $cont++;
            }
            $condition = $condition . ")";
        }

        $criteria = new CDbCriteria;
        $criteria->alias = 'pd';
        $criteria->condition = $condition;
        if ($cont > 0) {
            $criteria->params = $params;
        }
        if ($maisRecente == true) {
            if ($data == null){
                //data atual
            $criteria->addBetweenCondition('pd.data', '' . Date('Y-m-d', strtotime("- 20days")) . '', '' . Date('Y-m-d') . '');
            }
            //foi passada uma data
            else{
               $data=  explode('/', $data);                                 //2 dias atrás                                                          //um dia mais
               $criteria->addBetweenCondition('pd.data', '' . Date('Y-m-d',mktime(0,0,0,$data[1],$data[0]-2,$data[2])) . '', '' . Date('Y-m-d',mktime(0,0,0,$data[1],$data[0]+1,$data[2])) . '');
            }
        }
        $criteria->with = array('especialidade', 'profissional', 'unidade');

        //$criteria->com
        return new CActiveDataProvider('ProducaoDiaria', array(
            'criteria' => $criteria,
        ));
    }

}