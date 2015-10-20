<?php

/**
 * This is the model class for table "labor".
 *
 * The followings are the available columns in table 'labor':
 * @property string $id_labor
 * @property integer $id_location
 * @property integer $id_embarkation
 * @property integer $id_user
 * @property string $date_labor
 * @property string $time_arrive
 * @property string $time_sailing
 * @property string $init_charge
 * @property string $end_charge
 * @property integer $navigation_miles
 * @property string $observations
 *
 * The followings are the available model relations:
 * @property Embarkation $idEmbarkation
 * @property Location $idLocation
 * @property Users $idUser
 */
class Labor extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'labor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_labor, id_location, id_embarkation, id_user', 'required'),
			array('id_location, id_embarkation, id_user, navigation_miles', 'numerical', 'integerOnly'=>true),
			array('id_labor', 'length', 'max'=>45),
			array('date_labor, time_arrive, time_sailing, init_charge, end_charge, observations', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_labor, id_location, id_embarkation, id_user, date_labor, time_arrive, time_sailing, init_charge, end_charge, navigation_miles, observations', 'safe', 'on'=>'search'),
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
			'idEmbarkation' => array(self::BELONGS_TO, 'Embarkation', 'id_embarkation'),
			'idLocation' => array(self::BELONGS_TO, 'Location', 'id_location'),
			'idUser' => array(self::BELONGS_TO, 'Users', 'id_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_labor' => Yii::t('database','Id Labor'),
			'id_location' => Yii::t('database','Id Location'),
			'id_embarkation' => Yii::t('database','Id Embarkation'),
			'id_user' => Yii::t('database','Id User'),
			'date_labor' => Yii::t('database','Date Labor'),
			'time_arrive' => Yii::t('database','Time Arrive'),
			'time_sailing' => Yii::t('database','Time Sailing'),
			'init_charge' => Yii::t('database','Init Charge'),
			'end_charge' => Yii::t('database','End Charge'),
			'navigation_miles' => Yii::t('database','Navigation Miles'),
			'observations' => Yii::t('database','Observations'),
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

		$criteria->compare('id_labor',$this->id_labor,true);
		$criteria->compare('id_location',$this->id_location);
		$criteria->compare('id_embarkation',$this->id_embarkation);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('date_labor',$this->date_labor,true);
		$criteria->compare('time_arrive',$this->time_arrive,true);
		$criteria->compare('time_sailing',$this->time_sailing,true);
		$criteria->compare('init_charge',$this->init_charge,true);
		$criteria->compare('end_charge',$this->end_charge,true);
		$criteria->compare('navigation_miles',$this->navigation_miles);
		$criteria->compare('observations',$this->observations,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Labor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
