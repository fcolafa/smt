<?php

/**
 * This is the model class for table "warehouse".
 *
 * The followings are the available columns in table 'warehouse':
 * @property integer $id_weight
 * @property string $amount_warehouse
 * @property integer $id_reception
 * @property integer $id_warehouse
 *
 * The followings are the available model relations:
 * @property Reception $idReception
 * @property Weight $idWeight
 */
class Warehouse extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
        public $_numguide;
        public $_receptionDate;
        public $_weightype;
	public function tableName()
	{
		return 'warehouse';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_weight, id_reception', 'required'),
			array('id_weight, id_reception', 'numerical', 'integerOnly'=>true),
			array('amount_warehouse', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('_weightype, _receptionDate,_numguide,id_weight, amount_warehouse, id_reception, id_warehouse', 'safe', 'on'=>'search'),
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
			'idReception' => array(self::BELONGS_TO, 'Reception', 'id_reception'),
			'idWeight' => array(self::BELONGS_TO, 'Weight', 'id_weight'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_weight' => Yii::t('database','Id Weight'),
			'amount_warehouse' => Yii::t('database','Amount Warehouse'),
			'id_reception' => Yii::t('database','Id Reception'),
			'id_warehouse' => Yii::t('database','Id Warehouse'),
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
		$criteria->compare('amount_warehouse',$this->amount_warehouse,true);
		$criteria->compare('id_reception',$this->id_reception);
		$criteria->compare('id_warehouse',$this->id_warehouse);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        	public function searchHead($id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
                $criteria->with=array('idReception','idWeight.idGuide');
                $criteria->together=true;
                $criteria->condition ='idReception.id_headquarter='.$id;
		$criteria->compare('id_weight',$this->id_weight);
		$criteria->compare('amount_warehouse',$this->amount_warehouse,true);
		$criteria->compare('id_reception',$this->id_reception);
		$criteria->compare('id_warehouse',$this->id_warehouse);
		$criteria->compare('idGuide.num_guide',$this->_numguide,true);
		$criteria->compare('idReception.reception_date',$this->_receptionDate,true);
		$criteria->compare('idReception.weighttype',$this->_weightype,true);
                    
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
          	public function searchToday($id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
                $criteria->with=array('idReception','idWeight.idGuide');
                $criteria->together=true;
                $criteria->condition ='idReception.id_headquarter='.$id;
		$criteria->compare('id_weight',$this->id_weight);
		$criteria->compare('amount_warehouse',$this->amount_warehouse,true);
		$criteria->compare('id_reception',$this->id_reception);
		$criteria->compare('id_warehouse',$this->id_warehouse);
		$criteria->compare('idGuide.num_guide',$this->_numguide,true);
		$criteria->compare('idReception.reception_date',$this->_receptionDate,true);
		$criteria->compare('idReception.weighttype',$this->_weightype,true);
                    
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Warehouse the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
