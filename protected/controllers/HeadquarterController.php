<?php

class HeadquarterController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index', 'view', 'create','update','admin','delete'),
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
	public function actionView($id,$idu)
	{
            if(Yii::app()->user->id!=$idu){
                       throw new CHttpException(404, 'Usted no esta autorizado para realizar esta acción.');
            }
            else{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
                        'idu'=>$idu,
		));
	
                }
            }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Headquarter;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                 $idu=Yii::app()->user->id;
		if(isset($_POST['Headquarter']))
		{
			$model->attributes=$_POST['Headquarter'];
                       
                        $model->id_user=$idu;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_headquarter,'idu'=>$idu));
		}

		$this->render('create',array(
			'model'=>$model,
                    'idu'=>$idu,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id,$idu)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Headquarter']))
		{
			$model->attributes=$_POST['Headquarter'];
			if($model->save())
				$this->redirect(array('view',
                                'id'=>$model->id_headquarter,
                                'idu'=>$idu
                                ));
		}

		$this->render('update',array(
			'model'=>$model,
                        'idu'=>$idu
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
	public function actionIndex($idu)
	{
		$dataProvider=new CActiveDataProvider('Headquarter',array(
                      'criteria'=>array(
                      'condition'=>'id_user='.$idu,
                       )));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
                        'idu'=>$idu,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($idu)
	{
		$model=new Headquarter('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Headquarter']))
			$model->attributes=$_GET['Headquarter'];
                if(Yii::app()->user->id!=$idu){
                //Yii::app()->user->setFlash('notification','Usted no esta autorizado para realizar esta acción' );
               throw new CHttpException(404, 'Usted no esta autorizado para realizar esta acción.');
                }
                 $model->id_user=$idu;
		$this->render('admin',array(
			'model'=>$model,
                        'idu'=>$idu
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Headquarter the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Headquarter::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Headquarter $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='headquarter-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
