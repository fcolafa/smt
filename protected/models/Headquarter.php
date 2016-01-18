<?php

/**
 * This is the model class for table "headquarter".
 *
 * The followings are the available columns in table 'headquarter':
 * @property integer $id_headquarter
 * @property integer $id_user
 * @property integer $id_area
 * @property string $headquarter_name
 * @property string $headquarter_location
 * @property string $headquarter_type
 * @property integer $id_company
 *
 * The followings are the available model relations:
 * @property Bridge[] $bridges
 * @property Guide[] $guides
 * @property Area $idArea
 * @property Company $idCompany
 * @property Users $idUser
 * @property Reception[] $receptions
 * @property Schedule[] $schedules
 * @property Ticket[] $tickets
 */
class Headquarter extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
      public $_company;
	public function tableName()
	{
		return 'headquarter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('headquarter_name, id_company', 'required'),
			array('id_user, id_area, id_company', 'numerical', 'integerOnly'=>true),
			array('headquarter_name, headquarter_location, headquarter_type', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('_company, id_headquarter, id_user, id_area, headquarter_name, headquarter_location, headquarter_type, id_company', 'safe', 'on'=>'search'),
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
			'bridges' => array(self::HAS_MANY, 'Bridge', 'id_headquarter'),
			'guides' => array(self::HAS_MANY, 'Guide', 'id_headquarter'),
			'idArea' => array(self::BELONGS_TO, 'Area', 'id_area'),
			'idCompany' => array(self::BELONGS_TO, 'Company', 'id_company'),
			'idUser' => array(self::BELONGS_TO, 'Users', 'id_user'),
			'receptions' => array(self::HAS_MANY, 'Reception', 'id_headquarter'),
			'schedules' => array(self::HAS_MANY, 'Schedule', 'id_headquarter'),
			'tickets' => array(self::HAS_MANY, 'Ticket', 'id_headquarter'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_headquarter' => Yii::t('database','Id Headquarter'),
			'id_user' => Yii::t('database','Id User'),
			'id_area' => Yii::t('database','Id Area'),
			'headquarter_name' => Yii::t('database','Headquarter Name'),
			'headquarter_location' => Yii::t('database','Headquarter Location'),
			'headquarter_type' => Yii::t('database','Headquarter Type'),
			'id_company' => Yii::t('database','Id Company'),
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
                $criteria->with=array('idCompany');
                $criteria->together=true;
                
		$criteria->compare('id_headquarter',$this->id_headquarter);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_area',$this->id_area);
		$criteria->compare('headquarter_name',$this->headquarter_name,true);
		$criteria->compare('headquarter_location',$this->headquarter_location,true);
		$criteria->compare('headquarter_type',$this->headquarter_type,true);
		$criteria->compare('id_company',$this->id_company);
                $criteria->compare('idCompany.company_name',$this->_company,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Headquarter the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}