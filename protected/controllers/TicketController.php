<?php

class TicketController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
        public function actions(){

        return array(
            'captcha'=>array(
               'class'=>'CaptchaExtendedAction',
                'mode'=>CaptchaExtendedAction::MODE_MATH,
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
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('view', 'create','admin','captcha','upload','closeTicket','listHeadquarter','messageClient','approve','repprove'),
				'roles'=>array('Cliente'),    
			),
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('view','admin','captcha','upload','listUser','RemedyTicket','MessageTicket'),
				'roles'=>array('Administrador','Mantención','Flota','Administración & Finanzas','Gerencia General'),
                 ),
                 array('allow', 
                                'actions'=>array('DeleteOldFile','automaticEmail'),
				'users'=>array('*'),
			),
                    
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
            $model=$this->loadModel($id);
            $ticketm=new TicketMessage;
          
            $userasigned=new CDbCriteria();
            $userasigned->condition='id_ticket='.$id.' and id_user_asigned='.Yii::app()->user->id;
            $messages=  TicketMessage::model()->findAll($userasigned);
            
             if(!Yii::app()->user->checkAccess('Administrador')&&Yii::app()->user->id!=$model->id_user&&!$messages){
                       throw new CHttpException(404, 'Usted no esta autorizado para realizar esta acción.');
             }
            if(isset($_POST['Ticket'])){
                $model->attributes=$_POST['Ticket'];
             
                if($model->save()){
                  $this->redirect(array('view','id'=>$model->id_ticket));
                }
            }
            $status=$model->ticket_status;
            if( Yii::app()->user->checkAccess('Administrador')&& $status=="Nuevo"){
                $model->ticket_status="En Curso";
                $model->save(false);
            }
      
            $this->render('view',array(
                    'model'=>$model,
                    'ticketm'=>$ticketm,
            ));
	
        }
        public function actionDeleteOldFile($tempFolder=null,$token){
            $cont=0;
            if($token=="PDS4WaMD"){
                if($tempFolder==null)
                    $tempFolder=Yii::getPathOfAlias('webroot').'/images/temp/'; 
            
           $dir = opendir($tempFolder);
                while($f = readdir($dir)){
                if((time()-filemtime($tempFolder.$f) >= 3600*4*2) and !(is_dir($tempFolder.$f)))
                    unlink($tempFolder.$f);
                }
            closedir($dir);
            
            }
           
        }
  
        public function actionCloseTicket($id){
            $ticket=$this->loadModel($id);
            $ticket->ticket_status="Cerrado";
            $ticket->ticket_close_date=date("y-m-d H:i:s");
            $ticket->save(false);
            $this->redirect(array('view', 'id'=>$id));  
        }
           public function actionMessageTicket($id){
             
             $ticketm=new TicketMessage;
             $ticketm->id_ticket=$id;
             if(isset($_POST['TicketMessage']))
                {
                $ticketm->attributes=$_POST['TicketMessage'];
                $ticketm->id_ticket=$id;
                $ticketm->ticket_message_date=date("y-m-d H:i:s");
                $ticketm->id_user=Yii::app()->user->id;
                $ticketm->ticket_message_type='message';
                 //$ticketm->ticket_message_approve=0;
                if($ticketm->id_user_asigned==0)
                  $ticketm->id_user_asigned=NULL;
        
                if($ticketm->save()){
                    if(!empty($ticketm->_message_files)){
                        $tempFolder=Yii::getPathOfAlias('webroot').'/images/temp/'; 
                        $newFolder=Yii::getPathOfAlias('webroot').'/images/tickets_message/'; 
                        $folder=$newFolder."/".$ticketm->id_ticket_message;
                            if(!file_exists($folder))
                                mkdir($folder,0777,true); 
                        foreach($ticketm->_message_files as $mfile){
                            if(file_exists(($tempFolder.$mfile))){
                                $messagefile=new TicketMessageFile;
                                $messagefile->id_ticket_message=$ticketm->id_ticket_message;
                                $messagefile->ticket_message_file_name=$mfile;
                                $messagefile->save();
                                copy($tempFolder.$messagefile->ticket_message_file_name,$folder."/".$messagefile->ticket_message_file_name);
                            }
                        }
                       
                    }
                    $this->sendMail($ticketm,"Tiene notificaciones pendientes en la No Conformidad Nº".$ticketm->id_ticket,"body_ticket_message",'message');
                    $this->redirect(array('ticket/view', 'id'=>$id));  
                }}
                     $this->render('createMessage',array(
                    'ticketm'=>$ticketm,
            ));
         }
        
        
         public function actionRemedyTicket($id){
             
             $ticketm=new TicketMessage;
             $ticketm->id_ticket=$id;
             $ticket=  $this->loadModel($id);
             
             if(isset($_POST['TicketMessage']))
                {
                $ticketm->attributes=$_POST['TicketMessage'];
                $ticketm->id_ticket=$id;
                $ticketm->ticket_message_date=date("y-m-d H:i:s");
                $ticketm->id_user=Yii::app()->user->id;
                $ticketm->ticket_message_type='remedy';
                // $ticketm->ticket_message_approve=0;
                if($ticketm->id_user_asigned==0)
                  $ticketm->id_user_asigned=NULL;
        
                if($ticketm->save()){
                    $ticket->ticket_solution_date=$ticketm->ticket_message_date;
                    $ticket->save(false);
                    if(!empty($ticketm->_message_files)){
                        $tempFolder=Yii::getPathOfAlias('webroot').'/images/temp/'; 
                        $newFolder=Yii::getPathOfAlias('webroot').'/images/tickets_message/'; 
                        $folder=$newFolder."/".$ticketm->id_ticket_message;
                            if(!file_exists($folder))
                                mkdir($folder,0777,true); 
                        foreach($ticketm->_message_files as $mfile){
                            if(file_exists(($tempFolder.$mfile))){
                                $messagefile=new TicketMessageFile;
                                $messagefile->id_ticket_message=$ticketm->id_ticket_message;
                                $messagefile->ticket_message_file_name=$mfile;
                                $messagefile->save();
                                copy($tempFolder.$messagefile->ticket_message_file_name,$folder."/".$messagefile->ticket_message_file_name);
                            }
                        }
                        
                    }
                    $this->sendMail($ticketm,"Medida Correctiva No Conformidad Nº".$ticketm->id_ticket,"body_ticket_message",'remedy');
                    $this->redirect(array('ticket/view', 'id'=>$id));  
                }}
                     $this->render('createRemedy',array(
                    'ticketm'=>$ticketm,
            ));
         }
         public function actionMessageClient($id){
             
             $ticketm=new TicketMessage;
             $ticketm->id_ticket=$id;
             if(isset($_POST['TicketMessage']))
                {
                $ticketm->attributes=$_POST['TicketMessage'];
                $ticketm->id_ticket=$id;
                $ticketm->ticket_message_date=date("y-m-d H:i:s");
                $ticketm->id_user=Yii::app()->user->id;
                $ticketm->ticket_message_type='client';
                //$ticketm->ticket_message_approve=0;
                if($ticketm->id_user_asigned==0)
                  $ticketm->id_user_asigned=NULL;
        
                if($ticketm->save()){
                    if(!empty($ticketm->_message_files)){
                        $tempFolder=Yii::getPathOfAlias('webroot').'/images/temp/'; 
                        $newFolder=Yii::getPathOfAlias('webroot').'/images/tickets_message/'; 
                        $folder=$newFolder."/".$ticketm->id_ticket_message;
                            if(!file_exists($folder))
                                mkdir($folder,0777,true); 
                        foreach($ticketm->_message_files as $mfile){
                            if(file_exists(($tempFolder.$mfile))){
                                $messagefile=new TicketMessageFile;
                                $messagefile->id_ticket_message=$ticketm->id_ticket_message;
                                $messagefile->ticket_message_file_name=$mfile;
                                $messagefile->save();
                                copy($tempFolder.$messagefile->ticket_message_file_name,$folder."/".$messagefile->ticket_message_file_name);
                            }
                        }
                       
                    }
                    $this->sendMail($ticketm, 'Comentario a No Conformidad Nº'.$ticketm->id_ticket.' por parte del Cliente', 'body_ticket_message','messageClient');
                    $this->redirect(array('ticket/view', 'id'=>$id));  
                
                    
                            }}
                     $this->render('createMessageClient',array(
                    'ticketm'=>$ticketm,
            ));
             
        
                }
                
                
        /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Ticket;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		if(isset($_POST['Ticket']))
		{
			$model->attributes=$_POST['Ticket'];
                        $model->id_user=Yii::app()->user->id;
                        $model->ticket_date= date("y-m-d H:i:s");
                        $model->ticket_status='Nuevo';
                        if(!empty($model->ticket_date_incident))
                            $model->ticket_date_incident=Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm', $model->ticket_date_incident);
                            //$model->ticketFiles=$_POST['Ticket']['_files'];
                            
                        if(isset($_POST['Ticket']['_files']))
                            $model->_files=$_POST['Ticket']['_files'];
                       
                        if($model->save()){
                            $tempFolder=Yii::getPathOfAlias('webroot').'/images/temp/'; 
                            $newFolder=Yii::getPathOfAlias('webroot').'/images/tickets/'; 
                            if(!empty($model->_files)){
                                $folder=$newFolder."/".$model->id_ticket;
                                if(!file_exists($folder))
                                    mkdir($folder,0777,true); 
                                foreach($model->_files as $file){
                                    if(file_exists($tempFolder.$file)){
                                        $ticketfile=new TicketFile;
                                        $ticketfile->id_ticket=$model->id_ticket;
                                        $ticketfile->ticket_file_name=$file;
                                        $ticketfile->save();
                                        copy($tempFolder.$ticketfile->ticket_file_name,$folder."/".$ticketfile->ticket_file_name);
                                     
                                    } 
                                }
                            }
                            $this->sendMail($model, 'No Conformidad Emitida Nº'.$model->id_ticket, 'body_ticket','message');
                                    
                         
				$this->redirect(array('view','id'=>$model->id_ticket));
                        }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
         private function sendMail($model, $subject,$view,$type=null,$content=null)
	{
	
                $mail=Yii::app()->Smtpmail;
                $mail->SMTPDebug = 1;
                $mail->CharSet = 'UTF-8';
                $mail->SetFrom('comercialsmt@smtsa.cl', 'Sistema Web SMT');
                $mail->Subject = $subject;
                $mail->MsgHTML(Yii::app()->controller->renderPartial($view, array('model'=>$model,'subject'=>$subject,'content'=>$content),true));
                if($type=='message'&& !empty($model->id_user_asigned))              
                    $mail->AddAddress($model->idUsera->email, $subject);
                elseif($type=='message'||$type=='remedya'||$type=='remedyr'||$type=='messageClient'||$type='daypassed')
                {
                    $criteria=new CDbCriteria();
                    $criteria->condition="role='Administrador'";
                    $users=  Users::model()->findAll($criteria);
                    foreach($users as $u){
                        $mail->AddAddress($u->email, $subject);
                    }
                }elseif($type=='remedy')  
                    $mail->AddAddress($model->idUser->email, $subject); 
                if(!$mail->Send()) 
                    Yii::app()->user->setFlash('error',Yii::t('validation','Error al enviar correo Electronico'));
                else 
                    Yii::app()->user->setFlash('success',Yii::t('validation','Notificación enviada por Correo Electronico'));
                
                 
           
	}
        

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Ticket']))
		{
			$model->attributes=$_POST['Ticket'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_ticket));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            if(Yii::app()->user->checkAccess('Administrador')){
		$dataProvider=new CActiveDataProvider('Ticket');
            }else
                if(Yii::app()->user->checkAccess('Mantención')){
                    $dataProvider=new CActiveDataProvider('Ticket',array(
                     'criteria'=>array(
                      'with'=>'ticket_message',
                      'condition'=>'id_user_asigend='.Yii::app()->user->id,
                       ))); 
                }
            
            else {
                $dataProvider=new CActiveDataProvider('Ticket',array(
                     'criteria'=>array(
                      'condition'=>'id_user='.Yii::app()->user->id,
                       )));
            }
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin($status=null)
	{
		$model=new Ticket('search');
                  if($status!=null)
                    $model->ticket_status=$status;
                  else
                $model->unsetAttributes();  // clear
		if(isset($_GET['Ticket']))
			$model->attributes=$_GET['Ticket'];
		$this->render('admin',array(
			'model'=>$model,
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Ticket the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Ticket::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	/**
	 * Performs the AJAX validation.
	 * @param Ticket $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ticket-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        public function actionUpload()
        {
            $tempFolder=Yii::getPathOfAlias('webroot').'/images/temp/';         
            Yii::import("ext.EFineUploader.qqFileUploader");
          
            $uploader = new qqFileUploader();
            $uploader->allowedExtensions = array('pdf','jpg','jpeg','png','txt','rtf','doc','docx','xls','xlsx','gif','ppt','pptx');
            $uploader->sizeLimit = 5 * 1024 * 1024;//maximum file size in bytes
            $uploader->chunksFolder = $tempFolder;
            $result = $uploader->handleUpload($tempFolder);
            $result['filename'] = $uploader->getUploadName();
            $result['folder'] = $tempFolder;
            $uploadedFile=$tempFolder.$result['filename'];
            header("Content-Type: text/plain");
            $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            echo $result;
            Yii::app()->end();
        }
        
          public function actionListHeadquarter($term)
        {
            $criteria = new CDbCriteria;
            $criteria->condition = "LOWER(headquarter_name) like LOWER(:term)";
            $criteria->params = array(':term'=> '%'.$_GET['term'].'%');
            $criteria->limit = 30;
            $models = Headquarter::model()->findAll($criteria);
            $arr = array();
            foreach($models as $model)
            {
            $arr[] = array(
            'label'=>($model->headquarter_name), // label for dropdown list
            'value'=>($model->headquarter_name), // value for input field
            'id'=>$model->id_headquarter, // return value from autocomplete

                       );
                   }
                   echo CJSON::encode($arr);
        }
           public function actionListUser($term)
        {
            $criteria = new CDbCriteria;
            $criteria->condition = "(LOWER(user_name) like LOWER(:term) OR LOWER(user_lastnames) like LOWER(:term) OR LOWER(user_names) like LOWER(:term)) and role <>'Cliente' and id_user<>".Yii::app()->user->id;
            $criteria->params = array(':term'=> '%'.$_GET['term'].'%');
            $criteria->limit = 30;
            $models = Users::model()->findAll($criteria);
            
            $arr = array();
            foreach($models as $model)
            {
            $arr[] = array(
            'label'=>($model->user_names." ".$model->user_lastnames." (".$model->user_name.")"), // label for dropdown list
            'value'=>($model->user_names." ".$model->user_lastnames." (".$model->user_name.")"), // value for input field
            'id'=>$model->id_user, // return value from autocomplete

                       );
                   }
                   echo CJSON::encode($arr);
        }
        
        public function getTicketMessages($id){
            $criteria=new CDbCriteria();
            $client=Yii::app()->user->checkAccess('Cliente');
            if($client)
            $criteria->condition='id_ticket='.$id." and ticket_message_type <> 'message'";
            else
            $criteria->condition='id_ticket='.$id;
            $message= TicketMessage::model()->findAll($criteria);
            foreach($message as  $m){
                $user=Users::model()->findByPK($m->id_user);
                $link="";
                $asigned=$user->user_names." ".$user->user_lastnames;
              $approve="";
              $repprove="";
                
                switch ($m->ticket_message_type){
                    case "message":
                        $class="ticketMessage";
                        break;
                    case "remedy":
                        if(is_null($m->ticket_message_approve))
                            $class="ticketNone";
                        elseif($m->ticket_message_approve==0)
                            $class="ticketRemedy";
                        if($m->ticket_message_approve==1)
                            $class="ticketApprove";
                     
                        if($client&& is_null($m->ticket_message_approve)&& $m->idTicket->ticket_status!="Cerrado"){
                            $approve=CHtml::link("Aprobar medida Correctiva",Yii::app()->createUrl("ticket/approve",array("id"=>$m->id_ticket_message)));
                            $repprove=CHtml::link("Reprobar medida Correctiva",Yii::app()->createUrl("ticket/repprove",array("id"=>$m->id_ticket_message)), array('confirm' => 'Esta Seguro que desea reprobar la medida correctiva propuesta?'));
                        }
                        break;
                    case "client";
                         $class="ticketMessageClient";
                         break;
                }
               
                $cri=new CDbCriteria();
              
                $cri->condition='id_ticket_message='.$m->id_ticket_message;
                $messagefiles= TicketMessageFile::model()->findAll($cri);

                    $folder=Yii::getPathOfAlias('webroot').'/images/tickets_message/'; 
                if($messagefiles){
                    foreach($messagefiles as $mf){

                    $link.=CHtml::link(CHtml::encode($mf->ticket_message_file_name), Yii::app()->baseUrl.'/images/tickets_message/'.$mf->id_ticket_message."/". $mf->ticket_message_file_name,array('target'=>'_blank'));
                    $link.="<br>";
                    }

                }
                
                if(!empty($m->id_user_asigned)){
                    $asigneduser=Users::model()->findByPK($m->id_user_asigned);
                    $asigned="De ".$user->user_names." ".$user->user_lastnames ." para ". $asigneduser->user_names." ".$asigneduser->user_lastnames;
                }
                  $space="";
                        if(!empty($approve)&&!empty($repprove))
                            $space="|";
                echo  '<div class="'.$class.'">'.$m->ticket_message.'</p>'.
                      '<p class="datep">'.$asigned ."<br>".
                       Yii::app()->dateFormatter->format("d MMMM y  HH:mm:ss",strtotime($m->ticket_message_date))."<br>".
                        $link."<div class='approveTicket'>".$approve.$space.$repprove."</div></div>";

                echo "<br>";

                } 
             }
             public function actionApprove($id){
                 $message=  TicketMessage::model()->findByPk($id);
                 $message->ticket_message_approve=1;
                 $message->save(false);
                 $ticket=  $this->loadModel($message->id_ticket);
                 $ticket->ticket_status="Cerrado";
                 $ticket->ticket_close_date=date("y-m-d H:i:s");
                 $ticket->save(false);
                 $this->sendMail($message, 'Tiene Medidas Correctivas Asociadas a la No Conformidad:'.$message->id_ticket.' Aprobadas', 'body_ticket_message','remedya');
                 $this->redirect( array('view','id'=>$message->id_ticket));
                 
             }
              public function actionRepprove($id){
                 $message=  TicketMessage::model()->findByPk($id);
                 $message->ticket_message_approve=0;
                 $message->save(false);
                 $this->sendMail($message, 'Tiene Medida Correctivas para No Conformidad:'.$message->id_ticket.' Reprobadas', 'body_ticket_message','remedyr');
                 $this->redirect( array('messageClient','id'=>$message->id_ticket));
                 
             }
             public function actionAutomaticEmail($token){
                 if($token=='iy4Uu7uU'){
                $criteria=new CDbCriteria();
                $criteria->condition='ticket_status="En Curso"';
                $tickets=  Ticket::model()->findAll($criteria);
                if($tickets)
                    foreach ($tickets as $ticket){
                          $days= (strtotime($ticket->ticket_date)-strtotime(date("y-m-d H:i:s")))/86400;
                          $days = abs($days); 
                          $days = floor($days);		
                          
                        $criteria2=new CDbCriteria();
                        $criteria2->condition='id_ticket='.$ticket->id_ticket." and ticket_message_type<>'message'";
                        $messages=  TicketMessage::model()->findAll($criteria2);
                        if($days>=15&&empty($messages))
                            $this->sendMail($ticket, 'Han transcurrido mas de '.$days.' dias desde que se emitio la No Conformidad N° '.$ticket->id_ticket, 'body_ticket_message','daypassed','');
                        elseif(!empty($messages)){
                            $mremedy=new CDbCriteria();
                            $mremedy->condition="id_ticket=".$ticket->id_ticket." and ticket_message_type='remedy'";
                            $mremedy->order= "ticket_message_date desc";
                            $mremedy->limit=1;
                            $date1=  TicketMessage::model()->findAll($mremedy);
                            if(!empty($date1)){
                               // die($date1[0]->ticket_message_date);
                                $dayr= (strtotime($date1[0]->ticket_message_date)-strtotime(date("y-m-d H:i:s")))/86400;
                                $dayr = abs($dayr); 
                                $dayr = floor($dayr);
                                $datetime1 = new DateTime($date1[0]->ticket_message_date);
                            }
                            $mclient=new CDbCriteria();
                            $mclient->condition="id_ticket=".$ticket->id_ticket." and ticket_message_type='Client'";
                            $mclient->order= "ticket_message_date desc";
                            $mclient->limit=1;
                            $date2=  TicketMessage::model()->findAll($mclient);
                            if(!empty($date2)){
                                $dayc= (strtotime($date2[0]->ticket_message_date)-strtotime(date("y-m-d H:i:s")))/86400;
                                $dayc = abs($dayc); 
                                $dayc = floor($dayc);
                                $datetime2 = new DateTime($date2[0]->ticket_message_date);
                            }
                            if((!empty($date1)&&empty($date2))||(!empty($date1)&&!empty($date2)&&$datetime2>$datetime1)&&$dayr>1){
                                $this->sendMail($ticket, 'Han transcurrido mas de '.$dayr.' dias desde que se emitio una medida correctiva a la No Conformidad N° '.$ticket->id_ticket, 'body_ticket_message','remedy','De no haber respuesta o cierre de la no Conformidad, se asumira que usted esta de acuerdo con las medidas correctivas aplicadas');
                                if($dayr>=2)
                                    $this->redirect(array('closeTicket','id'=>$ticket->id_ticket));
                            }
                            
                        }
                    }
                }
            }
}