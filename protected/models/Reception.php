<?php

/**
 * This is the model class for table "reception".
 *
 * The followings are the available columns in table 'reception':
 * @property integer $id_reception
 * @property integer $id_headquarter
 * @property string $recepction_date
 * @property integer $id_embarkation
 * @property integer $id_user
 *
 * The followings are the available model relations:
 * @property Guide[] $guides
 * @property Embarkation $idEmbarkation
 * @property Headquarter $idHeadquarter
 * @property Users $idUser
 */
class Reception extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
        public $_guide;
        public $_guides=array();
	public function tableName()
	{
		return 'reception';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_headquarter, id_user', 'required'),
			array('id_headquarter, id_embarkation, id_user', 'numerical', 'integerOnly'=>true),
			array('reception_date', 'safe'),
                        array('_guides','validGuides'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('_guide, _guides, id_reception, id_headquarter, reception_date, id_embarkation, id_user', 'safe', 'on'=>'search'),
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
			'guides' => array(self::HAS_MANY, 'guide_has_reception', 'id_reception'),
			'idEmbarkation' => array(self::BELONGS_TO, 'Embarkation', 'id_embarkation'),
			'idHeadquarter' => array(self::BELONGS_TO, 'Headquarter', 'id_headquarter'),
			'idUser' => array(self::BELONGS_TO, 'Users', 'id_user'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_reception' => Yii::t('database','Id Reception'),
			'id_headquarter' => Yii::t('database','Id Headquarter'),
			'reception_date' => Yii::t('database','Reception Date'),
			'id_embarkation' => Yii::t('database','Id Embarkation'),
			'id_user' => Yii::t('database','Id User'),
			'_guide' => Yii::t('database','Guide'),
			'_guides' => Yii::t('database','Guides'),
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

		$criteria->compare('id_reception',$this->id_reception);
		$criteria->compare('id_headquarter',$this->id_headquarter);
		$criteria->compare('recepction_date',$this->reception_date,true);
		$criteria->compare('id_embarkation',$this->id_embarkation);
		$criteria->compare('id_user',$this->id_user);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Reception the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
          public function validGuides($model,$attribute)
        {
            $newfile=array();
            if(!empty($this->_guides)){
                foreach($this->_guides as $key => $value){
                    $newfile[$value]=$value;
                }
            $this->_guides=$newfile;
            
             }else
                 if(empty ($this->_guides)){
                     $this->addError('_guide', 'Debe existir al menos una guia asociada');
                 }
        }
}