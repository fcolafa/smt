<?php

/**
 * This is the model class for table "guide".
 *
 * The followings are the available columns in table 'guide':
 * @property integer $id_guide
 * @property integer $id_user
 * @property string $num_guide
 * @property string $pdf_guide
 * @property string $xml_guide
 * @property string $date_guide_create
 * @property integer $id_user
 * @property integer $id_manifest
 *
 * The followings are the available model relations:
 * @property Manifest $idManifest
 * @property Users $idUser
 * @property Headquarters[] $headquarters
 * @property Embarkation[] $embarkations
 */
class Guide extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
    
        public $_send;
     
	public function tableName()
	{
		return 'guide';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('num_guide, date_guide_create, sended_guide, id_user', 'required'),
			array('id_user, sended_guide', 'numerical', 'integerOnly'=>true),
                        array('sended_guide, id_user', 'numerical', 'integerOnly'=>true),
			array('num_guide', 'length', 'max'=>45),
			array('pdf_guide, xml_guide', 'length', 'max'=>60),
                        array('pdf_guide', 'file','types'=>'pdf, PDF', 'allowEmpty'=>true, 'on'=>'update'),
                        array('xml_guide', 'file','types'=>'xml, XML', 'allowEmpty'=>true, 'on'=>'update'),
                        // array('guide', 'length','max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('_send, id_guide, id_user, num_guide, pdf_guide, xml_guide, date_guide_create, sended_guide, id_user, id_manifest', 'safe', 'on'=>'search'),
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
			
                        
                    	'users' => array(self::HAS_MANY, 'Send', 'id_guide'),
                        'sends' => array(self::HAS_MANY, 'Send', 'id_guide'),
			'weights' => array(self::HAS_MANY, 'Weight', 'id_guide'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_guide' => Yii::t('database','Id Guide'),
			'num_guide' => Yii::t('database','Num Guide'),
			'pdf_guide' => Yii::t('database','Pdf Guide'),
			'xml_guide' => Yii::t('database','Xml Guide'),
                        'date_guide_create' => Yii::t('database','Date Guide Create'),
                        'sended_guide' => Yii::t('database','Sended Guide'),
			'id_user' => Yii::t('database','Id User'),
                     
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$criteria=new CDbCriteria;
		$criteria->compare('id_guide',$this->id_guide);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('num_guide',$this->num_guide,true);
		$criteria->compare('pdf_guide',$this->pdf_guide,true);
		$criteria->compare('xml_guide',$this->xml_guide,true);
		$criteria->compare('date_guide_create',$this->date_guide_create,true);
                $criteria->compare('sended_guide',$this->sended_guide);
		$criteria->compare('id_user',$this->id_user);
                
		return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Guide the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
}