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
 * @property integer $id_user_asigned
 * @property string $ticket_message_type
 * @property integer $ticket_message_approve
 *
 * The followings are the available model relations:
 * @property Ticket $idTicket
 * @property Users $idUser
 * @property Users $idUserAsigned
 * @property TicketMessageFile[] $ticketMessageFiles
 */
class TicketMessage extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
        public $_verifyCode;
        public $_message_files=array();
        
        
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
			array('id_ticket, id_user ,id_user_asigned, ticket_message_approve', 'numerical', 'integerOnly'=>true),
                        array('ticket_message_type', 'length', 'max'=>45),
			array('ticket_message_date ', 'safe'),
                        array('_message_files','validMessageFile'),
			array('_message_files, id_user_asigned, id_ticket_message, id_ticket, ticket_message, id_user,  ticket_message_file, ticket_message_date, ticket_message_type, ticket_message_approve', 'safe', 'on'=>'search'),
                        array('_verifyCode', 'CaptchaExtendedValidator', 'allowEmpty'=>!CCaptcha::checkRequirements()),
                        array('id_user_asigned','validateid')
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
			'idUsera' => array(self::BELONGS_TO, 'Users', array('id_user_asigned'=>'id_user')),
                        'ticketMessageFiles' => array(self::HAS_MANY, 'TicketMessageFile', 'id_ticket_message'),
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
			'_verifyCode'=>Yii::t('database','Verification Code'),
                        'id_user_asigned'=>Yii::t('database','Id User Asigned'),
                        '_message_files'=>Yii::t('database','Message Files'),
                        'ticket_message_type' => Yii::t('database','Ticket Message Type'),
			'ticket_message_approve' => Yii::t('database','Ticket Message Approve'),
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
		$criteria->compare('id_user_asigned',$this->ticket_message_date,true);
                $criteria->compare('ticket_message_type',$this->ticket_message_type,true);
		$criteria->compare('ticket_message_approve',$this->ticket_message_approve);

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
          public function validateid($model,$attribute)
        {
//            if(empty($this->id_user_asigned))
//                    $this->addError('id_user_asigned', "Ingresar Usuario valido");
        
        }
          public function validMessageFile($model,$attribute)
        {
            $newfile=array();
            if(!empty($this->_message_files)){
                foreach($this->_message_files as $key => $value){
                    $newfile[$value]=$value;
                }
            $this->_message_files=$newfile;
             }
        }
}
