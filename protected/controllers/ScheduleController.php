<?php

class ScheduleController extends Controller
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
                                        'actions'=>array( 'view', 'create','update','admin','delete','updateSchedule'),
                                        'roles'=>array('Motorista'),
                                ),
                      array('allow', // allow authenticated user to perform 'create' and 'update' actions
                                        'actions'=>array( 'view', 'admin'),
                                        'roles'=>array('Administrador'),
                                ),
                                array('deny',  // deny all users
                                        'users'=>array('*'),
                                ),
                        );
	}
              public function actionTest(){
            
//               $es = new EditableSaver('Schedule');
//                try {
//                    
//                    $es->onBeforeUpdate = function($event) {
//        $event->sender->setAttribute('arrive_date', date("y/m/d H:i:s"));
//    };
//                    $es->update();
//                } catch(CException $e) {
//                    echo CJSON::encode(array('success' => false, 'msg' => $e->getMessage()));
//                    return;
//                }
//                echo CJSON::encode(array('success' => true));

        }
        
        public function actionUpdateSchedule()
    {
      
        
        $es = new EditableSaver('Schedule');
//        $es->onBeforeUpdate = function($event) {
//            $event->sender->setAttribute('arrive_date', date('y-m-d H:i:s'));
 //       };
        try {
        $es->update();
    } catch(CException $e) {
        echo CJSON::encode(array('success' => false, 'msg' => $e->getMessage()));
        return;
    }
    echo CJSON::encode(array('success' => true));
       
        }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($ids)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($ids),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Schedule;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Schedule']))
		{
			$model->attributes=$_POST['Schedule'];
                        $model->id_schedule=  uniqid()." ".date("y-m-d H:i:s");
                        $model->schedule_date=date("y-m-d H:i:s");
                             if(!empty( $model->ranch_date))
                            $model->ranch_date=Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm', $model->ranch_date);
                        else 
                             $model->ranch_date=null;
                        
                        if(!empty( $model->arrive_date))
                            $model->arrive_date=Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm', $model->arrive_date);
                        else
                             $model->arrive_date=null;
                       $inits=$model->initial_stock; 
                       $ranchd=$model->ranch_diesel;
                       $do=$model->delivery_DO;
                       $fs=$model->final_stock;
                       
                       //calulate day comsuption 
                       if(empty($inits))
                            $inits=0;
                        if(empty($ranchd))
                            $ranchd=0;
                        if(empty($do))
                            $do=0;
                        if(empty($fs))
                            $fs=0;
                        $model->day_comsuption=$inits+$ranchd-$do-$fs;
                        $model->id_user=  Yii::app()->user->id;
                        
                        
                        $inithbb=$model->init_bb_motor;
                        $endhbb=$model->finish_bb_motor;
                        $initheb=$model->init_eb_motor;
                        $endheb=$model->finish_eb_motor;
                        //calulate total hour
                        if(empty($inithbb))
                            $inithbb=0;
                        if(empty($endhbb))
                            $endhbb=0;
                        if(empty($initheb))
                            $initheb=0;
                        if(empty($endheb))
                            $endheb=0;
                        $model->total_hours=(($endhbb-$inithbb)+($endheb-$initheb))/2;
                        if(empty($model->earthing))
                            $model->earthing=null;
			if($model->save())
				$this->redirect(array('view','ids'=>$model->id_schedule));
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
	public function actionUpdate($ids)
	{
		$model=$this->loadModel($ids);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                if($model->id_user!=Yii::app()->user-id)
                    throw new CHttpException(404, 'Usted no esta autorizado para realizar esta acción.');
		if(isset($_POST['Schedule']))
		{
			$model->attributes=$_POST['Schedule'];
                        if(!empty( $model->ranch_date))
                            $model->ranch_date=Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm', $model->ranch_date);
                        else 
                             $model->ranch_date=null;
                        
                        if(!empty( $model->arrive_date))
                            $model->arrive_date=Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm', $model->arrive_date);
                        else
                             $model->arrive_date=null;
                       $inits=$model->initial_stock; 
                       $ranchd=$model->ranch_diesel;
                       $do=$model->delivery_DO;
                       $fs=$model->final_stock;
                       
                       //calulate day comsuption 
                       if(empty($inits))
                            $inits=0;
                        if(empty($ranchd))
                            $ranchd=0;
                        if(empty($do))
                            $do=0;
                        if(empty($fs))
                            $fs=0;
                        $model->day_comsuption=$inits+$ranchd-$do-$fs;
                        $model->id_user=  Yii::app()->user->id;
                        
                        
                        $inithbb=$model->init_bb_motor;
                        $endhbb=$model->finish_bb_motor;
                        $initheb=$model->init_eb_motor;
                        $endheb=$model->finish_eb_motor;
                        //calulate total hour
                        if(empty($inithbb))
                            $inithbb=0;
                        if(empty($endhbb))
                            $endhbb=0;
                        if(empty($initheb))
                            $initheb=0;
                        if(empty($endheb))
                            $endheb=0;
                        $model->total_hours=(($endhbb-$inithbb)+($endheb-$initheb))/2;
			if($model->save())
				$this->redirect(array('view','ids'=>$model->id_schedule));
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
	public function actionDelete($ids)
	{
		$this->loadModel($ids)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Schedule');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Schedule('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Schedule']))
			$model->attributes=$_GET['Schedule'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Schedule the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Schedule::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Schedule $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='schedule-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
