<?php

/**
 * This is the model class for table "weight".
 *
 * The followings are the available columns in table 'weight':
 * @property integer $id_weight
 * @property integer $id_provider
 * @property integer $id_weight_type
 * @property integer $id_weight_unit
 * @property integer $amount_weight
 * @property integer $id_guide
 *
 * The followings are the available model relations:
 * @property Guide $idGuide
 * @property Provider $idProvider
 * @property WeightType $idWeightType
 * @property WeightUnit $idWeightUnit
 */
class Weight extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'weight';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_weight_unit, amount_weight', 'required'),
			array('id_provider, id_weight_type, id_weight_unit, amount_weight, id_guide', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array(' weightprovider, weighttype,id_weight, id_provider, id_weight_type, id_weight_unit, amount_weight, id_guide', 'safe', 'on'=>'search'),
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
			'idGuide' => array(self::BELONGS_TO, 'Guide', 'id_guide'),
			'idProvider' => array(self::BELONGS_TO, 'Provider', 'id_provider'),
			'idWeightType' => array(self::BELONGS_TO, 'WeightType', 'id_weight_type'),
			'idWeightUnit' => array(self::BELONGS_TO, 'WeightUnit', 'id_weight_unit'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_weight' => Yii::t('database','Id Weight'),
			'id_provider' => Yii::t('database','Id Provider'),
			'id_weight_type' => Yii::t('database','Id Weight Type'),
			'id_weight_unit' => Yii::t('database','Id Weight Unit'),
			'amount_weight' => Yii::t('database','Amount Weight'),
			'id_guide' => Yii::t('database','Id Guide'),
                        'weighttype' => Yii::t('database','Weight Type'),
			'weightprovider' => Yii::t('database','Provider'),
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

		$criteria->compare('id_weight',$this->id_weight);
		$criteria->compare('id_provider',$this->id_provider);
		$criteria->compare('id_weight_type',$this->id_weight_type);
		$criteria->compare('id_weight_unit',$this->id_weight_unit);
		$criteria->compare('amount_weight',$this->amount_weight);
		$criteria->compare('id_guide',$this->id_guide);
		$criteria->compare('weightprovider',$this->weightprovider);
		$criteria->compare('weighttype',$this->weighttype);
                

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Weight the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
