<?php

class ReportsController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
        
    
        public function actionTickets()
	{
            $datachar=array(array('Task', 'Hours per Day'));
            $datachar2=array(array('Task', 'Hours per Day'));
            $datachar3=array(array('Task', 'Hours per Day'));
            $datachar4=array(array('Task', 'Hours per Day'));
            $datalinechar=array(
                                array('Meses', 'Respuesta', 'Cierre'),
                                array('Enero',null,null),
                                array('Febrero',null,null),
                                array('Marzo',null,null),
                                array('Abril',null,null),
                                array('Mayo',null,null),
                                array('Junio',null,null),
                                array('Julio',null,null),
                                array('Agosto',null,null),
                                array('Septiembre',null,null),
                                array('Octubre',null,null),
                                array('Noviembre',null,null),
                                array('Diciembre',null,null),);
            $model=new Reports;
            $model->_year= date('Y');
            if(isset($_POST['Reports'])){
                $model->attributes=$_POST['Reports'];
                if(!empty($_POST['Reports']['_year']))
                    $model->_year=$_POST['Reports']['_year'];
                else 
                    $model->_year= date('Y');
                if(!empty($_POST['Reports']['_type']))
                    $model->_type=$_POST['Reports']['_type'];
                if(!empty($_POST['Reports']['_range']))
                    $model->_range=$_POST['Reports']['_range'];
                    
            }
              $command = Yii::app()->db->createCommand(" call totalTicketYear(".$model->_year.") ");
              $ticket = $command->queryAll();
              foreach($ticket as $ti){
                    array_push($datachar, array($ti['company_name'] , (int)$ti['count(t.id_ticket)']));
              }
              $command = Yii::app()->db->createCommand(" call totalTicketHeadquarter(".$model->_year.") ");
              $ticket = $command->queryAll();
                foreach ($ticket as $ti){
                    array_push($datachar2, array($ti['headquarter_name'], (int)$ti['count(t.id_ticket)']));
                  
                }
              $command = Yii::app()->db->createCommand(" call totalTickeType(".$model->_year.") ");
              $ticket = $command->queryAll();
                foreach ($ticket as $ti){
                    array_push($datachar3, array($ti['classification_name'] , (int)$ti['count(t.id_ticket)']));
                }
              $command = Yii::app()->db->createCommand(" call inOutR(".$model->_year.",'d') ");
              $ticket = $command->queryAll();
              array_push($datachar4, array('Dentro de plazo' , (int)$ticket[0]['c']));
          
               $command = Yii::app()->db->createCommand(" call inOutR(".$model->_year.",'f') ");
                $ticket = $command->queryAll();
                array_push($datachar4, array('Fuera de plazo' , (int)$ticket[0]['c']));
                
               $command = Yii::app()->db->createCommand(" call avgtime(".$model->_year.") ");
               $ticket = $command->queryAll();
               for($i=1;$i<13;$i++)
               foreach ($ticket as $ti){
                   if((int)$ti['mes']==$i){
                       if(!empty($ti['days']))
                       $datalinechar[$i][1]=(int)$ti['days'];
                       if(!empty($ti['dayc']))
                       $datalinechar[$i][2]=(int)$ti['dayc'];
                   }
               }
               if($model->validate()){
                    if($model->_type==0)
                        $this->totalTodayExcel();
                    if($model->_type==1)
                        $this->totalTodayExcel($model->_initdate, $model->_endate);
                    if($model->_type==2)
                       $this->rangeExcel($model->_range);
                        
               }
               $this->render('tickets',
                       array('model'=>$model,
                           'datachar'=>$datachar,
                           'datachar2'=>$datachar2,
                           'datachar3'=>$datachar3,
                           'datachar4'=>$datachar4,
                           'datalinechar'=>$datalinechar,
                           ));
	}
  public function actions(){

        return array(
            'captcha'=>array(
               'class'=>'CaptchaExtendedAction',
                'mode'=>CaptchaExtendedAction::MODE_MATH,
            ),
        );
    }
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
         * 
         * 

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
        public function accessRules()
	{
            return array(
                    array('allow', // allow admin user to perform 'admin' and 'delete' actions
                            'actions'=>array('index','tickets','captcha'),
                            'roles'=>array('Administrador'),
                    ),
                    array('deny',  // deny all users
                            'users'=>array('*'),
                    ),
            );
	}
        public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
        public function rangeExcel($range){
            
            $objPHPExcel = new PHPExcel();
            ini_set('display_errors', TRUE);
            ini_set('display_startup_errors', TRUE);
            error_reporting(E_ALL);
            define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
            /** Include path **/
            date_default_timezone_set('UTC');
            echo date('H:i:s') . " Create new PHPExcel object\n";
            $objPHPExcel = new PHPExcel();

            // Set properties
            echo date('H:i:s') . " Set properties\n";
            $objPHPExcel->getProperties()->setCreator("SMT");
            $objPHPExcel->getProperties()->setLastModifiedBy("SMT");

            // Set default font
            $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Arial');
            $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
            echo date('H:i:s') . " Add some data\n";
            echo date('H:i:s').' Set document properties'.EOL;
            //----------------------------------------------------------
            $objPHPExcel->removeSheetByIndex(0);
            $index=0;
            
            foreach($range as $year){
               
                $criteria=new CDbCriteria();
                $criteria->condition = "year(t.ticket_date)='".$year."'";
                $tickets= Ticket::model()->findAll($criteria);
                $objPHPExcel->createSheet($index);
                $objPHPExcel->setActiveSheetIndex($index);
                $objPHPExcel->getActiveSheet()->setTitle($year);
                $head=4;
                    foreach($tickets as $ticket){
                        $lastColumn="A";
                            if($head==4){
                             $head2=3;
                             $cellin=$lastColumn;
                             $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head2, 'Id Ticket');
                             $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head2, 'Fecha No Conformidad');
                             $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head2, 'Centro');
                             $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head2, 'Nave');
                             $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head2, 'Asunto');
                             $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head2, 'Descripción');
                             $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head2, 'Fecha Incidente');
                             $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head2, 'Solución');
                             $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head2, 'Fecha Solución');
                             $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head2, 'Fecha Cierre');
                             $cellend=$lastColumn;
                             $cellend--;
                     
                             $objPHPExcel->getActiveSheet()->getStyle($cellin.$head2.':'.$cellend.$head2)->applyFromArray(
                              array(
                                'fill' => array(
                                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                    'color' => array('rgb' => '7AB20F')
                                ),
                                'font'  => array(
                                    'bold'  => true,
                                    'color' => array('rgb' => 'FFFFFF'),
                                     'size'  => 12),
                            ));
                            }
                         $lastColumn="A";
                         $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head, $ticket->id_ticket);
                         //---------------------------------------------------------------------------------------------------------
                         $unixTimestamp = strtotime($ticket->ticket_date);
                         $excelDate = PHPExcel_Shared_Date::PHPToExcel($unixTimestamp);
                         $objPHPExcel->getActiveSheet()
                            ->getStyle(($lastColumn).$head)
                            ->getNumberFormat()->setFormatCode('yyyy-mm-dd hh:mm');
                         $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head,$excelDate );
                         //----------------------------------------------------------------------------------------------------------
                         $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head, $ticket->idHeadquarter->headquarter_name);
                         $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head, $ticket->idEmbarkation->embarkation_name);
                         $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head, $ticket->ticket_subject);
                         $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head, $ticket->ticket_description);
                         //-----------------------------------------------------------------------------------------------------------
                         $excelDate="";
                         if(!empty($ticket->ticket_date_incident)){
                                $unixTimestamp = strtotime($ticket->ticket_date_incident);
                                $excelDate = PHPExcel_Shared_Date::PHPToExcel($unixTimestamp);
                                $objPHPExcel->getActiveSheet()
                                   ->getStyle($lastColumn.$head)
                                   ->getNumberFormat()->setFormatCode('yyyy-mm-dd hh:mm');
                                }
                         $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head,$excelDate );


                         //---------------------------------------------------------------------------------------------
                         $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head, $ticket->ticket_solution);

                         //----------------------------------------------------------------------------------------------

                         $excelDate="";
                         if(!empty($ticket->ticket_solution_date)){
                         $unixTimestamp = strtotime($ticket->ticket_solution_date);
                         $excelDate = PHPExcel_Shared_Date::PHPToExcel($unixTimestamp);
                         $objPHPExcel->getActiveSheet()
                            ->getStyle(($lastColumn).$head)
                            ->getNumberFormat()->setFormatCode('yyyy-mm-dd hh:mm');
                         }
                         $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head,$excelDate );


                         //----------------------------------------------------------------------------------------------
                         $excelDate="";
                         if(!empty($ticket->ticket_close_date)){
                            $unixTimestamp = strtotime($ticket->ticket_close_date);
                            $excelDate = PHPExcel_Shared_Date::PHPToExcel($unixTimestamp);
                            $objPHPExcel->getActiveSheet()->getStyle(($lastColumn).$head)->getNumberFormat()->setFormatCode('yyyy-mm-dd hh:mm');
                         }
                         $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head,$excelDate );
                         $head++;
                         //dimensionar
                           $objPHPExcel->getActiveSheet()->setAutoFilter($cellin.$head2.':'.$cellend.$head2);
                           $objPHPExcel->getActiveSheet()->getStyle($cellin.$head2.':'.$cellend.$head2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);
                            foreach(range($cellin,$cellend) as $columnID) {
                                $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
                                    ->setAutoSize(true);
                            }
                    }
                    $index++;
            }
            //---------------------------------------------------------
            $xlsName = 'Reporte_Anuales.xls';
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$xlsName.'"');
            header('Cache-Control: max-age=0');
     
            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');
            ob_end_clean();
            ob_start();
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');      
            Yii::app()->end(); 
            
        }
        public function totalTodayExcel($dateInit=null,$dateEnd=null,$range=null){
            $objPHPExcel = new PHPExcel();
            ini_set('display_errors', TRUE);
            ini_set('display_startup_errors', TRUE);
            error_reporting(E_ALL);
            define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
            /** Include path **/
            date_default_timezone_set('UTC');
            echo date('H:i:s') . " Create new PHPExcel object\n";
            $objPHPExcel = new PHPExcel();

            // Set properties
            echo date('H:i:s') . " Set properties\n";
            $objPHPExcel->getProperties()->setCreator("SMT");
            $objPHPExcel->getProperties()->setLastModifiedBy("SMT");

            // Set default font
            $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Arial');
            $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
            echo date('H:i:s') . " Add some data\n";
            echo date('H:i:s').' Set document properties'.EOL;
            //----------------------------------------------------------
            
        
            $objPHPExcel->removeSheetByIndex(0);
            $objPHPExcel->createSheet(0);
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()->setTitle('No Conformidades');
            
            if($dateEnd!=null &$dateInit!=null){
                 $xlsName = 'Reporte_NC_rango.xls';
                $initdate=Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm',$dateInit);
                $endate=Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm',$dateEnd);
                $criteria=new CDbCriteria();
                $criteria->condition = "t.ticket_date between '".$initdate."' and '".$endate."'";
                $tickets= Ticket::model()->findAll($criteria);
            }else{
                 $xlsName = 'Reporte_a_la_fecha.xls';
            $tickets= Ticket::model()->findAll();}
            $head=4;
            foreach($tickets as $ticket){
                $lastColumn="A";
                if($head==4){
                    $head2=3;
                 $cellin=$lastColumn;
                 $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head2, 'id_ticket');
                 $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head2, 'Fecha No Conformidad');
                 $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head2, 'Centro');
                 $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head2, 'Nave');
                 $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head2, 'Asunto');
                 $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head2, 'Descripción');
                 $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head2, 'Fecha Incidente');
                 $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head2, 'Solución');
                 $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head2, 'Fecha Solución');
                 $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head2, 'Fecha Cierre');
                 $cellend=$lastColumn;
                 $cellend--;
                 $objPHPExcel->getActiveSheet()->getStyle($cellin.$head2.':'.$cellend.$head2)->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '7AB20F')
                    ),
                    'font'  => array(
                        'bold'  => true,
                        'color' => array('rgb' => 'FFFFFF'),
                         'size'  => 12),
            ));
                 
              
                }
                 $lastColumn="A";
                 $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head, $ticket->id_ticket);
                  //-----------------------------------------------------------------
                 $unixTimestamp = strtotime($ticket->ticket_date);
                 $excelDate = PHPExcel_Shared_Date::PHPToExcel($unixTimestamp);
                 $objPHPExcel->getActiveSheet()
                    ->getStyle(($lastColumn).$head)
                    ->getNumberFormat()->setFormatCode('yyyy-mm-dd hh:mm');
                 $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head,$excelDate );
                 //------------------------------------------------------------------
                 $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head, $ticket->idHeadquarter->headquarter_name);
                 $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head, $ticket->idEmbarkation->embarkation_name);
                 $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head, $ticket->ticket_subject);
                 $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head, $ticket->ticket_description);
                 
                 //--------------------------------------------------------------------------------------------
                 
                 $excelDate="";
                 if(!empty($ticket->ticket_date_incident)){
                 $unixTimestamp = strtotime($ticket->ticket_date_incident);
                 $excelDate = PHPExcel_Shared_Date::PHPToExcel($unixTimestamp);
                 $objPHPExcel->getActiveSheet()
                    ->getStyle($lastColumn.$head)
                    ->getNumberFormat()->setFormatCode('yyyy-mm-dd hh:mm');
                 }
                 $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head,$excelDate );
                 
                 
                 //---------------------------------------------------------------------------------------------
                 $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head, $ticket->ticket_solution);
                 
                 //----------------------------------------------------------------------------------------------
                 
                 $excelDate="";
                 if(!empty($ticket->ticket_solution_date)){
                 $unixTimestamp = strtotime($ticket->ticket_solution_date);
                 $excelDate = PHPExcel_Shared_Date::PHPToExcel($unixTimestamp);
                 $objPHPExcel->getActiveSheet()
                    ->getStyle(($lastColumn).$head)
                    ->getNumberFormat()->setFormatCode('yyyy-mm-dd hh:mm');
                 }
                 $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head,$excelDate );
                 
                 
                 //----------------------------------------------------------------------------------------------
                 $excelDate="";
                 if(!empty($ticket->ticket_close_date)){
                 $unixTimestamp = strtotime($ticket->ticket_close_date);
                 $excelDate = PHPExcel_Shared_Date::PHPToExcel($unixTimestamp);
                 $objPHPExcel->getActiveSheet()
                    ->getStyle(($lastColumn).$head)
                    ->getNumberFormat()->setFormatCode('yyyy-mm-dd hh:mm');
                 }
                 $objPHPExcel->getActiveSheet()->setCellValue($lastColumn++.$head,$excelDate );
                 $head++;
                 
                 
                 //dimensionar
                   $objPHPExcel->getActiveSheet()->setAutoFilter($cellin.$head2.':'.$cellend.$head2);
                   $objPHPExcel->getActiveSheet()->getStyle($cellin.$head2.':'.$cellend.$head2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);
                    foreach(range($cellin,$cellend) as $columnID) {
                        $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
                            ->setAutoSize(true);
                    }
                
            }
    
            //---------------------------------------------------------
            $xlsName = 'Reporte_Anual.xls';
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$xlsName.'"');
            header('Cache-Control: max-age=0');
     
            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');
            ob_end_clean();
            ob_start();
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');      
            Yii::app()->end();            
        }
}