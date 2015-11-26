<?php

/**
 * This is the model class for table "ticket_message_file".
 *
 * The followings are the available columns in table 'ticket_message_file':
 * @property integer $id_ticket_message_file
 * @property string $ticket_message_file_name
 * @property integer $id_ticket_message
 *
 * The followings are the available model relations:
 * @property TicketMessage $idTicketMessage
 */
class TicketMessageFile extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ticket_message_file';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ticket_message_file_name, id_ticket_message', 'required'),
			array('id_ticket_message', 'numerical', 'integerOnly'=>true),
			array('ticket_message_file_name', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_ticket_message_file, ticket_message_file_name, id_ticket_message', 'safe', 'on'=>'search'),
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
			'idTicketMessage' => array(self::BELONGS_TO, 'TicketMessage', 'id_ticket_message'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_ticket_message_file' => Yii::t('database','Id Ticket Message File'),
			'ticket_message_file_name' => Yii::t('database','Ticket Message File Name'),
			'id_ticket_message' => Yii::t('database','Id Ticket Message'),
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

		$criteria->compare('id_ticket_message_file',$this->id_ticket_message_file);
		$criteria->compare('ticket_message_file_name',$this->ticket_message_file_name,true);
		$criteria->compare('id_ticket_message',$this->id_ticket_message);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TicketMessageFile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
