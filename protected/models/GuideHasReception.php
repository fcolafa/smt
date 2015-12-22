<?php

/**
 * This is the model class for table "guide_has_reception".
 *
 * The followings are the available columns in table 'guide_has_reception':
 * @property integer $id_guide
 * @property integer $id_reception
 */
class GuideHasReception extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
         public $_date;
	public function tableName()
	{
		return 'guide_has_reception';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_guide, id_reception', 'required'),
			array('id_guide, id_reception', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('_date ,id_guide, id_reception', 'safe', 'on'=>'search'),
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
                      'idReception' => array(self::BELONGS_TO, 'Reception', 'id_reception'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_guide' => Yii::t('database','Id Guide'),
			'id_reception' => Yii::t('database','Id Reception'),
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
		$criteria->compare('id_reception',$this->id_reception);
               
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GuideHasReception the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
           public function getSolutionFile (){
            $criteria=new CDbCriteria();
            $criteria->condition = 't.id_ticket='.$this->id_ticket;
            $ticketsfile= TicketSolutionFile::model()->findall($criteria);
            $link="";
            foreach($ticketsfile as $t){
            $link.=CHtml::link(CHtml::encode($t->ticket_solution_file_name), Yii::app()->baseUrl . '/images/tickets_solution/'.$t->id_ticket."/" . $t->ticket_solution_file_name,array('target'=>'_blank'))."<br>";
            }
            if($ticketsfile)
            return $link;
            else
                return null;
        }
        
}
