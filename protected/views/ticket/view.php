<?php
/* @var $this TicketController */
/* @var $model Ticket */
$this->breadcrumbs=array(
	Yii::t('database','Tickets')=>array('admin'),
	$model->id_ticket,
);
$this->menu=array(
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Ticket'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('Cliente')),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Ticket'), 'url'=>array('admin')),
);
$days=" ";

if($model->ticket_status!='Cerrado'){
    $days=" (".$model->getDaysPassed()." Día(s) transcurrido desde emisión)";
}
?>
<h1> Detalle <?php echo Yii::t('database','Ticket')?> N°<?php echo $model->id_ticket." : ".$model->ticket_subject. $days  ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idEmbarkation.embarkation_name',
            array(
              'name'=>'Cliente',
                'value'=>$model->idUser->idCompany->company_name,
            ),
              array(
              'name'=>'Centro',
              'value'=>$model->idHeadquarter->headquarter_name,
            ),
              array(
                'name'=>'Nombre',
                'value'=>CHtml::link(
                        ' '.$model->idUser->user_names.' '.
                        ' '.$model->idUser->user_lastnames
                        ,array('users/viewClient','id'=>$model->id_user)),
                'type'=>'raw',
                'visible'=>Yii::app()->user->checkAccess('Cliente')
                  
            ),
              array(
                'name'=>'Nombre',
                'value'=>CHtml::link(
                        ' '.$model->idUser->user_names.' '.
                        ' '.$model->idUser->user_lastnames
                        ,array('users/view','id'=>$model->id_user)),
                'type'=>'raw',
                'visible'=>Yii::app()->user->checkAccess('Administrador')
                  
            ),
                array(
                  
                'name'=>'ticket_date',
                //'value'=>'date("d M Y",strtotime($data["work_date"]))'
                'value'=>Yii::app()->dateFormatter->format("d MMMM y | HH:mm:ss",strtotime($model->ticket_date))
                
            ),
               array(
                  
                'name'=>'ticket_date_incident',
                //'value'=>'date("d M Y",strtotime($data["work_date"]))'
                'value'=>Yii::app()->dateFormatter->format("d MMMM y | HH:mm:ss",strtotime($model->ticket_date_incident))
            ),
             array(
            'name'=>'Archivos Adjuntos',
            'type'=>'raw',
            'value'=>$model->getTicketFile(),
           // 'value'=> //CHtml::link(CHtml::encode($model->ticket_file), Yii::app()->baseUrl . '/images/tickets/' . $model->ticket_file),
           
            ),
            'ticket_subject',
            'idClassification.classification_name',
            'ticket_description',
            'ticket_status',

              array(
                  
                'name'=>'ticket_close_date',
                //'value'=>'date("d M Y",strtotime($data["work_date"]))'
                'value'=>Yii::app()->dateFormatter->format("d MMMM y | HH:mm:ss",strtotime($model->ticket_close_date)),
                  'visible'=>!empty($model->ticket_close_date)
            ),
        
           
                
		
	),
)); ?>
<br>

<?php
 echo TicketController::getTicketMessages($model->id_ticket);
 ?>

<div class="container-btn">
<?php 

if(Yii::app()->user->checkAccess('Administrador')&& $model->ticket_status!="Cerrado"){
  echo CHtml::link('<div class="messageButton white">
	    	<img src='.'"'. Yii::app()->theme->baseUrl.'/img/big_icons/icon-mail.png" alt="añadir medida correctiva"  width="15%" />
	    	<div class=""><h4>Responder y/o Asignar </h4></div>
		</div>', 
		array('ticket/messageTicket', 'id'=>$model->id_ticket),
                array('confirm' => 'Desea Responder o Asingar No Conformidad?'));     
}
?>


<?php 

if(Yii::app()->user->checkAccess('Administrador')&& $model->ticket_status!="Cerrado"){
  echo CHtml::link('<div  class="messageButton white">
	    	<img src='.'"'. Yii::app()->theme->baseUrl.'/img/big_icons/icon-bandaid.png" alt="añadir medida correctiva"  width="15%" />
	    	<div class=""><h4>Medida Correctiva</h4></div>
		</div>', 
		array('ticket/remedyTicket', 'id'=>$model->id_ticket),
                array('confirm' => 'Desea Añadir medidas correctivas a la No Conformidad?'));     
}
?>

<?php 

if(Yii::app()->user->checkAccess('Cliente')&& $model->ticket_status!="Cerrado"){
  echo CHtml::link('<div  class="messageButton white">
	    	<img src='.'"'. Yii::app()->theme->baseUrl.'/img/big_icons/icon-closeticket.png" alt="Cerrar Solicitud de no conformidad"  width="15%" />
	    	<div class="" ><h4> Aprobar y/o Cerrar No Conformidad</h4></div>
		</div>', 
		array('ticket/closeTicket', 'id'=>$model->id_ticket),
                array('confirm' => 'Desea Cerrar la No Conformidad?'));     
}
?>

<?php 

if(Yii::app()->user->checkAccess('Cliente')&& $model->ticket_status!="Cerrado"){
  echo CHtml::link('<div  class="messageButton white">
	    	<img src='.'"'. Yii::app()->theme->baseUrl.'/img/big_icons/icon-chat4.png" alt="Mensaje medida Correctiva"  width="15%" />
	    	<div class=""><h4>Comentario a la medida correctiva</h4></div>
		</div>', 
		array('ticket/messageClient', 'id'=>$model->id_ticket),
                array('confirm' => 'Desea añadir algun Comentario a la medida correctiva??'));     
}
?> 
    </div>

<br>


