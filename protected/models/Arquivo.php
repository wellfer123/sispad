<?php

/**
 * This is the model class for table "Arquivo".
 *
 * The followings are the available columns in table 'Arquivo':
 * @property string $relatorio_id
 * @property string $file_data
 * @property string $file_name
 * @property string $file_type
 * @property string $file_size
 */
class Arquivo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Arquivo the static model class
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
		return 'Arquivo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        //array('file_data','required'),
                        array('file_data', 'file', 'types'=>'txt,doc,docx,pdf,log'),
			//array('relatorio_id', 'length', 'max'=>11),
			//array('file_name', 'length', 'max'=>45),
			//array('file_type', 'length', 'max'=>200),
			//array('file_size', 'length', 'max'=>10),
			//array('file_data', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('relatorio_id, file_data, file_name, file_type, file_size', 'safe', 'on'=>'search'),
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
			'relatorio' => array(self::BELONGS_TO, 'Relatorio', 'relatorio_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'relatorio_id' => 'Relatorio',
			'file_data' => 'Arquivo',
			'file_name' => 'File Name',
			'file_type' => 'File Type',
			'file_size' => 'File Size',
		);
	}

       

        protected function beforeSave() {
             $file=CUploadedFile::getInstance($this,'file_data');
            if(!$file->error){
                $this->file_name=$file->name;
                $this->file_type=$file->type;
                $this->file_size=$file->size;
                $this->file_data=file_get_contents($file->getTempName());
              
               
            }
            return parent::beforeSave();
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

		$criteria->compare('relatorio_id',$this->relatorio_id,true);

		$criteria->compare('file_data',$this->file_data,true);

		$criteria->compare('file_name',$this->file_name,true);

		$criteria->compare('file_type',$this->file_type,true);

		$criteria->compare('file_size',$this->file_size,true);

		return new CActiveDataProvider('Arquivo', array(
			'criteria'=>$criteria,
		));
	}
}