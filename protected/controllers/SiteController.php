<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
        
	public function actions()
	{
		return array(
			
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
                        'coco'=>array(
                                'class'=>'CocoAction',
                        ),
                      
                               //component for extension DropDownList Dependient
        
		);
	}
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex($id=null,$url=null)
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
           
           $yearg=date("Y");
                if(Yii::app()->user->isGuest)
                    $this->redirect(Yii::app()->baseUrl.'/site/login');
                else{
                if(!Yii::app()->user->checkAccess('Administrador')){
                    
                    $user=  Users::model()->findByPk(Yii::app()->user->id);
                    if($user->first_time==0)
                        $this->redirect (array('Users/updateClient','id'=>Yii::app()->user->id));
                    else
                    $this->render('panelClient');
                }
                 if(Yii::app()->user->checkAccess('Administrador')){
                    
                    $user=  Users::model()->findByPk(Yii::app()->user->id);
                    if($user->first_time==0)
                        $this->redirect (array('Users/update','id'=>Yii::app()->user->id));
                    else
                           if(isset ($url))
                               $url;
                                else
                            $this->render('paneladmin');
                    }
                }
	}
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact($cuerpo="",$type=null)
	{
                if(Yii::app()->user->isGuest)
                    $this->redirect(Yii::app()->baseUrl.'/site/login');
          
		$model=new ContactForm;
                $model->body=$cuerpo;
                if($type!=null){
                    $provider=Provider::model()->findAll('id_type='.$type);
                if(!empty($provider))
                    $provider=CHtml::listData($provider,'id_provider','provider_name');
                else{
                    Yii::app()->user->setFlash('error',"No existen proveedores para este tipo de producto");
                    $this->redirect(array('provider/index'));
                    }
                }
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
       			if($model->validate())
			{
                            Yii::import('application.extensions.phpmailer.JPhpMailer');
                            $mail = new JPhpMailer;
                            $mail->IsSMTP();
                            if( strpos(Yii::app()->params['adminEmail'],'gmail.com')==true){
                                $mail->Host = 'smtp.googlemail.com';
                                $mail->Port='465'; 
                                $mail->SMTPSecure = "ssl";
                            }
                            elseif( strpos(Yii::app()->params['adminEmail'],'hotmail.com')==true){
                                $mail->Host='smtp.live.com';
                                $mail->Port='587';
                                $mail->SMTPSecure = "tls";    
                            }
                            else
                                Yii::app()->user->setFlash('error',"No existe Servido SMTP para la direccion de correo seleccionada");  
                           
                            
                            $mail->SMTPAuth = true;
                            $mail->CharSet = 'UTF-8';
                            $mail->Username = Yii::app()->params['adminEmail'];
                            $mail->Password = Yii::app()->params['passwordEmail'];
                            $mail->SetFrom(Yii::app()->params['adminEmail'], Yii::app()->params['adminEmail']);
                            $mail->Subject = $model->subject;
                            $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
                            $mail->MsgHTML('<h1>Optilens!</h1><br>'.$model->body);
                            $provider=  Provider::model()->findbyPk($model->email);
                            $mail->AddAddress($provider->email_provider,$provider->provider_name );
                            try {
                            if ($mail->send()){
                                Yii::app()->user->setFlash('notice',"mensaje enviado correctamente");
                                 $this->redirect(Yii::app()->baseUrl);
                            }else 
                                Yii::app()->user->setFlash('error',"error al enviar mensaje");
                                $this->redirect(Yii::app()->baseUrl);
                            }
                            catch (Exception $ex) {
                                
                                Yii::app()->user->setFlash('error',"Error de Auntetificacion, verifique email y contraseña en configuracion global");  
                        }
			
		}
                }
                 
                 
                if(Yii::app()->user->isGuest)
                    $this->redirect(Yii::app()->baseUrl);
                 else
                     if(!empty ($provider))
		$this->render('contact',array('model'=>$model,'provider'=>$provider));
                     else
                         $this->render('contact',array('model'=>$model));
	}
        public function actionGlobalConfig()
        {
            if(Yii::app()->user->isGuest)
                    $this->redirect(Yii::app()->baseUrl.'/site/login');
             if(!Yii::app()->user->checkAccess('Control Total')){
                    Yii::app()->user->setFlash('error',"No esta autorizado para realizar esta accion");
                    $this->redirect(Yii::app()->baseUrl.'/site/index');
                }
            $file = dirname(__FILE__).'../../config/params.inc';
            $content = file_get_contents($file);
            $arr = unserialize(base64_decode($content));
            $model=new GlobalConfig;
            $model->setAttributes($arr);
            if(isset($_POST['GlobalConfig']))
            {
                $model->attributes=$_POST['GlobalConfig'];
                 $config = array(        
                'adminEmail'=>$_POST['GlobalConfig']['adminEmail'],
                'passwordEmail'=>$_POST['GlobalConfig']['passwordEmail'],
                'sessionTime'=>$_POST['GlobalConfig']['sessionTime'],
                );
                 $str = base64_encode(serialize($config));
                 file_put_contents($file, $str);
                 $model->setAttributes($config);
                 Yii::app()->user->setFlash('notice',"Configuracion Guardada Correctamente ");
                 $this->redirect(Yii::app()->baseUrl.'/site/index');
            }
            $this->render('GlobalConfig',array('model'=>$model));
                
            
        }
   
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
          
		$model=new LoginForm;
                $model->username="";
                $model->password="";

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
               if(! Yii::app()->user->isGuest)
                    $this->redirect(Yii::app()->baseUrl.'/site/index');
		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
                            //$this->redirect(Yii::app()->baseUrl.'/site/index');
				$this->redirect(Yii::app()->user->returnUrl);
                         
                      
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        
        public function actionReports(){
            if(Yii::app()->user->isGuest)
                    $this->redirect(Yii::app()->baseUrl.'/site/login');
            $model=new Reports;
            if(isset($_POST['Reports'])){
                $model->attributes=$_POST['Reports'];
                if($model->validate()){
                   if($model->reportype=='1'){
                         $this->excel($model);
                       }
                    elseif($model->reportype=='2'){
                       $this->rangexcel($model);
                    }
                }
            }
               $this->render('reports',array('model'=>$model));
        }  
        public function excel($model){
            $objPHPExcel = new PHPExcel();
            $office= Office::model()->findAll();
            /** Error reporting */
            ini_set('display_errors', TRUE);
            ini_set('display_startup_errors', TRUE);
            error_reporting(E_ALL);
            define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
            /** Include path **/
            date_default_timezone_set('UTC');

            //date_default_timezone_set($saveTimeZone);

            // Create new PHPExcel object
            echo date('H:i:s') . " Create new PHPExcel object\n";
            $objPHPExcel = new PHPExcel();


            // Set properties
            echo date('H:i:s') . " Set properties\n";
            $objPHPExcel->getProperties()->setCreator("Optilens");
            $objPHPExcel->getProperties()->setLastModifiedBy("Optilens");

            // Set default font
            $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Arial');
            $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
            // Add some data
            echo date('H:i:s') . " Add some data\n";
            echo date('H:i:s').' Set document properties'.EOL;
            $i=0;
            $objPHPExcel->removeSheetByIndex(0);
            $cellin="A";
            $cellend="N";
            foreach($model->reportyear as $ry):
            $objPHPExcel->createSheet($i);
            $objPHPExcel->setActiveSheetIndex($i);
            $objPHPExcel->getActiveSheet()->setTitle($ry); 
       
              $head = 5;
               foreach ($office as $o){
                   
                            $objPHPExcel->getActiveSheet()->getStyle($cellin.$head.':'.$cellend.$head)->applyFromArray(
                array(

                     'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => $head%2==0?'FFFFFF':'B7EA52')
                    ),
                   'borders' => array(
                            'outline' => array(
                                   'style' => PHPExcel_Style_Border::BORDER_THIN,
                                   'color' => array('rgb' => '7AB20F'),
                            ),
            )));
                        $command = Yii::app()->db->createCommand(" call monthsales(". $o->id_office .",".$ry.") ");
                        $month = $command->queryAll();
                        $total=0;
                        $sales=array_fill(1,13,0);
                        $sales[0]=$o->office_name;
                        foreach($month as $m){
                           for($j=1;$j<13;$j++){
                                if($j==intval($m['month(s.date)'])){
                                    $sales[$j]=intval($m['sum(s.price)']);
                                    $total+=intval($m['sum(s.price)']);
                                    }
                                }
                                $sales[13]=$total; 
                            }

                            $lastColumn="A";
                            for($indexsales=0; $indexsales<=13;$indexsales++) {            
                                $objPHPExcel->getActiveSheet()->setCellValue($lastColumn.$head, $sales[$indexsales]);
                                if($indexsales>0){
                                $objPHPExcel->getActiveSheet()
                                ->getStyle($lastColumn.$head)
                                ->getNumberFormat()->setFormatCode('$ #,##0');
                                
                                }
                            
                                $lastColumn++;
                            }
                                  
                            
                                $cmdtype = Yii::app()->db->createCommand(" call typemonthsales(". $o->id_office .",".$ry.") ");
                                $type = $cmdtype->queryAll();
                                $totalc=0;
                                $totalo=0;
                                $totalot=0;
                                $contact= array_fill(1, 13, 0);
                                $optic= array_fill(1, 13, 0);
                                $other= array_fill(1, 13, 0);
                                $optic[0]='Opticos';
                                $contact[0]='Contacto';
                                $other[0]='Otros';
                                foreach ($type as $ty){
                                    for($j=1;$j<13;$j++){
                                         if($j==intval($ty['month(s.date)'])&&$ty['type_name']=="Optico" ){
                                            $optic[$j]=intval($ty['sum(s.price)']);
                                            $totalo+=intval($ty['sum(s.price)']);
                                           }
                                           if($j==intval($ty['month(s.date)'])&&$ty['type_name']=="Contacto" ){
                                            $contact[$j]=intval($ty['sum(s.price)']);
                                            $totalc+=intval($ty['sum(s.price)']);
                                           }
                                           if($j==intval($ty['month(s.date)'])&&$ty['type_name']=="Otro" ){
                                            $other[$j]=intval($ty['sum(s.price)']);
                                             $totalot+=intval($ty['sum(s.price)']);

                                           }
                                           
                                 }
                                  $contact[13]=$totalc;
                                  $optic[13]=$totalo;
                                  $other[13]=$totalot;
                                }
                                 $head++;
                                          $objPHPExcel->getActiveSheet()->getStyle($cellin.$head.':'.$cellend.$head)->applyFromArray(
                                    array(

                                     
                                       'borders' => array(
                                                'outline' => array(
                                                       'style' => PHPExcel_Style_Border::BORDER_THIN,
                                                       'color' => array('rgb' => '7AB20F'),
                                                ),
                                )));
                                 $lastColumn="A";
                                 for($indextype=0; $indextype<=13;$indextype++) {    
                               
                                 $objPHPExcel->getActiveSheet()->setCellValue($lastColumn.$head, $optic[$indextype]);
                                 if($indextype>0)
                                 $objPHPExcel->getActiveSheet()
                                  ->getStyle($lastColumn.$head)
                                 ->getNumberFormat()->setFormatCode('$ #,##0');
                                 $lastColumn++;
                                 }
                                $head++;
                                         $objPHPExcel->getActiveSheet()->getStyle($cellin.$head.':'.$cellend.$head)->applyFromArray(
                                    array(

                                     
                                       'borders' => array(
                                                'outline' => array(
                                                       'style' => PHPExcel_Style_Border::BORDER_THIN,
                                                       'color' => array('rgb' => '7AB20F'),
                                                ),
                                )));
                                 $lastColumn="A";
                                 for($indextype=0; $indextype<=13;$indextype++) {    
                               
                                 $objPHPExcel->getActiveSheet()->setCellValue($lastColumn.$head, $contact[$indextype]);
                                 if($indextype>0)
                                 $objPHPExcel->getActiveSheet()
                                  ->getStyle($lastColumn.$head)
                                 ->getNumberFormat()->setFormatCode('$ #,##0');
                                 $lastColumn++;
                                 }
                                   $head++;
                                            $objPHPExcel->getActiveSheet()->getStyle($cellin.$head.':'.$cellend.$head)->applyFromArray(
                                    array(

                                     
                                       'borders' => array(
                                                'outline' => array(
                                                       'style' => PHPExcel_Style_Border::BORDER_THIN,
                                                       'color' => array('rgb' => '7AB20F'),
                                                ),
                                )));
                                 $lastColumn="A";
                                 for($indextype=0; $indextype<=13;$indextype++) {    
                               
                                 $objPHPExcel->getActiveSheet()->setCellValue($lastColumn.$head, $other[$indextype]);
                                 if($indextype>0)
                                 $objPHPExcel->getActiveSheet()
                                  ->getStyle($lastColumn.$head)
                                 ->getNumberFormat()->setFormatCode('$ #,##0');
                                 $lastColumn++;
                                 }
       
                            $head++;
               }
               $head++;
               $objPHPExcel->getActiveSheet()->setCellValue("A".$head, 'Usuarios');
                     $objPHPExcel->getActiveSheet()->getStyle('A'.$head.':N'.$head)->applyFromArray(
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
               $head++;
               
               
            $user=  Users::model()->findAll();
            foreach($user as $u){
            $usermonthsales = Yii::app()->db->createCommand(" call usersmonthsales(".$u->id_user.",".$ry.") ")->queryAll();
            $totalu=0;
            $salesusers=array_fill(1,13,0);
            $salesusers[0]=$u->user_name;
            foreach($usermonthsales as $ums){
            for($j=1;$j<13;$j++){
               if($j==intval($ums['month(s.date)'])){
                   $salesusers[$j]=intval($ums['sum(s.price)']);
                   $totalu+=intval($ums['sum(s.price)']);
                   }
               }
               $salesusers[13]=$totalu; 
             }
             
            $lastColumn="A";
            for($indexuser=0; $indexuser<=13;$indexuser++) {    
                $objPHPExcel->getActiveSheet()->setCellValue($lastColumn.$head, $salesusers[$indexuser]);
                if($indextype>0)
                $objPHPExcel->getActiveSheet()
                 ->getStyle($lastColumn.$head)
                ->getNumberFormat()->setFormatCode('$ #,##0');
                $lastColumn++;
                }
               
                        $objPHPExcel->getActiveSheet()->getStyle($cellin.$head.':'.$cellend.$head)->applyFromArray(
                   array(


                      'borders' => array(
                               'outline' => array(
                                      'style' => PHPExcel_Style_Border::BORDER_THIN,
                                      'color' => array('rgb' => '7AB20F'),
                               ),)));
                        $head++;
            }
               //images
            $objDrawing = new PHPExcel_Worksheet_HeaderFooterDrawing();
            $objDrawing->setName('PHPExcel logo');
            $objDrawing->setPath(Yii::app()->basePath.DIRECTORY_SEPARATOR."../themes/optic/images/logo.png");
            $objDrawing->setCoordinates('A1'); // pins the top-left corner of the image to cell D24
            $objDrawing->setOffsetX(10); // pins the top left corner of the image at an offset of 10 points horizontally to the right of the top-left corner of the cell
            $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); 
          //titles
                    $objPHPExcel->getActiveSheet()
                                          ->SetCellValue('B4', 'Enero ')
                                          ->SetCellValue('C4', 'Febrero')
                                          ->SetCellValue('D4', 'Marzo')
                                          ->SetCellValue('E4', 'Abril')
                                          ->SetCellValue('F4', 'Mayo')
                                          ->SetCellValue('G4', 'Junio')
                                          ->SetCellValue('H4', 'Julio')
                                          ->SetCellValue('I4', 'Agosto')
                                          ->SetCellValue('J4', 'Septiembre')
                                          ->SetCellValue('K4', 'Octubre')
                                          ->SetCellValue('L4', 'Noviembre')
                                          ->SetCellValue('M4', 'Diciembre')
                                          ->SetCellValue('N4', 'Totales');
            
                                $i++;
                                $objPHPExcel->getActiveSheet()->getStyle('B4:N4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                $objPHPExcel->getActiveSheet()->getStyle('B4:N4')->applyFromArray(
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
                        PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT); 
                        foreach(range($cellin,$cellend) as $columnID) {
                            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
                                ->setAutoSize(true);
                            }  
                         
            endforeach;

          //---------------------------------------------
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
            
          //-----------------------------------------------
        }
        public function rangexcel($model){
           
            /** Error reporting */
             ini_set('display_errors', TRUE);
             ini_set('display_startup_errors', TRUE);
            error_reporting(E_ALL);
            define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
            /** Include path **/
            $saveTimeZone = date_default_timezone_get();
            date_default_timezone_set('UTC');

            // Create new PHPExcel object
            echo date('H:i:s') . " Create new PHPExcel object\n";
            $objPHPExcel = new PHPExcel();
            
            // Set properties
            echo date('H:i:s') . " Set properties\n";
            $objPHPExcel->getProperties()->setCreator("Optilens");
            $objPHPExcel->getProperties()->setLastModifiedBy("Optilens");

            // Set default font
            $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Arial');
            $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
            // Add some data
            echo date('H:i:s') . " Add some data\n";
            echo date('H:i:s').' Set document properties'.EOL;
            
            $index=0;
            $objPHPExcel->removeSheetByIndex(0);
            $cellin="A";
            $cellend="I";
            $init=$model->initdate;
            $end=$model->endate;
            $initdate=Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm',$init);
            $endate=Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm',$end);
            foreach ($model->office as $indexoffice=>$id){
                $office=  Office::model()->findByPk($id);
             
          
                $command = Yii::app()->db->createCommand(" call rangereport(". $id .",'".$initdate."','".$endate ."') ");
                $range = $command->queryAll();
                if($range){
                $objPHPExcel->createSheet($index);
                $objPHPExcel->setActiveSheetIndex($index);
                $objPHPExcel->getActiveSheet()->setTitle($office->office_name);
                $index++;
            
            $objDrawing = new PHPExcel_Worksheet_HeaderFooterDrawing();
            $objDrawing->setName('PHPExcel logo');
            $objDrawing->setPath(Yii::app()->basePath.DIRECTORY_SEPARATOR."../themes/optic/images/logo.png");
            //$objDrawing->setWidth(20); // sets the image height to 36px (overriding the actual image height);
            $objDrawing->setCoordinates('A1'); // pins the top-left corner of the image to cell D24
            $objDrawing->setOffsetX(10); // pins the top left corner of the image at an offset of 10 points horizontally to the right of the top-left corner of the cell
            $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); 
            $objPHPExcel->getActiveSheet()
                                          ->SetCellValue('A4', 'Nombre ')
                                          ->SetCellValue('B4', 'Apellido ')
                                          ->SetCellValue('C4', 'Rut')
                                          ->SetCellValue('D4', 'Tipo de Venta')
                                          ->SetCellValue('E4', 'Medio de pago')
                                          ->SetCellValue('F4', 'Fecha')
                                          ->SetCellValue('G4', 'Abono')
                                          ->SetCellValue('H4', 'Total')
                                          ->SetCellValue('I4', 'Usuario');

            $cellin="A";
            $cellend="I";
            $objPHPExcel->getActiveSheet()->getStyle($cellin.'4:'.$cellend.'4')->applyFromArray(
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
             $i=5;
           foreach($range as $r):
           
           $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $r['client_name'])
                                  ->setCellValue('B' . $i, $r['client_lastname'] )
                                  ->setCellValue('C' . $i, Sales::model()->formatRut( $r['client_rut']))
                                  ->setCellValue('D' . $i, $r['type_name'])
                                  ->setCellValue('E' . $i, $r['payment_method'] )
                                  ->setCellValue('G' . $i, $r['pay'] )
                                  ->setCellValue('H' . $i, $r['price'] )
                                  ->setCellValue('I' . $i, $r['user_name'] );
        
              $objPHPExcel->getActiveSheet()
                    ->getStyle('G'.$i)
                    ->getNumberFormat()->setFormatCode('$ #,##0');
              $objPHPExcel->getActiveSheet()
                    ->getStyle('H'.$i)
                    ->getNumberFormat()->setFormatCode('$ #,##0');   
           $unixTimestamp = strtotime($r['date']);
           $excelDate = PHPExcel_Shared_Date::PHPToExcel($unixTimestamp);
           $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $excelDate);
           $objPHPExcel->getActiveSheet()
                    ->getStyle('F'.$i)
                    ->getNumberFormat()->setFormatCode('yyyy-mm-dd hh:mm');

           $objPHPExcel->getActiveSheet()->getStyle($cellin.$i.':'.$cellend.$i)->applyFromArray(
                array(

                     'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => $i%2==0?'FFFFFF':'B7EA52')
                    ),
                   'borders' => array(
                            'outline' => array(
                                   'style' => PHPExcel_Style_Border::BORDER_THIN,
                                   'color' => array('rgb' => '7AB20F'),
                            ),
            )));

           $i++;

           endforeach;
            
            $objPHPExcel->getActiveSheet()->setAutoFilter($cellin.'4:'.$cellend.'4');
            $objPHPExcel->getActiveSheet()->getStyle($cellin.'4:'.$cellend.'4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);
            foreach(range($cellin,$cellend) as $columnID) {
                $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
                    ->setAutoSize(true);
            }}}
            $xlsName = 'Reporte_detalallado_de'.$init.'_al_'.$end.'_.xls';
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