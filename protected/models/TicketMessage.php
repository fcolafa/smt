<?php

/**
 * This is the model class for table "ticket_message".
 *
 * The followings are the available columns in table 'ticket_message':
 * @property integer $id_ticket_message
 * @property integer $id_ticket
 * @property string $ticket_message
 * @property integer $id_user
 * @property integer $ticket_order
 * @property string $ticket_message_date
 *
 * The followings are the available model relations:
 * @property Ticket $idTicket
 * @property Users $idUser
 */
class TicketMessage extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
        public $_verifyCode;
	public function tableName()
	{
		return 'ticket_message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_ticket, id_user, ticket_message', 'required'),
			array('id_ticket, id_user ', 'numerical', 'integerOnly'=>true),
			array('ticket_message', 'length', 'max'=>45),
			array('ticket_message_date, ticket_message_file', 'safe'),
//                        array('ticket_message_file', 'length', 'max'=>60),
//                        array('ticket_message_file', 'file','types'=>'pdf,PDF,jpeg,jpg,JPEG,JPG,doc','allowEmpty'=>true),
			array('id_ticket_message, id_ticket, ticket_message, id_user,  ticket_message_file, ticket_message_date', 'safe', 'on'=>'search'),
                        array('_verifyCode', 'CaptchaExtendedValidator', 'allowEmpty'=>!CCaptcha::checkRequirements()),
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
			'idTicket' => array(self::BELONGS_TO, 'Ticket', 'id_ticket'),
			'idUser' => array(self::BELONGS_TO, 'Users', 'id_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_ticket_message' => Yii::t('database','Id Ticket Message'),
			'id_ticket' => Yii::t('database','Id Ticket'),
			'ticket_message' => Yii::t('database','Ticket Message'),
			'id_user' => Yii::t('database','Id User'),
			'ticket_message_date' => Yii::t('database','Ticket Message Date'),
			'ticket_message_file' => Yii::t('database','Ticket Message File'),
                    '_verifyCode'=>Yii::t('database','Verification Code'),
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
		$criteria->compare('id_ticket_message',$this->id_ticket_message);
		$criteria->compare('id_ticket',$this->id_ticket);
		$criteria->compare('ticket_message',$this->ticket_message,true);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('ticket_message_date',$this->ticket_message_date,true);
		$criteria->compare('ticket_message_file',$this->ticket_message_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TicketMessage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
