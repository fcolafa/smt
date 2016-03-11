<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Operational extends CFormModel
{
	


	/**
	 * Declares the validation rules.
	 */
        public $_verifyCode;
        public $_type;
        public $_report;
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
                        array('_type,_report','required'),                         
//                        array('_initdate','validDate'),
//                        array('_initdate','haveTicket'),
//                        array('_endate','validDate'),
//                        array('_range','validRange'),
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
                        '_type'=>Yii::t('database','Tipo'),
                        '_initdate'=>Yii::t('database','Fecha Inicial'),
                        '_endate'=>Yii::t('database','Fecha final'),
                        '_range'=>Yii::t('database','Años'),
                        '_report'=>Yii::t('database','Reporte'),
		
		);
	}
           public function types(){
            $types=array('Total la fecha','Entre fechas','Anual');
            return $types;
        }
           public function typeReport(){
            $types=array('Reporte Operacion (Maquina)','Reporte Operacion (Puente)');
            return $types;
        }
//        public function years(){
//           $year="SELECT year(t.ticket_date) as y FROM `ticket` `t` GROUP BY year(t.ticket_date)";
//           $years=  Yii::app()->db->createCommand($year)->queryAll();
//           $yfinal= array();
//           
//           foreach($years as $y){
//              $yfinal[$y['y']]=$y['y'];
//           }
//          return $yfinal;
//        }
        
}
