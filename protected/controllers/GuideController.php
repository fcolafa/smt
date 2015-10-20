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
				'actions'=>array('index', 'view', 'create','update','admin','delete','addWeigth','upload','urlProcessing'),
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
            $user=  $this->loadModel($id);
            $weight=new Weight('Search');
            $weight->id_guide=$id;
            if($user->id_user!=$idu){
                       throw new CHttpException(404, 'Usted no esta autorizado para realizar esta acción.');
            }
            else
                    $this->render('view',array(
                            'model'=>$this->loadModel($id),
                            'idu'=>$idu,
                            'weight'=>$weight

                    ));
            }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
                Yii::import('ext.multimodelform.MultiModelForm');
		$model=new Guide;
		$weight = new Weight;
                $validatedweight = array();
                $idu=Yii::app()->user->id;
		if(isset($_POST['Guide']))
		{
			$model->attributes=$_POST['Guide'];
                        $model->id_user=$idu;
                        $model->date_guide_create=  date("y-m-d H:i:s");
                        $model->sended_guide=0;
                        $lastId=$model->id_user.$model->id_guide.$model->num_guide."";
                        $file= CUploadedFile::getInstance($model,'pdf_guide');
                        if(isset($model->xml_guide))
                             $xml= CUploadedFile::getInstance($model,'xml_guide');
                        
                        if(!empty($file))
                           try
                                {
                                    $uploadedFile=$file;
                                    $type=$file->getExtensionName();
                                    $filename=$lastId.'.'.$type;
                                    $uploadedFile->saveAs(Yii::app()->basePath.'/../images/guides/'.$filename);
                                    $model->pdf_guide = $filename;
                                    $model->save();
                                    }
                            catch(Exception $e){

                            }
			if($model->save()){
                           $masterValues = array ('id_guide'=>$model->id_guide);
                           $weight->id_guide=$model->id_guide;
                           if (MultiModelForm::save($weight,$validatedweight,$deleteMembers,$masterValues))
                                $this->redirect(array('view','id'=>$model->id_guide, 'idu'=>$idu));
                        }	
		}
		$this->render('create',array(
			'model'=>$model,
                        'idu'=>$idu,
                        'weight'=>$weight,
                        'validatedweight' => $validatedweight,
		));
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id, $idu)
	{
            Yii::import('ext.multimodelform.MultiModelForm');
		$model=$this->loadModel($id);
                $weight=  Weight::model()->findAllByAttributes(array('id_guide'=>$model->id_guide));
                
                
                 if(Yii::app()->user->id!=$idu)
                            throw new CHttpException(404, 'Usted no esta autorizado para realizar esta acción.');
                        

		if(isset($_POST['Guide']))
		{
			$model->attributes=$_POST['Guide'];
                        $masterValues = array ('id_guide'=>$model->id_guide);
                        $lastId=$model->id_user.$model->id_guide.$model->num_guide."";
                        $file= CUploadedFile::getInstance($model,'pdf_guide');
                        
                        if(!empty($file))
                           try{
                                    $uploadedFile=$file;
                                    $type=$file->getExtensionName();
                                    $filename=$lastId.'.'.$type;
                                    if($filename!= $model->pdf_guide)
                                        unlink(Yii::app()->basePath.'/../images/guides/'.$guide->pdf_guide.$filename);
                                    $uploadedFile->saveAs(Yii::app()->basePath.'/../images/guides/'.$filename);
                                    $model->pdf_guide = $filename;
                                    $model->save();
                                    }
                            catch(Exception $e){

                            }
			if(MultiModelForm::save($weight,$validatedweight,$deleteMembers,$masterValues) && $model->save()){
                                $this->redirect(array('view','id'=>$model->id_guide, 'idu'=>$idu));
                        }
		}

		$this->render('update',array(
			'model'=>$model,
                        'idu'=>$idu,
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
            $idu=$guide->id_user;
            try {
                if($guide->delete())
                {
                    unlink (Yii::app()->basePath.'/../images/guides/'.$guide->pdf_guide);
                }
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin','idu'=>$idu));
	}
        catch(CDbException $e)
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
	public function actionIndex($idu)
	{
               $dataProvider=new CActiveDataProvider('Guide',array(
                      'criteria'=>array(
                      'condition'=>'id_user='.$idu,
                       )));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,'idu'=>$idu,
		));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin($idu)
	{
		$model=new Guide('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Guide']))
			$model->attributes=$_GET['Guide'];
   
        if(Yii::app()->user->id!=$idu){
                //Yii::app()->user->setFlash('notification','Usted no esta autorizado para realizar esta acción' );
               throw new CHttpException(404, 'Usted no esta autorizado para realizar esta acción.');
        }
        else{
                $model->id_user=$idu;
		$this->render('admin',array(
			'model'=>$model,
                        'idu'=>$idu
		));
            }
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
            $model->date_guide_create=  date("y-m-d H:i:s");
            $model->sended_guide=0;
            $model->id_user=Yii::app()->user->id;
            if($model->save())
            {
               //componentes
                if(isset($_POST['weight'])){
			$weightpost = $_POST['weight'];
			foreach($weightpost as $w){
                            $weight=new Weight;
                            $weight->id_guide=$model->id_guide;
                            $weight->id_provider=$w[0];
                            $weight->id_weight_type=$w[1];
                            $weight->amount_weight=$w[2];
                            $weight->id_weight_unit=$w[3];
                            $weight->save();
                        }
			
                }
             } 
             echo $model->id_guide.'?idu='.$model->id_user;
    }
    
    public function actionUpload($id)
        {
            $guide=  $this->loadModel($id);
            $tempFolder=Yii::getPathOfAlias('webroot').'/images/guides/';         
            Yii::import("ext.EFineUploader.qqFileUploader");
            $uploader = new qqFileUploader();
            $uploader->allowedExtensions = array('pdf');
            $uploader->sizeLimit = 1 * 1024 * 1024;//maximum file size in bytes
            $uploader->chunksFolder = $tempFolder;
            $guide->pdf_guide=$guide->id_user.$id.'.pdf';
            $result = $uploader->handleUpload($tempFolder);
            $result['filename'] = $uploader->getUploadName();
            $result['folder'] = $tempFolder;
            $uploadedFile=$tempFolder.$result['filename'];
            $guide->save();
            rename($uploadedFile, $tempFolder.$guide->pdf_guide);
            header("Content-Type: text/plain");
            $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            echo $result;
            Yii::app()->end();
        }
}
