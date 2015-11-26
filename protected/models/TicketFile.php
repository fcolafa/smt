<?php

/**
 * This is the model class for table "ticket_file".
 *
 * The followings are the available columns in table 'ticket_file':
 * @property integer $id_ticket_file
 * @property string $ticket_file_name
 * @property integer $id_ticket
 *
 * The followings are the available model relations:
 * @property Ticket $idTicket
 */
class TicketFile extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ticket_file';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ticket_file_name, id_ticket', 'required'),
			array('id_ticket', 'numerical', 'integerOnly'=>true),
			array('ticket_file_name', 'length', 'max'=>60),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_ticket_file, ticket_file_name, id_ticket', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_ticket_file' => Yii::t('database','Id Ticket File'),
			'ticket_file_name' => Yii::t('database','Ticket File Name'),
			'id_ticket' => Yii::t('database','Id Ticket'),
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

		$criteria->compare('id_ticket_file',$this->id_ticket_file);
		$criteria->compare('ticket_file_name',$this->ticket_file_name,true);
		$criteria->compare('id_ticket',$this->id_ticket);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TicketFile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
