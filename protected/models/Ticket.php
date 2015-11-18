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
        public $_user_name;
        public $_embarkation_name;
        public $_headquarter_name;
        public $_user_names;
        public $_user_lastnames;
        
        
        
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
			array('id_embarkation, id_user, ticket_subject,id_classification ,ticket_date,ticket_date_incident ,ticket_description', 'required'),
                        array('ticket_solution','requiredSolution'),
			array('id_embarkation, id_headquarter, id_user, id_classification', 'numerical', 'integerOnly'=>true),
			array('ticket_status', 'length', 'max'=>45),
			array('ticket_subject', 'length', 'max'=>45),
                        array('ticket_file', 'length', 'max'=>60),
                        array('ticket_solution_file', 'length', 'max'=>60),
                        array('ticket_date_incident','validatetime'),
                        array('id_headquarter','validateId'),
                        array('_verifyCode', 'CaptchaExtendedValidator', 'allowEmpty'=>!CCaptcha::checkRequirements()),
                        array('ticket_solution_file,id_classification,_days,ticket_file,_user_lastnames,_user_names,_headquarter_name,_embarkation_name,_user_name, id_ticket, id_embarkation, id_user,  ticket_date, ticket_date_incident, ticket_description, ticket_solution, ticket_status', 'safe', 'on'=>'search'),
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
			'idClassification' => array(self::BELONGS_TO, 'Classification', 'id_classification'),
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
			'ticket_subject' => Yii::t('database','Ticket Subject'),
			'ticket_description' => Yii::t('database','Ticket Description'),
			'ticket_status' => Yii::t('database','Ticket Status'),
                        '_verifyCode'=>Yii::t('database','Verification Code'),
                        'ticket_file'=>Yii::t('database','Ticket File'),
                        'ticket_date_incident'=>Yii::t('database','Ticket Date Incident'),
                        'ticket_solution'=>Yii::t('database','Ticket Solution'),
                        'id_classification'=>Yii::t('database','Classification'),
                        'ticket_solution_file'=>Yii::t('database','Ticket Solution File'),
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
		$criteria->compare('id_ticket',$this->id_ticket);
		$criteria->compare('id_embarkation',$this->id_embarkation);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('ticket_date',$this->ticket_date,true);
		$criteria->compare('ticket_subject',$this->ticket_subject,true);
		$criteria->compare('ticket_date_incident',$this->ticket_date_incident,true);
		$criteria->compare('ticket_description',$this->ticket_description,true);
		$criteria->compare('ticket_status',$this->ticket_status,true);
		$criteria->compare('ticket_solution',$this->ticket_solution,true);
		$criteria->compare('ticket_file',$this->ticket_file,true);
		$criteria->compare('idUser.user_name',$this->_user_name,true);
		$criteria->compare('idEmbarkation.embarkation_name', $this->_embarkation_name,true);
		$criteria->compare('idHeadquarter.headquarter_name', $this->_headquarter_name,true);
		$criteria->compare('idUser.user_names', $this->_user_names,true);
		$criteria->compare('idUser.user_lastnames', $this->_user_lastnames,true); 
            
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function searchClient()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
                $criteria->with=array('idUser','idEmbarkation','idHeadquarter');
                $criteria->together=true;
                $criteria->condition = 't.id_user='.Yii::app()->user->id;
		$criteria->compare('id_ticket',$this->id_ticket);
		$criteria->compare('id_embarkation',$this->id_embarkation);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('ticket_date',$this->ticket_date,true);
		$criteria->compare('ticket_subject',$this->ticket_subject,true);
		$criteria->compare('ticket_date_incident',$this->ticket_date_incident,true);
		$criteria->compare('ticket_description',$this->ticket_description,true);
		$criteria->compare('ticket_status',$this->ticket_status,true);
		$criteria->compare('ticket_solution',$this->ticket_solution,true);
		$criteria->compare('ticket_file',$this->ticket_file,true);
		$criteria->compare('idUser.user_name',$this->_user_name,true);
		$criteria->compare('idEmbarkation.embarkation_name', $this->_embarkation_name,true);
		$criteria->compare('idHeadquarter.headquarter_name', $this->_headquarter_name,true);
		$criteria->compare('idUser.user_names', $this->_user_names,true);
		$criteria->compare('idUser.user_lastnames', $this->_user_lastnames,true); 
            
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
          public function requiredSolution($attribute, $params){
             
             if(Yii::app()->user->checkAccess('Administrador')){
                if(empty($this->ticket_solution))
                $this->addError ('ticket_solution' ,  Yii::t('yii','{attribute} cannot be blank.',array('{attribute}'=>$this->getAttributeLabel('ticket_solution'))));
             }
         }
         public function getDaysPassed()
            {
                    $days= (strtotime($this->ticket_date)-strtotime(date("y-m-d H:i:s")))/86400;
                    $days = abs($days); $days = floor($days);		
                    return $days;
            }
        public function validateid($model,$attribute)
        {
            if($this->id_headquarter==0|| empty ($this->id_headquarter))
                    $this->addError('id_headquarter', "Ingresar Centro Valido");
        
        }
        public function validateTime($model,$attribute)
        {
            if(!empty($this->ticket_date_incident)){
            $date=Yii::app()->dateFormatter->format('yy-MM-dd HH:mm',$this->ticket_date_incident);
            $datetime1 = new DateTime($date);
            $datetime2 = new DateTime(date("y-m-d H:i:s"));
            if($datetime1 > $datetime2)
                $this->addError('ticket_date_incident', "El Horario seleccionado es superior al Actual");
            }
        }
         
}