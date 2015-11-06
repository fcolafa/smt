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
				'actions'=>array('view','index', 'create','admin','captcha','upload','closeTicket'),
				'roles'=>array('Cliente'),    
			),
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('view','index','admin','captcha','upload'),
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
                     $this->redirect(array('view', 'id'=>$id));          
                } 
            }
            
            if(isset($_POST['Ticket'])){
                $model->attributes=$_POST['Ticket'];
                $model->ticket_status="Resuelto";
                if($model->save())
                    $this->redirect(array('view','id'=>$model->id_ticket));
            }
            $status=$model->ticket_status;
            if( Yii::app()->user->checkAccess('Administrador')&& $status!="Solicitud Finalizada"&& $status!="Solicitud en Curso" && $status!="Resuelto"){
                $model->ticket_status="Solicitud en Curso";
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
            if((time()-filemtime($tempFolder.$f) > 3600*24*2) and !(is_dir($tempFolder.$f)))
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
                        $model->ticket_status='No Leido';
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
                                    
                         
				$this->redirect(array('view','id'=>$model->id_ticket));
                        }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        private function sendMail($model)
	{
                $mail=Yii::app()->Smtpmail;
                $mail->SMTPDebug = 2;
                $mail->SetFrom($model->idUser->email, 'Sistema Web SMT');
                $mail->Subject = 'Datos de Cuenta';
                $mail->MsgHTML(Yii::app()->controller->renderPartial('body', array('model'=>$model,'pass'=>$pass),true));
                $mail->AddAddress('flagos@pcgeek.cl', 'Test');
                if(!$mail->Send()) {
                    Yii::app()->user->setFlash('error',Yii::t('validation','Error al enviar correo Electronico'));
                }else {
                    Yii::app()->user->setFlash('success',Yii::t('validation','Datos de usuario enviados por correo Electronico'));
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
	public function actionAdmin()
	{
		$model=new Ticket('search');
		$model->unsetAttributes();  // clear any default values
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
            $uploader->allowedExtensions = array('pdf','jpg','PDF','JPEG','JPG','jpeg','png','PNG');
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

}