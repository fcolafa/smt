<?php

class ManifestController extends Controller
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
				'actions'=>array( 'view','admin','create','delete','update','ListGuides','ManifestToExcel'),
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
            $has=new Weight('Search');
            if(isset($_GET['Weight']))
                $has->attributes=$_GET['Weight']; 
		$this->render('view',array(
			'model'=>$this->loadModel($id),
                        'has'=>$has,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Manifest;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Manifest']))
		{
			$model->attributes=$_POST['Manifest'];
                        $model->manifest_date=date("y-m-d H:i:s");
                        
                          if(!empty( $model->manifest_charge_date))
                            $model->manifest_charge_date=Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm', $model->manifest_charge_date);
                        else
                             $model->manifest_charge_date=null;
                          if(!empty( $model->manifest_sailing))
                            $model->manifest_sailing=Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm', $model->manifest_sailing);
                        else
                             $model->manifest_sailing=null;
                          if(!empty( $model->manifest_return))
                            $model->manifest_return=Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm', $model->manifest_return);
                        else
                             $model->manifest_return=null;
                      
                        if(isset($_POST['Reception']['_guides']))
                           $model->_guides=$_POST['Reception']['_guides'];
                        
			if($model->save()){
                            
                            if(!empty($model->_guides))
                                $order=0;
                                foreach($model->_guides as $idg){
                                $guide= Guide::model()->findByPk($idg);
                                $guide->id_manifest=$model->id_manifest;
                                $guide->manifest_order_guide=$order++;
                                $guide->save();
                                }
				$this->redirect(array('view','id'=>$model->id_manifest));
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
                          $newfile=array();
                          $criteria=new CDbCriteria();
                          $criteria->condition="id_manifest=".$id;
                          $guides=Guide::model()->findAll($criteria);
                           if(!empty($guides)){
                            foreach($guides as  $value){
                                $newfile[$value->id_guide]=$value->id_guide;
                            }
                        $model->_guides=$newfile;
                        }
		if(isset($_POST['Manifest']))
		{
			$model->attributes=$_POST['Manifest'];
                        if(isset($_POST['Reception']['_guides']))
                            
                           $model->_guides=$_POST['Reception']['_guides'];
                          $rest= array_diff($newfile, $model->_guides);
                         
                          foreach($rest as $r){
                              
                              $guidelete=  Guide::model()->findByPk($r);
                              $guidelete->id_manifest=null;
                              $guidelete->save(false);
                          }
                      
			if($model->save()){
                            
                          
                                if(!empty($model->_guides)){
                                $order=0;
                                foreach($model->_guides as $idg){
                                $guide= Guide::model()->findByPk($idg);
                                $guide->id_manifest=$model->id_manifest;
                                $guide->manifest_order_guide=$order++;
                                $guide->save();
                                }
                                }
				$this->redirect(array('view','id'=>$model->id_manifest));
                        }
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
//                $criteria=new CDbCriteria();
//                $criteria->condition="id_manifest=".$id;
//                $guides=  Guide::model()->findAll($criteria);
//                if(!empty($guides))
//                    foreach($guides as $g){
//                    $guide=  Guide::model()->findByPk($g->id_guide);
//                    $guide->id_manifest=null;
//                    $guide->save();
//                    }
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
		$dataProvider=new CActiveDataProvider('Manifest');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Manifest('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Manifest']))
			$model->attributes=$_GET['Manifest'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Manifest the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Manifest::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Manifest $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='manifest-form')
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
                $arr2=array();
                $cri=new CDbCriteria();
                $cri->condition="id_guide=".$model->id_guide;
                $arrayGuide= Weight::model()->findAll($cri);
                $i=0;
                foreach($arrayGuide as  $a){
                    $arr2[$i]=array(
                        'id_guide'=>$a->id_guide,
                        'id_weight'=>$a->id_weight,
                        'amount_left'=>$a->amount_left,
                        'weightprovider'=>$a->weightprovider,
                        'weighttype'=>$a->weighttype,
                        'unit'=>$a->idWeightUnit->weight_unit_name,
                        
                    );
                    $i++;
                }
                $arr[] = array(
                'label'=>($model->num_guide." (".$model->idUser->idCompany->company_name.")" ),// label for dropdown list
                'value'=> "",
                'link'=>  CHtml::link(CHtml::encode($model->num_guide." (".$model->idUser->idCompany->company_name.")"), array('guide/view','id'=>$model->id_guide,), array('target'=>'_blank')), // value for input field
                'id'=>$model->id_guide, // return value from autocomplete
                // 'guide'=>  CHtml::listData(Weight::model()->findAll($guides),'id_weight','amount'),
                 'guides'=> $arr2,
                       );
                
             }
             
             echo CJSON::encode($arr);
        }
        
//          public function actionListGuides($term)
//        {
//            $criteria = new CDbCriteria;
//            $criteria->with=array('idUser.idCompany');
//            $criteria->together=true;
//            $criteria->condition = "(LOWER(id_guide) like LOWER(:term) OR LOWER(num_guide) like LOWER(:term) OR LOWER(idCompany.company_name) like LOWER(:term))";
//            $criteria->params = array(':term'=> '%'.$_GET['term'].'%');
//            $criteria->limit = 30;
//            $models = Guide::model()->findAll($criteria);
//
//            $arr = array();
//            foreach($models as $model)
//            {
//                $arr[] = array(
//                'label'=>($model->num_guide." (".$model->idUser->idCompany->company_name.")" ),// label for dropdown list
//                'value'=> "",
//                'link'=>  CHtml::link(CHtml::encode($model->num_guide." (".$model->idUser->idCompany->company_name.")"), array('guide/view','id'=>$model->id_guide,), array('target'=>'_blank')), // value for input field
//                'id'=>$model->id_guide, // return value from autocomplete
//                       );
//             }
//             echo CJSON::encode($arr);
        //}
        public function actionManifestToExcel($id){
            $objPHPExcel = new PHPExcel();
            ini_set('display_errors', TRUE);
            ini_set('display_startup_errors', TRUE);
            error_reporting(E_ALL);
            define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
            /** Include path **/
            date_default_timezone_set('UTC');
           // echo date('H:i:s') . " Create new PHPExcel object\n";
            $objPHPExcel = new PHPExcel();

            // Set properties
         //   echo date('H:i:s') . " Set properties\n";
            $objPHPExcel->getProperties()->setCreator("SMT");
            $objPHPExcel->getProperties()->setLastModifiedBy("SMT");

            // Set default font
            $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Arial');
            $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
           // echo date('H:i:s') . " Add some data\n";
          //  echo date('H:i:s').' Set document properties'.EOL;
            $objPHPExcel->getActiveSheet()->getStyle('A0:O54')->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'FFFFFF')
                    ),
                    'font'  => array(
                        
                        'color' => array('rgb' => '000000'),
                         ),
            ));
            //----------------------------------------------------------
           $model= $this->loadModel($id);
           
           /**************************************************
            * Body and Image header
            */
           
           $objDrawing = new PHPExcel_Worksheet_HeaderFooterDrawing();
           $objDrawing->setName('SMT logo');
           $objDrawing->setPath(Yii::app()->basePath.DIRECTORY_SEPARATOR."../themes/blackboot/img/smtlogo.png");
           $objDrawing->setCoordinates('C2'); // pins the top-left corner of the image to cell D24
           //$objDrawing->setOffsetX(4); //
           $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); 
           $objPHPExcel->getActiveSheet()->setTitle('Manifiesto de Carga');
           $row=8;
           $column='F';
           
           $objPHPExcel->getActiveSheet()->setCellValue($column.$row, 'Manifiesto de Carga N°:'.$model->id_manifest);
           $objPHPExcel->getActiveSheet()->mergeCells($column.$row.':O8');
           $this->paintFillAndLetter($objPHPExcel, $column.$row, 'FFFFFF', '000080',26); 
            
           /**
            * headers and title
            */
           
           $titles=array(array('Cliente','Centro','Guía','Cantidad','Fecha de Programa','Fecha entrega real','O/C','Lote','Envase','Dieta','Observación','Estado Sanitario'));
            $objPHPExcel->getActiveSheet()->fromArray($titles, null, 'C16');
           
           $row=10;
           $column='C';
           $cellin=$column;
           $head=$row;
           $this->drawblackBorder($objPHPExcel, $column.$row.':'.$column.$row);
           $objPHPExcel->getActiveSheet()->setCellValue($column.$row++, 'Nave');
           $this->drawblackBorder($objPHPExcel, $column.$row.':'.$column.$row);
           $objPHPExcel->getActiveSheet()->setCellValue($column.$row++, 'Fecha Carga');
           $this->drawblackBorder($objPHPExcel, $column.$row.':'.$column.$row);
           $objPHPExcel->getActiveSheet()->setCellValue($column.$row++, 'Puerto de Embarque');
           $this->drawblackBorder($objPHPExcel, $column.$row.':'.$column.$row);
           $objPHPExcel->getActiveSheet()->setCellValue($column.$row, 'N° Manifiesto');
           $this->drawblackBorder($objPHPExcel, $column.$head.':'.$column.$row);
           $this->paintFillAndLetter($objPHPExcel, $column.$head.':'.$column.$row, '000080', 'FFFFFF',11); 
           $row=10;
           $column++;
           $cellin=$column;
           $head=$row;
           $endc='H';
           
           $objPHPExcel->getActiveSheet()->mergeCells($column.$row.':'.$endc.$row);
           $this->drawblackBorder($objPHPExcel, $column.$row.':'.$endc.$row);
           $objPHPExcel->getActiveSheet()->setCellValue($column.$row++,@$model->idEmbarkation->embarkation_name);
           $objPHPExcel->getActiveSheet()->mergeCells($column.$row.':'.$endc.$row);
           if(!empty($model->manifest_charge_date)){
              
           $unixTimestamp =strtotime($model->manifest_charge_date);
            $excelDate = PHPExcel_Shared_Date::PHPToExcel($unixTimestamp);
           }else
                $excelDate='';
           $objPHPExcel->getActiveSheet()->getStyle($column.$row)->getNumberFormat()->setFormatCode('dd-mmmm-yyyy hh:mm');
           $this->drawblackBorder($objPHPExcel, $column.$row.':'.$endc.$row);
           $objPHPExcel->getActiveSheet()->setCellValue($column.$row++,$excelDate);
           $objPHPExcel->getActiveSheet()->mergeCells($column.$row.':'.$endc.$row);
           $this->drawblackBorder($objPHPExcel, $column.$row.':'.$endc.$row);
           $objPHPExcel->getActiveSheet()->setCellValue($column.$row++,@$model->idHeadquarter->headquarter_name);
           $objPHPExcel->getActiveSheet()->mergeCells($column.$row.':'.$endc.$row);
           $this->drawblackBorder($objPHPExcel, $column.$row.':'.$endc.$row);
           $objPHPExcel->getActiveSheet()->setCellValue($column.$row, $model->id_manifest); 
           $cellend=$column;
           $head2=$row;
           $objPHPExcel->getActiveSheet()->getStyle($cellin.$head.':'.$cellend.$head2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
           
           $row=10;
           $column="I";
           $endc="J13";
           $objPHPExcel->getActiveSheet()->setCellValue($column.$row, 'Planificación General Fechas'); 
           $objPHPExcel->getActiveSheet()->mergeCells($column.$row.':'.$endc);
           $this->drawblackBorder($objPHPExcel, $column.$row.':'.$endc);
           $objPHPExcel->getActiveSheet()->getStyle($column.$row.':'.$endc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
           $objPHPExcel->getActiveSheet()->getStyle($column.$row.':'.$endc)->getAlignment()->setWrapText(true);
           $column="K";
            $this->drawblackBorder($objPHPExcel, $column.$row.':'.$column.$row);
           $objPHPExcel->getActiveSheet()->setCellValue($column.$row++, 'Zarpe');
            $this->drawblackBorder($objPHPExcel, $column.$row.':'.$column.$row);
           $objPHPExcel->getActiveSheet()->setCellValue($column.$row, 'Retorno');
           $row=10;
           $column++;
           $columnend='M';
           $this->drawblackBorder($objPHPExcel,$column.$row.':'.$columnend.$row);
           $objPHPExcel->getActiveSheet()->mergeCells($column.$row.':'.$columnend.$row);
           $objPHPExcel->getActiveSheet()->setCellValue($column.$row++, $model->manifest_sailing);
           $this->drawblackBorder($objPHPExcel,$column.$row.':'.$columnend.$row);
           $objPHPExcel->getActiveSheet()->mergeCells($column.$row.':'.$columnend.$row);
           $objPHPExcel->getActiveSheet()->setCellValue($column.$row++, $model->manifest_return);
           
           $this->drawbluefill($objPHPExcel, 'c16:N16');
           $column="C";
           for($i=0;$i<=11;$i++){
                $this->drawblackBorder($objPHPExcel, $column.'16');
                $column++;       
           }
           $criteria=new CDbCriteria();
           $criteria->condition="id_manifest=".$id;
           $criteria->order="manifest_order_guide ASC";
           $guides= Guide::model()->findAll($criteria);
          
          $row=17;
            $column="C";
             $totalamount=0;
           foreach($guides as $guide){
               $column="C";
              
               $criteria=new CDbCriteria();
               $criteria->condition="id_guide=".$guide->id_guide;
               $weights=  Weight::model()->findAll($criteria);               
               $amount=0;
               
               foreach($weights as $weight){
                   $amount+=$weight->amount_weight;
               }
               $totalamount+=$amount;
                $this->drawblackBorder($objPHPExcel,$column.$row.':'.$column.$row);
               $objPHPExcel->getActiveSheet()->setCellValue($column++.$row, @$guide->idUser->idCompany->company_name);
               $this->drawblackBorder($objPHPExcel,$column.$row.':'.$column.$row);
               $objPHPExcel->getActiveSheet()->setCellValue($column++.$row, @$guide->idDestination->headquarter_name);
                $this->drawblackBorder($objPHPExcel,$column.$row.':'.$column.$row);
               $objPHPExcel->getActiveSheet()->setCellValue($column++.$row, $guide->num_guide);
                $this->drawblackBorder($objPHPExcel,$column.$row.':'.$column.$row);
               $objPHPExcel->getActiveSheet()->setCellValue($column++.$row, $amount);
                $this->drawblackBorder($objPHPExcel,$column.$row.':'.$column.$row);
               $objPHPExcel->getActiveSheet()->setCellValue($column++.$row, "");
                $this->drawblackBorder($objPHPExcel,$column.$row.':'.$column.$row);
               $objPHPExcel->getActiveSheet()->setCellValue($column++.$row, "");
                $this->drawblackBorder($objPHPExcel,$column.$row.':'.$column.$row);
               $objPHPExcel->getActiveSheet()->setCellValue($column++.$row, "");
                $this->drawblackBorder($objPHPExcel,$column.$row.':'.$column.$row);
               $objPHPExcel->getActiveSheet()->setCellValue($column++.$row, "");
                $this->drawblackBorder($objPHPExcel,$column.$row.':'.$column.$row);
               $objPHPExcel->getActiveSheet()->setCellValue($column++.$row, "");
                $this->drawblackBorder($objPHPExcel,$column.$row.':'.$column.$row);
               $objPHPExcel->getActiveSheet()->setCellValue($column++.$row, "");
                $this->drawblackBorder($objPHPExcel,$column.$row.':'.$column.$row);
               $objPHPExcel->getActiveSheet()->setCellValue($column++.$row, "");
                $this->drawblackBorder($objPHPExcel,$column.$row.':'.$column.$row);
               $objPHPExcel->getActiveSheet()->setCellValue($column++.$row++, "");
           
               
               }
               
               for ($i=0;$i<4;$i++){
                   $column='C';
                  for ($j=0;$j<11;$j++){
                      if($i==3&& $j==0){
                         $objPHPExcel->getActiveSheet()->setCellValue($column.$row, "Total");
                         $this->paintFillAndLetter($objPHPExcel, $column.$row, '000080', 'FFFFFF',11);                  
                      }
                      if($i==3&& $j==3){
                           $objPHPExcel->getActiveSheet()->setCellValue($column.$row, $totalamount);
                           $this->paintFillAndLetter($objPHPExcel, $column.$row, '000080', 'FFFFFF',11);                      
                      }
                      $this->drawblackBorder($objPHPExcel,$column++.$row.':'.$column.$row);
                  } 
                  $row++;
               }
               $row++;
                $column="C";
                $this->paintFillAndLetter($objPHPExcel, $column.$row, '000080', 'FFFFFF',11);
               $this->drawblackBorder($objPHPExcel,$column.$row.':'.$column.$row);
               $objPHPExcel->getActiveSheet()->setCellValue($column++.$row, 'Observaciones:');
              // $this->drawblackBorder($objPHPExcel,$column.$row.':'.$column.$row);
               $objPHPExcel->getActiveSheet()->setCellValue($column.$row++, $model->manifest_observation);
               $row++;
               $this->paintFillAndLetter($objPHPExcel, $column.$row, '000080', 'FFFFFF',11);
               $columnend='N';
               $objPHPExcel->getActiveSheet()->mergeCells($column.$row.':'.$columnend.$row);
                $this->drawblackBorder($objPHPExcel,$column.$row.':'.$columnend.$row);
               $objPHPExcel->getActiveSheet()->setCellValue($column.$row++,'Recepción de carga conforme');
              
               
               $titles=array('Orden Entrega','Centro','Nombre Jefe de Centro','RUT Jefe de Centro','Firma Jefe de centro','Observaciones');
              // $this->drawblackBorder($objPHPExcel,'C'.$row.':'.'H'.$row);
              // $this->paintFillAndLetter($objPHPExcel,'C'.$row.':'.'H'.$row, '000080', 'FFFFFF',11);
               
             $column="C";
              foreach($titles as $t){
                  $this->paintFillAndLetter($objPHPExcel, $column.$row, '000080', 'FFFFFF',11);
                  $this->drawblackBorder($objPHPExcel,$column.$row.':'.$column.$row);
                  $objPHPExcel->getActiveSheet()->setCellValue($column.$row, $t);
                 
                  switch ($t):
                  case 'Nombre Jefe de Centro':
                     $columnend='H';
                     $objPHPExcel->getActiveSheet()->mergeCells($column.$row.':'.$columnend.$row);
                      $this->drawblackBorder($objPHPExcel,$column.$row.':'.$columnend.$row);
                     $column=$columnend;
                    break;
                  case 'RUT Jefe de Centro':
                      $columnend='J';
                      $objPHPExcel->getActiveSheet()->mergeCells($column.$row.':'.$columnend.$row);
                            $this->drawblackBorder($objPHPExcel,$column.$row.':'.$columnend.$row);
                      
                      $column=$columnend;
                    break;
                  case 'Firma Jefe de centro':
                      $columnend='L';
                      $objPHPExcel->getActiveSheet()->mergeCells($column.$row.':'.$columnend.$row);
                      $this->drawblackBorder($objPHPExcel,$column.$row.':'.$columnend.$row);
                      $column=$columnend;
                    break;
                  case 'Observaciones':
                      $columnend='N';
                      $objPHPExcel->getActiveSheet()->mergeCells($column.$row.':'.$columnend.$row);
                      $this->drawblackBorder($objPHPExcel,$column.$row.':'.$columnend.$row);
                      $column=$columnend;
                    break;
                  endswitch;
                 
                  $column++;
                    //$objPHPExcel->getActiveSheet()->setCellValue($column++.$row, $t);
                  }
                  $row++;
           
               $iterator=1;
                    
                foreach($guides as $guide){
                    $column="C";
                    
                     //$this->drawblackBorder($objPHPExcel,$column.$row.':'.$column.$row);
                    $this->drawblackBorder($objPHPExcel,$column.$row.':'.$column.$row);
                    $objPHPExcel->getActiveSheet()->setCellValue($column++.$row, $iterator++);
                   $this->drawblackBorder($objPHPExcel,$column.$row.':'.$column.$row);
                    $objPHPExcel->getActiveSheet()->setCellValue($column++.$row, @$guide->idDestination->headquarter_name);
                   
                    $columnend='H';
                    $objPHPExcel->getActiveSheet()->mergeCells($column.$row.':'.$columnend.$row);
                    $this->drawblackBorder($objPHPExcel,$column.$row.':'.$columnend.$row);
                    $objPHPExcel->getActiveSheet()->setCellValue($column.$row, "");
                    $column=$columnend;
                    $column++;
                    
                    $columnend='J';
                    $objPHPExcel->getActiveSheet()->mergeCells($column.$row.':'.$columnend.$row);
                    $this->drawblackBorder($objPHPExcel,$column.$row.':'.$columnend.$row);
                    $objPHPExcel->getActiveSheet()->setCellValue($column.$row, "");
                    $column=$columnend;
                    $column++;
                    $columnend='L';
                    $objPHPExcel->getActiveSheet()->mergeCells($column.$row.':'.$columnend.$row);
                    $this->drawblackBorder($objPHPExcel,$column.$row.':'.$columnend.$row);
                    $objPHPExcel->getActiveSheet()->setCellValue($column.$row, "");
                    $column=$columnend;
                    $column++;
                   $columnend='N';
                   $objPHPExcel->getActiveSheet()->mergeCells($column.$row.':'.$columnend.$row);
                   $this->drawblackBorder($objPHPExcel,$column.$row.':'.$columnend.$row);
                   $objPHPExcel->getActiveSheet()->setCellValue($column.$row++, "");
               }
               
               
            
               
               
               
          $objPHPExcel->getActiveSheet()->getStyle('A16:M54')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);
                    foreach(range('A','N') as $columnID) {
                        $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
                            ->setAutoSize(true);
                    }
        
     
               
                    
                    
            $xlsName = 'Manifiesto_de_carga_n'.$id.'.xls';
           // header('Content-Type: application/vnd.ms-excel');
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment;filename="'.$xlsName.'"');
            header('Cache-Control: max-age=0');
     
            // If you're serving to IE 9, then the following may be needed
           // header('Cache-Control: max-age=1');
            
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');      
            Yii::app()->end();            
        }
    private function drawblackBorder($objPHPExcel,$cordinate,$color='000000'){
        $objPHPExcel->getActiveSheet()->getStyle($cordinate)->applyFromArray(
           array(
               'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('rgb' => $color),
                ),
            )));
    }
    private function drawbluefill($objPHPExcel,$cordinate){
             $objPHPExcel->getActiveSheet()->getStyle($cordinate)->applyFromArray(
                array(
                    
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '000080')
                    ),
                    'font'  => array(
                        'bold'  => true,
                        'color' => array('rgb' => 'FFFFFF'),
                        ),
            ));
        
       
    }
    private function paintFillAndLetter($objPHPExcel,$cordinate,$colorfill,$colorfont,$fontsize){
                $objPHPExcel->getActiveSheet()->getStyle($cordinate)->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => $colorfill)
                    ),
                    'font'  => array(
                        'bold'  => true,
                        'color' => array('rgb' => $colorfont,
                        'size'  => $fontsize),
                        ),
            ));
    }
}
