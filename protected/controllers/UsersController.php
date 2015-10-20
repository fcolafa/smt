<?php

class UsersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
       

	/**
	 * @return array action filters
	 */
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
                    
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','view','create','update','admin','delete'),
				'roles'=>array('Administrador'),
			),
                    
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('viewClient','updateClient'),
				'roles'=>array('Cliente'),
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
             
                    $this->render('view',array(
                            'model'=>$this->loadModel($id),
                    ));
	}
	public function actionViewClient($id)
	{
             
                    $this->render('viewClient',array(
                            'model'=>$this->loadModel($id),
                    ));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Users;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Users']))
		{
                        $pass=$this->generatePass();
			$model->attributes=$_POST['Users'];
                        $model->_oldpassword = md5($pass);
                        $model->password = md5($pass);
                        $model->password_repeat = md5($pass);
                        $model->date_create=  date("y/m/d H:i:s");
                        $model->user_names=  ucwords(strtolower($model->user_names));
                        $model->user_lastnames=  ucwords(strtolower($model->user_lastnames));
			if($model->save()){
                            $this->sendMail($model,$pass);
                            Yii::app()->authManager->assign($model->role,$model->id_user);
                            $this->redirect(array('view','id'=>$model->id_user));
                        } 
		}
		$this->render('create',array(
			'model'=>$model,
		));
	}
        private function sendMail($model, $pass)
	{
	
                $mail=Yii::app()->Smtpmail;
                $mail->SMTPDebug = 2;
                $mail->SetFrom('flagos@pcgeek.cl', 'Sistema Web SMT');
                $mail->Subject = 'Datos de Cuenta';
                $mail->MsgHTML(Yii::app()->controller->renderPartial('body', array('model'=>$model,'pass'=>$pass),true));
                $mail->AddAddress($model->email, 'Test');
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
                $role=$model->role;
                $pass= $model->password;
                $model->password='';
        
		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
                        if(!empty($model->password)&& !empty($model->password_repeat)){
                        $model->password = md5($model->password);
                        $model->password_repeat = md5($model->password_repeat);
                       
                        }
                        else
                        if(Yii::app()->user->id!=$model->id_user){
                            $model->_oldpassword=$pass;
                            $model->password = $pass;
                            $model->password_repeat = $pass;
                        }
                           $model->user_names=  ucwords(strtolower($model->user_names));
                           $model->user_lastnames=  ucwords(strtolower($model->user_lastnames));
                           $model->date_create=  date("y/m/d H:i:s");  
			if($model->save()){
                                Yii::app ()->authManager->revoke($model->role,$model->id_user);
                                Yii::app()->authManager->assign($model->role,$model->id_user);
				$this->redirect(array('view','id'=>$model->id_user));     
                         }
                        $model->password = '';
                        $model->password_repeat = '';
                      
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
        public function actionUpdateClient($id)
	{
		$model=$this->loadModel($id);
                $role=$model->role;
                $model->password='';
                if(Yii::app()->user->id!=$id&& !Yii::app()->user->checkAccess('Administrador'))
                         throw new CHttpException(404, 'Usted no esta autorizado para realizar esta acción.');    
		if(isset($_POST['Users']))
		{
                      
			$model->attributes=$_POST['Users'];
                        if(!empty($model->password)&& !empty($model->password_repeat)){    
                                $model->password = md5($model->password);
                                $model->password_repeat = md5($model->password_repeat);
                        }
                           $model->user_names=  ucwords(strtolower($model->user_names));
                           $model->user_lastnames=  ucwords(strtolower($model->user_lastnames));
			if($model->save()){
                            $this->redirect(array('viewClient','id'=>$model->id_user));
                         }
                       $model->password_repeat='';
                       $model->password='';
                       $model->_oldpassword='';
                     
		}
		$this->render('updateClient',array(
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
                $model=$this->loadModel($id);
                try{
                if($model->role=="Administrador"){
                $criteria= new CDbCriteria();
                $criteria->condition = 'role="Administrador"'; 
                $user= Users::model()->findAll($criteria);
           
                if(count($user)<=1){
                    throw new CHttpException(404,Yii::t('validation','You cant delete the only user with the  "administrator" role'));
                }
                if(Yii::app()->user->id==$id  && Yii::app()->user->checkAccess('Administrador'))
                         throw new CHttpException(404, 'Usted no esta autorizado para darse de baja en una session activa.');    
                }
                $role=$model->role;
                if($model->delete()){
                    Yii::app ()->authManager->revoke($role,$id);
                    Session::model()->deleteByPk($id);
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                }
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                }catch(CDbException $e)
            {
                if(!isset($_GET['ajax'])){
                    Yii::app()->user->setFlash('error',Yii::t('validation','Can not delete this item because it have elements asociated it'));
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                }
                
            } 
        
        }
	public function actionDeleteClient($id)
	{
                $model=$this->loadModel($id);
               $role=$model->role;
                try{
                    
		if($model->delete())
                     Yii::app ()->authManager->revoke($role,$id);
                Session::model()->deleteByPk($id) ;
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                }   catch(CDbException $e)
            {
            
                if(!isset($_GET['ajax'])){
                    Yii::app()->user->setFlash('error',Yii::t('validation','Can not delete this item because it have elements asociated it'));
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin', 'idu'=>$idu));
                }
                
            } 
        }
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Users',array(
                     'criteria'=>array(
                      'condition'=>'role<>"Control Total" and role <> "Supervisor"',
                       )));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
        
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
                
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Users the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Users $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        private function generatePass(){
            $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
            $pass = "";
            for($i=0;$i<5;$i++) {
            $pass .= substr($str,rand(0,62),1);
            }
            return $pass;
          }
}
