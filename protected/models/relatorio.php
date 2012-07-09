<?php Yii::import('application.services.FormataData');?>
<?php

/**
 * This is the model class for table "relatorio".
 *
 * The followings are the available columns in table 'relatorio':
 * @property integer $id
 * @property string $arquivo
 * @property string $data_envio
 * @property string $data_trabalho
 * @property integer $servidor_cpf
 */
class Relatorio extends CActiveRecord




{
        public $arquivo;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @return Relatorio the static model class
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
		return 'relatorio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                      
                        //array('arquivo', 'file', 'types'=>'txt,doc,docx,pdf,log'),
                        array('data_trabalho','myRequired','on'=>'create'),
                        array('data_trabalho', 'validaDiferencaDatas','dias'=>7,'on'=>'create'),
                        array('data_trabalho', 'validaRelatorioExistente','on'=>'create'),
                        array('servidor_cpf', 'numerical', 'integerOnly'=>true),
                        
			//array('data_trabalho', 'safe'),
                        
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, data_envio, data_trabalho, servidor_cpf', 'safe', 'on'=>'search'),
		);
	}

       
        public function myRequired($attribute,$params){
            if(($this->data_trabalho==null) ||($this->data_trabalho=="") ){
                $this->addError('data_trabalho','Campo nao pode estar vazio');
                return false;
            }
            return true;

        }
       

        
         public function formataDataDeTrabalho(){
            $dataarray = explode('/',$this->data_trabalho);
            $this->data_trabalho = $dataarray[2] . '/' . $dataarray[1] . '/' . $dataarray[0];
            
        }
       
      
        public function formataDataDeEnvio(){
            //$this->data_envio = strrev($this->data_envio);
        }

         public function  validaRelatorioExistente($attribute,$params){

             if((Relatorio::model()->find('data_trabalho= :data_trabalho',array(':data_trabalho'=>$this->data_trabalho)))==null){
                 return true;
             }
             $this->addError('data_trabalho','relatorio ja existe');
             $this->data_trabalho=  FormataData::inverteData($this->data_trabalho, "/");
             //$this->formataDataDeTrabalho();
             return false;
        }

         public function validaDiferencaDatas($attribute,$params){

            $data_envio = date("d/m/Y");//strtotime("today");
            //$data_trabalho = //new DateTime(FormataData::inverteData($this->data_trabalho, "/"));


            $result = FormataData::calculaDiferencaDatas($data_envio,$this->data_trabalho,"br", "/");//($data_envio - $data_trabalho->getTimestamp())/(60*60*24);
            if(($result >= 0) && ($result <=$params["dias"])){
                $this->data_trabalho=  FormataData::inverteData($this->data_trabalho, "/");
                ////$this->formataDataDeTrabalho();
                return true;
            }
            $this->addError('data_trabalho','Data inválida. Insira uma data de até 7 dias até a data atual ');
            return false;

        }

       /* public function beforeSave()
    {
        $file=CUploadedFile::getInstance($this,'file_data');
        if(!$file->error){
            
           // $arquivo= new Arquivo();
            $this->arquivo->file_name=$file->name;
            $this->arquivo->file_type=$file->type;
            $this->arquivo->file_size=$file->size;
            $this->arquivo->file_data=file_get_contents($file->getTempName());
            $this->arquivo->relatorio_id=$this->id;

        }

            return parent::beforeSave();

    }**/


	/**
	 * @return array relational rules.
	 */


        protected function afterSave() {
              /*$file=CUploadedFile::getInstance($this->arquivo,'file_data');
            if(!$file->error){

               // $arquivo= new Arquivo();
                $this->arquivo->file_name=$file->name;
                $this->arquivo->file_type=$file->type;
                $this->arquivo->file_size=$file->size;
                $this->arquivo->file_data=file_get_contents($file->getTempName());
                $this->arquivo->relatorio_id=$this->id;
                $this->arquivo->save();
            }*/
         return parent::afterSave();
       }


       public function salvaArquivo(){
            $file=CUploadedFile::getInstance($this->arquivo,'file_data');
            if(!$file->error){

              
                $this->arquivo->file_name=$file->name;
                $this->arquivo->file_type=$file->type;
                $this->arquivo->file_size=$file->size;
                $this->arquivo->file_data=file_get_contents($file->getTempName());
                $this->arquivo->relatorio_id=$this->id;
                if($this->arquivo->save()){
                    return true;
                }
                return false;
            }
       }

         public function atualizaArquivo(){
            $file=CUploadedFile::getInstance($this->arquivo,'file_data');
            if(!$file->error){

               
                $this->arquivo->file_name=$file->name;
                $this->arquivo->file_type=$file->type;
                $this->arquivo->file_size=$file->size;
                $this->arquivo->file_data=file_get_contents($file->getTempName());
                
                if($this->arquivo->save()){
                    return true;
                }
                return false;
            }
       }
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'servidor'=>array(self::BELONGS_TO, 'servidor', 'servidor_cpf'),
                    'temp_arquivo'=>array(self::HAS_ONE, 'arquivo', 'relatorio_id'),
		);
	}

       

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Código',
			//'file_data' => 'Arquivo',
			'data_envio' => 'Data de Envio',
			'data_trabalho' => 'Data de Trabalho',
			'servidor_cpf' => 'Servidor',
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

		$criteria->compare('id',$this->id);

		//$criteria->compare('file_data',$this->file_data,true);

		$criteria->compare('data_envio',$this->data_envio,true);

		$criteria->compare('data_trabalho',  ParserDate::inverteDataPtToEn($this->data_trabalho,true));

		$criteria->compare('servidor_cpf',Yii::app()->user->cpfservidor);

                


		return new CActiveDataProvider('relatorio', array(
			'criteria'=>$criteria,
		));
	}
        public function searchAll()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		//$criteria->compare('file_data',$this->file_data,true);

		$criteria->compare('data_envio',$this->data_envio,true);

		$criteria->compare('data_trabalho',$this->data_trabalho,true);

		$criteria->compare('servidor_cpf',  $this->servidor_cpf);
                //$criteria->compare('servidor_cpf',  $this->getServidorName($this->servidor_cpf));

               

		return new CActiveDataProvider('relatorio', array(
			'criteria'=>$criteria,
		));
	}

     
        
        public function getServidorName($servidor_cpf){

            if(empty ($servidor_cpf))return null;

            $criteria=new CDbCriteria;
            $criteria->select='nome'; //select id field
            $criteria->compare('cpf',$servidor_cpf,true);
            $ser=Servidor::model()->find($criteria);

            return $ser->attributes['nome'];

        }
}