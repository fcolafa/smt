<?php

class ReceptionController extends Controller
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
				'actions'=>array('create','ListGuides'),
				'roles'=>array('Encargado Puerto','Capitan','Jefe Centro'),
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
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Reception;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Reception']))
		{
			$model->attributes=$_POST['Reception'];
                        $model->id_user=  Yii::app()->user->id;
                        $model->reception_date=date("y-m-d H:i:s");
                        if(isset($_POST['Reception']['_guides']))
                           $model->_guides=$_POST['Reception']['_guides'];
			if($model->save()){
                            if(!empty($model->_guides))
                                foreach($model->_guides as $idg){
                                    $has=new GuideHasReception;
                                    $has->id_guide=$idg;
                                    $has->id_reception=$model->id_reception;
                                    $has->save();
             
                                }
                            Yii::app()->user->setFlash('success',Yii::t('validation','Recepción confirmada'));
                            $model=new Reception;
                                $this->render('create',array(
                                                'model'=>$model,
                                        ));
                           
                        }				
		}
		$this->render('create',array(
			'model'=>$model,
		));
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

		if(isset($_POST['Reception']))
		{
			$model->attributes=$_POST['Reception'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_reception));
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
		$dataProvider=new CActiveDataProvider('Reception');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Reception('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Reception']))
			$model->attributes=$_GET['Reception'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Reception the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Reception::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Reception $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='reception-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        public function actionListGuides($term)
        {
            $criteria = new CDbCriteria;
            $criteria->with=array('idUser.idCompany');
            $criteria->together=true;
            $criteria->condition = "(LOWER(id_guide) like LOWER(:term) OR LOWER(num_guide) like LOWER(:term) OR LOWER(idCompany.company_name) like LOWER(:term))";
            $criteria->params = array(':term'=> '%'.$_GET['term'].'%');
            $criteria->limit = 30;
            $models = Guide::model()->findAll($criteria);

            $arr = array();
            foreach($models as $model)
            {
                $arr[] = array(
                'label'=>($model->num_guide." (".$model->idUser->idCompany->company_name.")" ),// label for dropdown list
                'value'=> "",
                'link'=>  CHtml::link(CHtml::encode($model->num_guide." (".$model->idUser->idCompany->company_name.")"), array('guide/view','id'=>$model->id_guide,), array('target'=>'_blank')), // value for input field
                'id'=>$model->id_guide, // return value from autocomplete
                       );
             }
             echo CJSON::encode($arr);
        }
}