
<?php

/**
 * Reports class.
 * Reports is the data structure for keeping
 * Reports form data. It is used by the 'Sales' action of 'Sales'.
 */
class Reports extends CFormModel
{
	


	/**
	 * Declares the validation rules.
	 */
        public $_verifyCode;
        public $_type;
        public $_year;
        public $_initdate;
        public $_endate;
        public $_range;

	public function rules()
	{
		return array(
			// verifyCode needs to be entered correctly
			array('_verifyCode', 'CaptchaExtendedValidator', 'allowEmpty'=>!CCaptcha::checkRequirements()),
                         //array('_year', 'numerical', 'integerOnly'=>true),
                        array('_type','required'),                         
                        array('_initdate','validDate'),
                        array('_initdate','haveTicket'),
                        array('_endate','validDate'),
                        array('_range','validRange'),
                        array('_range,_year,_type,_initdate,_endate','safe'),
                         
		);
	}
	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
                        '_verifyCode'=>Yii::t('database','Verification Code'),
                        '_year'=>Yii::t('database','Año'),
                        '_type'=>Yii::t('database','Tipo de Reporte'),
                        '_initdate'=>Yii::t('database','Fecha Inicial'),
                        '_endate'=>Yii::t('database','Fecha final'),
                        '_range'=>Yii::t('database','Años'),
		
		);
	}
        public function years(){
           $year="SELECT year(t.ticket_date) as y FROM `ticket` `t` GROUP BY year(t.ticket_date)";
           $years=  Yii::app()->db->createCommand($year)->queryAll();
           $yfinal= array();
           
           foreach($years as $y){
              $yfinal[$y['y']]=$y['y'];
           }
          return $yfinal;
        }
        public function types(){
            $types=array('No Conformidades a la fecha','No Conformidades entre fechas',' No Conformidades Anuales');
            return $types;
        }
        
          public function validDate($attribute){
            if(empty($this->$attribute)&&$this->_type=='1')
                    $this->addError ($attribute, Yii::t ('yii', '{attribute} cannot be blank.',array('{attribute}'=>  Yii::t('database',$attribute))));
        }
         
        public function validRange($attribute){
            if(empty($this->$attribute)&&$this->_type=='2')
                    $this->addError ($attribute, Yii::t ('yii', '{attribute} cannot be blank.',array('{attribute}'=>  Yii::t('database',$attribute))));
        }
        public function haveTicket(){
            if(!empty($this->_initdate)&&!empty($this->_endate)&&$this->_type=='1'){
                $initdate=Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm',$this->_initdate);
                $endate=Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm',$this->_endate);
                $criteria=new CDbCriteria();
                $criteria->condition = "t.ticket_date between '".$initdate."' and '".$endate."'";
                $ticket= Ticket::model()->findAll($criteria);
           
                if(empty($ticket))
                    $this->addError ('initdate','No exiten datos asociadas entre '.$this->_initdate.' y '.$this->_endate);
                }
        }
      
        
}