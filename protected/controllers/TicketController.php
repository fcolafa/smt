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
				'actions'=>array('view', 'create','admin','captcha','upload','closeTicket','listHeadquarter',),
				'roles'=>array('Cliente'),    
			),
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('view','admin','captcha','upload','listUser'),
				'roles'=>array('Administrador'),
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
           
             if(!Yii::app()->user->checkAccess('Administrador')&&Yii::app()->user->id!=$model->id_user){
                       throw new CHttpException(404, 'Usted no esta autorizado para realizar esta acción.');
             }
            if(isset($_POST['TicketMessage']))
                {
                $ticketm->attributes=$_POST['TicketMessage'];
                $ticketm->id_ticket=$id;
                $ticketm->ticket_message_date=date("y-m-d H:i:s");
                $ticketm->id_user=Yii::app()->user->id;
                if($ticketm->id_user_asigned==0)
                                $ticketm->id_user_asigned=NULL;
                if($ticketm->save()){
                    $tempFolder=Yii::getPathOfAlias('webroot').'/images/temp/'; 
                    $newFolder=Yii::getPathOfAlias('webroot').'/images/tickets_message/'; 
                    if(!empty($ticketm->ticket_message_file)&&file_exists($tempFolder.$ticketm->ticket_message_file)){
                            $file = $ticketm->ticket_message_file;
                            list($name,$ext)= split('[.]', $file); 
                            copy($tempFolder.$ticketm->ticket_message_file,$newFolder.$ticketm->id_ticket_message.".".$ext );
                            $ticketm=  TicketMessage::model()->findByPk($ticketm->id_ticket_message);
                            $ticketm->ticket_message_file=$ticketm->id_ticket_message.".".$ext;
                           
                            
                           
                            $ticketm->save(false);
                           // move_uploaded_file($tempFolder.$ticketm->ticket_message_file,$newFolder.$ticketm->id_ticket_message.".".$ext );
                           // array_map('unlink', glob($tempFolder."*"));//elimina directorio completo
                        $this->deleteOldFile($tempFolder);
                    }
                     $this->sendMail($ticketm, 'Mensaje No Conformidad', 'body_ticket_message');
                     $this->redirect(array('view', 'id'=>$id));
                     
                     
                } 
            }
            if(isset($_POST['Ticket'])){
                $model->attributes=$_POST['Ticket'];
                $tempFolder=Yii::getPathOfAlias('webroot').'/images/temp/'; 
                    $newFolder=Yii::getPathOfAlias('webroot').'/images/tickets_solution/';
                  if(!empty($model->ticket_solution_file)&&file_exists($tempFolder.$model->ticket_solution_file)){
                    
                     $file = $model->ticket_solution_file;
                     list($name,$ext)= split('[.]', $file); 
                     copy($tempFolder.$model->ticket_solution_file,$newFolder.$model->id_ticket.".".$ext );
                     $model->ticket_solution_file=$model->id_ticket.".".$ext;
                    }
                if($model->save()){
                  $this->deleteOldFile($tempFolder);
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
        private function deleteOldFile($tempFolder){
           $dir = opendir($tempFolder);
            while($f = readdir($dir))
            {
            if((time()-filemtime($tempFolder.$f) > 3600*4*2) and !(is_dir($tempFolder.$f)))
            unlink($tempFolder.$f);
            }
            closedir($dir);
        }
        public function actionCloseTicket($id){
            $ticket=$this->loadModel($id);
            $ticket->ticket_status="Cerrado";
            $ticket->save(false);
            $this->redirect(array('view', 'id'=>$id));  
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
                        if($model->save()){
                            $tempFolder=Yii::getPathOfAlias('webroot').'/images/temp/'; 
                            $newFolder=Yii::getPathOfAlias('webroot').'/images/tickets/'; 
                            if(!empty($model->ticket_file)&&file_exists($tempFolder.$model->ticket_file)){
                                    $file = $model->ticket_file;
                                    list($name,$ext)= split('[.]', $file); 
                                    copy($tempFolder.$model->ticket_file,$newFolder.$model->id_ticket.".".$ext );
                                    $model=  Ticket::model()->findByPk($model->id_ticket);
                                    $model->ticket_file=$model->id_ticket.".".$ext;
                                    $model->save(false);
                                $this->deleteOldFile($tempFolder);
                            }
                            $this->sendMail($model, 'No Concformidad Emitida', 'body_ticket');
                                    
                         
				$this->redirect(array('view','id'=>$model->id_ticket));
                        }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
         private function sendMail($model, $subject,$view)
	{
	
                $mail=Yii::app()->Smtpmail;
                $mail->SMTPDebug = 2;
                $mail->SetFrom('flagos@pcgeek.cl', 'Sistema Web SMT');
                $mail->Subject = $subject;
                $mail->MsgHTML(Yii::app()->controller->renderPartial($view, array('model'=>$model),true));
             
                if($subject=='Mensaje No Conformidad'&& !empty($model->id_user_asigned))
                {
                     $msgFolder=Yii::getPathOfAlias('webroot').'/images/tickets_message/'; 
                     $mail->AddAddress($model->idUsera->email, $subject);
                    if(!empty($model->ticket_message_file)){
                        $mail->AddAttachment($msgFolder.$model->ticket_message_file, $model->ticket_message_file);
                    }
                     if(!$mail->Send()) {
                    Yii::app()->user->setFlash('error',Yii::t('validation','Error al enviar correo Electronico'));
                }else {
                    Yii::app()->user->setFlash('success',Yii::t('validation','Notificación enviada por Correo Electronico'));
                }
                }else 
                    if($subject=='No Concformidad Emitida')
                    {
                        $newFolder=Yii::getPathOfAlias('webroot').'/images/tickets/'; 
                        $criteria=new CDbCriteria();
                        $criteria->condition="role='Administrador'";
                        $users=  Users::model()->findAll($criteria);
                        $i=false;
                        foreach($users as $u){
                            if(!$i)
                                $mail->AddAddress($u->email, $subject);
                            else
                                $mail->AddCC($u->email, $subject);
                            $i=true;
                        }           
                       
                        if(!empty($model->ticket_file)){
                            $mail->AddAttachment($newFolder.$model->ticket_file, $model->ticket_file);
                        }
                         if(!$mail->Send()) {
                    Yii::app()->user->setFlash('error',Yii::t('validation','Error al enviar correo Electronico'));
                }else {
                    Yii::app()->user->setFlash('success',Yii::t('validation','Notificación enviada por Correo Electronico'));
                }
                
                
                }
               
                
           
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
            }else {
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
            $uploader->allowedExtensions = array('pdf','jpg','jpeg','png','txt','docs','docxs','xls','xlsx','gif','ppt','pptx','JPG');
            $uploader->sizeLimit = 1 * 1024 * 1024;//maximum file size in bytes
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
            $criteria->condition = "LOWER(user_name) like LOWER(:term) OR LOWER(user_lastnames) like LOWER(:term) OR LOWER(user_names) like LOWER(:term) and role='Administrador'and id_user<>".Yii::app()->user->id;
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

}