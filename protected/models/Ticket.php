<?php
/**
 * This is the model class for table "ticket".
 *
 * The followings are the available columns in table 'ticket':
 * @property integer $id_ticket
 * @property integer $id_embarkation
 * @property integer $id_user
 * @property integer $id_classification
 * @property string $ticket_date
 * @property string $ticket_description
 * @property string $ticket_status
 *
 * The followings are the available model relations:
 * @property Classification $idClassification
 * @property Embarkation $idEmbarkation
 * @property Users $idUser
 */
class Ticket extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
        public $_verifyCode;
        public function tableName()
	{
		return 'ticket';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_embarkation, id_user, ticket_date,ticket_date_incident ,ticket_description', 'required'),
			array('id_embarkation, id_headquarter, id_user', 'numerical', 'integerOnly'=>true),
			array('ticket_status', 'length', 'max'=>45),
                        array('ticket_file', 'length', 'max'=>60),
                        array('ticket_file', 'file','types'=>'pdf,PDF,jpeg,jpg,JPEG,JPG,doc','allowEmpty'=>true),
                        array('_verifyCode', 'CaptchaExtendedValidator', 'allowEmpty'=>!CCaptcha::checkRequirements()),
                        array('id_ticket, id_embarkation, id_user,  ticket_date, ticket_description, ticket_status', 'safe', 'on'=>'search'),
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
			'idUser' => array(self::BELONGS_TO, 'Users', 'id_user'),
			'idTicketMessage' => array(self::HAS_MANY, 'TicketMessage', 'id_ticket'),
			'idHeadquarter' => array(self::BELONGS_TO, 'Headquarter', 'id_headquarter'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_ticket' => Yii::t('database','Id Ticket'),
			'id_embarkation' => Yii::t('database','Embarkation'),
			'id_headquarter' => Yii::t('database','Headquarter'),
			'id_user' => Yii::t('database','Id User'),
			'ticket_date' => Yii::t('database','Ticket Date'),
			'ticket_description' => Yii::t('database','Ticket Description'),
			'ticket_status' => Yii::t('database','Ticket Status'),
                        '_verifyCode'=>Yii::t('database','Verification Code'),
                        'ticket_file'=>Yii::t('database','Ticket File'),
                        'ticket_date_incident'=>Yii::t('database','Ticket Date Incident'),
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
		$criteria->compare('id_ticket',$this->id_ticket);
		$criteria->compare('id_embarkation',$this->id_embarkation);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('ticket_date',$this->ticket_date,true);
		$criteria->compare('ticket_description',$this->ticket_description,true);
		$criteria->compare('ticket_status',$this->ticket_status,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ticket the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}