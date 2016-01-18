<?php

class GuideController extends Controller
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
				'actions'=>array( 'view', 'create','admin','delete','addWeigth','upload','urlProcessing','listUser','getValue','deleteValue'),
				'roles'=>array('Cliente','Administrador'),
			),
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('getValue'),
				'roles'=>array('Administrador'),
			),
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array( 'view'),
				'roles'=>array('Encargado Puerto'),
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
            $user=  $this->loadModel($id);
            $userloged=  Users::model()->findByPk(Yii::app()->user->Id);
            $createuser= Users::model()->findByPk($user->id_user);
            $weight=new Weight('Search');
            $weight->id_guide=$id;

                $has=new GuideHasReception('search');
		$has->unsetAttributes();  // clear any default values
		if(isset($_GET['GuideHasReception']))
			$has->attributes=$_GET['GuideHasReception'];      
            if(!Yii::app()->user->checkAccess('Encargado Puerto')&&
               !Yii::app()->user->checkAccess('Administrador')&&
               $user->id_user!=$userloged->id_user&&
               $userloged->id_company!=$createuser->id_company){
                       throw new CHttpException(404, 'Usted no esta autorizado para realizar esta acción.');
            }
                    $this->render('view',array(
                            'model'=>$this->loadModel($id),
                            'weight'=>$weight,
                            'has'=>$has,
                    ));
            }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
                
		$model=new Guide;
		$weight = new Weight;
               
		if(isset($_POST['Guide']))
		{
			$model->attributes=$_POST['Guide'];
			if($model->save()){
                           $this->redirect(array('view','id'=>$model->id_guide));
                        }	
		}
		$this->render('create',array(
			'model'=>$model,
                        'weight'=>$weight,
                        
		));
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id )
	{
           
		$model=$this->loadModel($id);
                $weight=  Weight::model()->findAllByAttributes(array('id_guide'=>$model->id_guide));
                
                
                 if(Yii::app()->user->id!=$model->id_user)
                            throw new CHttpException(404, 'Usted no esta autorizado para realizar esta acción.');
         
		if(isset($_POST['Guide']))
		{
			$model->attributes=$_POST['Guide'];
                        
                        if($model->save()){
                            $this->redirect(array('view','id'=>$model->id_guide));
                        }
                        
		}

		$this->render('update',array(
			'model'=>$model,
                        'weight'=>$weight,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
            $guide=$this->loadModel($id);
           
            try {
                if($guide->delete())
                { 
                if(!empty($guide->pdf_guide)){
                    
                $folder=Yii::app()->basePath.'/../images/guides/'.$guide->id_guide;
                    unlink ($folder."/".$guide->pdf_guide);
                    rmdir($folder);
                    }
                }
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
        catch(CDbException $e)
            {
                if(!isset($_GET['ajax'])){
                    Yii::app()->user->setFlash('error',Yii::t('validation','Can not delete this item because it have elements asociated it'));
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                }
                
            } 
        }
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
               $dataProvider=new CActiveDataProvider('Guide',array(
                      'criteria'=>array(
                      'condition'=>'id_user='.Yii::app()->user->id,
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
		$model=new Guide('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Guide']))
			$model->attributes=$_GET['Guide'];
		$this->render('admin',array(
			'model'=>$model,
		));
            
        }
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Guide the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Guide::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	/**
	 * Performs the AJAX validation.
	 * @param Guide $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='guide-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        public function actionUrlProcessing(){
            $this->redirect($_GET['url']);
    }
    public function actionAddWeigth(){
        
        if($_POST['newguide']!='newguide'){
                $id=$_POST['newguide'];
		$model=$this->loadModel($id);
              $hasweight=  Weight::model()->findAllByAttributes(array('id_guide'=>$id));
                        foreach ($hasweight as $item){
                            Weight::model()->deleteByPk($item->id_weight);
                        }
            }else{		
            $model=new Guide;
            }
            
            $guide=$_POST['guide'];
            $model->num_guide=$guide[0];
            if(!empty($guide[1])){
                $model->pdf_guide=$guide[1];
            }
            if(Yii::app()->user->checkAccess('Administrador')&&$guide[2]!=0)
            {
                $model->id_user=$guide[2];
            }else
                $model->id_user=Yii::app()->user->id;
            $model->id_user_creator=Yii::app()->user->id;
            
            $model->date_guide_create=  date("y-m-d H:i:s");
            $model->sended_guide=0;
            if(!empty($guide[2]))
            $model->id_headquarter=$guide[2];
            else
                  $model->id_headquarter=null;
            
            if($model->save()){
                //files
                $tempFolder=Yii::getPathOfAlias('webroot').'/images/temp/'; 
                $newFolder=Yii::getPathOfAlias('webroot').'/images/guides/';
                if(!empty($model->pdf_guide)&&file_exists($tempFolder.$model->pdf_guide)){
                    $folder=$newFolder."/".$model->id_guide;
                    if(!file_exists($folder))
                        mkdir($folder,0777,true); 
                        copy($tempFolder.$model->pdf_guide,$folder."/".$model->pdf_guide); 
                    }
                
            
               //componentes
                if(isset($_POST['weight'])){
			$weightpost = $_POST['weight'];
			foreach($weightpost as $w){
                            $weight=new Weight;
                            $weight->id_guide=$model->id_guide;
                            //$weight->id_provider=$w[0];
                            //$weight->id_weight_type=$w[1];
                            $weight->amount_weight=$w[2];
                            $weight->amount_left=$w[2];
                            $weight->id_weight_unit=$w[3];
                            $weight->weightprovider=  ucwords(strtolower($w[0]));
                            $weight->weighttype=ucwords(strtolower($w[1]));
                            $weight->save();
                        }
                }
             } 
             echo $model->id_guide;
    }
    public function actionUpload()
    {
    $tempFolder=Yii::getPathOfAlias('webroot').'/images/temp/';         
    Yii::import("ext.EFineUploader.qqFileUploader");
    $uploader = new qqFileUploader();
    $uploader->allowedExtensions = array('pdf');
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
    
    public function actionListUser($term)
    {
        $criteria = new CDbCriteria;
        $criteria->with=array('idCompany');
        $criteria->together=true;
        $criteria->condition = "(LOWER(user_name) like LOWER(:term) OR LOWER(user_lastnames) like LOWER(:term) OR LOWER(user_names) like LOWER(:term) OR LOWER(idCompany.company_name) like LOWER(:term)) and role ='Cliente'";
        $criteria->params = array(':term'=> '%'.$_GET['term'].'%');
        $criteria->limit = 30;
        $models = Users::model()->findAll($criteria);

        $arr = array();
        foreach($models as $model)
        {
        $arr[] = array(
        'label'=>($model->user_names." ".$model->user_lastnames." (".$model->idCompany->company_name.")"), // label for dropdown list
        'value'=>($model->user_names." ".$model->user_lastnames." (".$model->idCompany->company_name.")"), // value for input field
        'id'=>$model->id_user, // return value from autocomplete
        'comp'=>$model->id_company,    

                   );
               }
               echo CJSON::encode($arr);
    }
    
    public function actionGetValue(){
        
        $guides = explode(',', $_POST['theIds']);
        if(!empty($_POST['theIds'])){
        $manifest=new Manifest;
        $manifest->manifest_date=date("y-m-d H:i:s");
        if($manifest->save()){
            foreach($guides as $guide){
               $g=  Guide::model()->findByPk($guide);
               if(empty($g->id_manifest)){
                    $g->id_manifest=$manifest->id_manifest;
               }
               else{
                    Yii::app()->user->setFlash('error',Yii::t('validation','Can not delete this item because it have elements asociated it'));
                    $manifest->delete();
                    $this->redirect(array('admin'));
               }  
               $g->save();
            }
        }
    }
        $this->redirect(array('admin'));
    
        
    }
    
        public function actionDeleteValue(){
        
        $guides = explode(',', $_POST['theIds']);
        if(!empty($_POST['theIds'])){
            foreach($guides as $guide){
               $g=  Guide::model()->findByPk($guide);
               if(!empty($g->id_manifest)){
                    $id=$g->id_manifest;
                    $g->id_manifest=NULL;
                    $g->save();
                    $criteria=new CDbCriteria();
                    $criteria->condition='id_manifest='.$id;
                    $manifest= Guide::model()->findAll($criteria);
                    if(empty($manifest))
                        Manifest::model()->deleteByPk ($id);
               }
               else{
                    Yii::app()->user->setFlash('error',Yii::t('validation','Can not delete this item because it have elements asociated it'));
                   
               }   
            }         
        }   
        $this->redirect(array('admin'));
        }
    }


