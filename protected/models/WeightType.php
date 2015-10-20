<?php

/**
 * This is the model class for table "weight_type".
 *
 * The followings are the available columns in table 'weight_type':
 * @property integer $id_weight_type
 * @property string $weight_type_name
 *
 * The followings are the available model relations:
 * @property Weight[] $weights
 */
class WeightType extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'weight_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('weight_type_name', 'required'),
			array('id_weight_type', 'numerical', 'integerOnly'=>true),
			array('weight_type_name', 'length', 'max'=>45),
                        array('weight_type_name', 'unique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_weight_type, weight_type_name', 'safe', 'on'=>'search'),
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
			'weights' => array(self::HAS_MANY, 'Weight', 'id_weight_type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_weight_type' => Yii::t('database','Id Weight Type'),
			'weight_type_name' => Yii::t('database','Weight Type Name'),
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

		$criteria->compare('id_weight_type',$this->id_weight_type);
		$criteria->compare('weight_type_name',$this->weight_type_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return WeightType the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
