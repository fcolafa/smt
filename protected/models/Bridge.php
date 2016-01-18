<?php

/**
 * This is the model class for table "bridge".
 *
 * The followings are the available columns in table 'bridge':
 * @property string $id_bridge
 * @property integer $id_headquarter
 * @property string $bridge_date_arrive
 * @property string $init_charge_time
 * @property string $finish_charge_time
 * @property string $bridge_date_sailing
 * @property integer $id_user
 * @property string $bridge_notes
 * @property string $bridge_date
 * @property integer $id_embarkation
 *
 * The followings are the available model relations:
 * @property Embarkation $idEmbarkation
 * @property Headquarter $idHeadquarter
 * @property Users $idUser
 */
class Bridge extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
        public $_embarkation_name;
        public $_headquarter_name;
	public function tableName()
	{
		return 'bridge';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_bridge, id_headquarter, id_user, id_embarkation', 'required'),
			array('id_headquarter, id_user, id_embarkation', 'numerical', 'integerOnly'=>true),
			array('id_bridge', 'length', 'max'=>100),
                        array('navigated_miles', 'numerical'),
                        array('id_bridge','validateDate'),
			array('bridge_date,sbridge_date_arrive, init_charge_time, finish_charge_time, bridge_date_sailing, bridge_notes, bridge_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('_headquarter_name, _embarkation_name,id_bridge, id_headquarter, bridge_date_arrive, navigated_miles ,init_charge_time, finish_charge_time, bridge_date_sailing, id_user, bridge_notes, bridge_date, id_embarkation', 'safe', 'on'=>'search'),
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
			'id_bridge' => Yii::t('database','Id Bridge'),
			'id_headquarter' => Yii::t('database','Id Headquarter'),
			'bridge_date_arrive' => Yii::t('database','Bridge Date Arrive'),
			'init_charge_time' => Yii::t('database','Init Charge Time'),
			'finish_charge_time' => Yii::t('database','Finish Charge Time'),
			'bridge_date_sailing' => Yii::t('database','Bridge Date Sailing'),
			'id_user' => Yii::t('database','Id User'),
			'bridge_notes' => Yii::t('database','Bridge Notes'),
			'bridge_date' => Yii::t('database','Bridge Date'),
			'id_embarkation' => Yii::t('database','Id Embarkation'),
                        'navigated_miles' => Yii::t('database','Navigated Miles'),
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
                $criteria->with=array('idUser','idEmbarkation','idHeadquarter');
                $criteria->together=true;
		$criteria->compare('id_bridge',$this->id_bridge,true);
		$criteria->compare('id_headquarter',$this->id_headquarter);
		$criteria->compare('bridge_date_arrive',$this->bridge_date_arrive,true);
		$criteria->compare('init_charge_time',$this->init_charge_time,true);
		$criteria->compare('finish_charge_time',$this->finish_charge_time,true);
		$criteria->compare('bridge_date_sailing',$this->bridge_date_sailing,true);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('bridge_notes',$this->bridge_notes,true);
		$criteria->compare('bridge_date',$this->bridge_date,true);
		$criteria->compare('id_embarkation',$this->id_embarkation);
                $criteria->compare('navigated_miles',$this->navigated_miles);
                $criteria->compare('idEmbarkation.embarkation_name', $this->_embarkation_name,true);
		$criteria->compare('idHeadquarter.headquarter_name', $this->_headquarter_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Bridge the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
            public function validateDate($model,$attribute)
        {
            if(!empty($this->bridge_date_arrive)&& !empty($this->bridge_date_sailing)){
            $date=Yii::app()->dateFormatter->format('yy-MM-dd HH:mm',$this->bridge_date_arrive);
            $datef=Yii::app()->dateFormatter->format('yy-MM-dd HH:mm',$this->bridge_date_sailing);
            $datetime1 = new DateTime($date);
            $datetime2 = new DateTime($datef);
            if($datetime1 > $datetime2){
                $this->addError('bridge_date_arrive', "la Fecha y Hora de recalada no puede ser superior a la fecha de zarpe");
                $this->addError('bridge_date_sailing', "la Fechay Hora de recalada no puede ser superior a la fecha de zarpe");
            }
            }
        }
         
}
