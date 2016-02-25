<?php

/**
 * This is the model class for table "schedule".
 *
 * The followings are the available columns in table 'schedule':
 * @property string $id_schedule
 * @property string $schedule_date
 * @property double $initial_stock
 * @property string $ranch_date
 * @property double $ranch_diesel
 * @property double $delivery_DO
 * @property integer $id_headquarter
 * @property double $final_stock
 * @property double $day_comsuption
 * @property double $init_bb_motor
 * @property double $finish_bb_motor
 * @property double $init_eb_motor
 * @property double $finish_eb_motor
 * @property double $total_hours
 * @property double $gen1_hours
 * @property double $gen2_hours
 * @property double $gen3_hours
 * @property string $arrive_date
 * @property double $horometer_bb
 * @property double $horometer_eb
 * @property double $horometer_gen1
 * @property double $horometer_gen2
 * @property double $horometer_gen3
 * @property double $arrive_stock
 * @property double $total_water_charged
 * @property string $earthing
 * @property integer $id_user
 * @property string $notes
 * @property integer $id_embarkation
 *
 * The followings are the available model relations:
 * @property Embarkation $idEmbarkation
 * @property Headquarter $idHeadquarter
 * @property Users $idUser
 */
class Schedule extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
         public $_embarkation_name;
        public $_headquarter_name;
	public function tableName()
	{
		return 'schedule';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_schedule , id_user, id_embarkation', 'required'),
			array('id_headquarter, id_user, id_embarkation', 'numerical', 'integerOnly'=>true),
			array('initial_stock, ranch_diesel, delivery_DO, final_stock, day_comsuption, init_bb_motor, finish_bb_motor, init_eb_motor, finish_eb_motor, total_hours, gen1_hours, gen2_hours, gen3_hours, horometer_bb, horometer_eb, horometer_gen1, horometer_gen2, horometer_gen3, arrive_stock, total_water_charged', 'numerical'),
			array('id_schedule', 'length', 'max'=>100),
			array('schedule_date, ranch_date, arrive_date, earthing, notes', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('_headquarter_name, _embarkation_name,id_schedule, schedule_date, initial_stock, ranch_date, ranch_diesel, delivery_DO, id_headquarter, final_stock, day_comsuption, init_bb_motor, finish_bb_motor, init_eb_motor, finish_eb_motor, total_hours, gen1_hours, gen2_hours, gen3_hours, arrive_date, horometer_bb, horometer_eb, horometer_gen1, horometer_gen2, horometer_gen3, arrive_stock, total_water_charged, earthing, id_user, notes, id_embarkation', 'safe', 'on'=>'search'),
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
			'id_schedule' => Yii::t('database','Id Schedule'),
			'schedule_date' => Yii::t('database','Schedule Date'),
			'initial_stock' => Yii::t('database','Initial Stock'),
			'ranch_date' => Yii::t('database','Ranch Date'),
			'ranch_diesel' => Yii::t('database','Ranch Diesel'),
			'delivery_DO' => Yii::t('database','Delivery Do'),
			'id_headquarter' => Yii::t('database','Id Headquarter'),
			'final_stock' => Yii::t('database','Final Stock'),
			'day_comsuption' => Yii::t('database','Day Comsuption'),
			'init_bb_motor' => Yii::t('database','Init Bb Motor'),
			'finish_bb_motor' => Yii::t('database','Finish Bb Motor'),
			'init_eb_motor' => Yii::t('database','Init Eb Motor'),
			'finish_eb_motor' => Yii::t('database','Finish Eb Motor'),
			'total_hours' => Yii::t('database','Total Hours'),
			'gen1_hours' => Yii::t('database','Gen1 Hours'),
			'gen2_hours' => Yii::t('database','Gen2 Hours'),
			'gen3_hours' => Yii::t('database','Gen3 Hours'),
			'arrive_date' => Yii::t('database','Arrive Date'),
			'horometer_bb' => Yii::t('database','Horometer Bb'),
			'horometer_eb' => Yii::t('database','Horometer Eb'),
			'horometer_gen1' => Yii::t('database','Horometer Gen1'),
			'horometer_gen2' => Yii::t('database','Horometer Gen2'),
			'horometer_gen3' => Yii::t('database','Horometer Gen3'),
			'arrive_stock' => Yii::t('database','Arrive Stock'),
			'total_water_charged' => Yii::t('database','Total Water Charged'),
			'earthing' => Yii::t('database','Earthing'),
			'id_user' => Yii::t('database','Id User'),
			'notes' => Yii::t('database','Notes'),
			'id_embarkation' => Yii::t('database','Id Embarkation'),
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
		$criteria->compare('id_schedule',$this->id_schedule,true);
		$criteria->compare('schedule_date',$this->schedule_date,true);
		$criteria->compare('initial_stock',$this->initial_stock);
		$criteria->compare('ranch_date',$this->ranch_date,true);
		$criteria->compare('ranch_diesel',$this->ranch_diesel);
		$criteria->compare('delivery_DO',$this->delivery_DO);
		$criteria->compare('id_headquarter',$this->id_headquarter);
		$criteria->compare('final_stock',$this->final_stock);
		$criteria->compare('day_comsuption',$this->day_comsuption);
		$criteria->compare('init_bb_motor',$this->init_bb_motor);
		$criteria->compare('finish_bb_motor',$this->finish_bb_motor);
		$criteria->compare('init_eb_motor',$this->init_eb_motor);
		$criteria->compare('finish_eb_motor',$this->finish_eb_motor);
		$criteria->compare('total_hours',$this->total_hours);
		$criteria->compare('gen1_hours',$this->gen1_hours);
		$criteria->compare('gen2_hours',$this->gen2_hours);
		$criteria->compare('gen3_hours',$this->gen3_hours);
		$criteria->compare('arrive_date',$this->arrive_date,true);
		$criteria->compare('horometer_bb',$this->horometer_bb);
		$criteria->compare('horometer_eb',$this->horometer_eb);
		$criteria->compare('horometer_gen1',$this->horometer_gen1);
		$criteria->compare('horometer_gen2',$this->horometer_gen2);
		$criteria->compare('horometer_gen3',$this->horometer_gen3);
		$criteria->compare('arrive_stock',$this->arrive_stock);
		$criteria->compare('total_water_charged',$this->total_water_charged);
		$criteria->compare('earthing',$this->earthing,true);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('id_embarkation',$this->id_embarkation);
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
	 * @return Schedule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
