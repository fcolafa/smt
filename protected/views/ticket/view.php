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
                  
                'name'=>'ticket_solution',
                'value'=>$model->ticket_solution,
                'visible'=>!empty($model->ticket_solution),
            ),
            
                 array(
            'name'=>'Archivos Adjuntos Soluci&oacute;n',
            'type'=>'raw',
            'value'=>$model->getSolutionFile(),
           // 'value'=> //CHtml::link(CHtml::encode($model->ticket_file), Yii::app()->baseUrl . '/images/tickets/' . $model->ticket_file),
           
            ),
              array(
                  
                'name'=>'ticket_close_date',
                //'value'=>'date("d M Y",strtotime($data["work_date"]))'
                'value'=>Yii::app()->dateFormatter->format("d MMMM y | HH:mm:ss",strtotime($model->ticket_close_date)),
                  'visible'=>!empty($model->ticket_close_date)
            ),
        
           
                
		
	),
)); ?>
<br>
<?php if(Yii::app()->user->checkAccess('Administrador')||Yii::app()->user->checkAccess('Mantención')){
$criteria=new CDbCriteria();
$criteria->condition='id_ticket='.$model->id_ticket;
$message= TicketMessage::model()->findAll($criteria);
    foreach($message as  $m){
        $user=Users::model()->findByPK($m->id_user);
        $link="";
        $asigned=$user->user_names." ".$user->user_lastnames;
        $role="(".$m->idUser->role.")";
        $class="triangle-isosceles left";
        
        $cri=new CDbCriteria();
        $cri->condition='id_ticket_message='.$m->id_ticket_message;
        $messagefiles= TicketMessageFile::model()->findAll($cri);
   
            $folder=Yii::getPathOfAlias('webroot').'/images/tickets_message/'; 
        if($messagefiles){
            foreach($messagefiles as $mf){
         
            $link.=CHtml::link(CHtml::encode($mf->ticket_message_file_name), Yii::app()->baseUrl.'/images/tickets_message/'.$mf->id_ticket_message."/". $mf->ticket_message_file_name,array('target'=>'_blank'));
            $link.="<br>";
            }

        }
        if(!empty($m->id_user_asigned)){
            $asigneduser=Users::model()->findByPK($m->id_user_asigned);
            $asigned="De ".$user->user_names." ".$user->user_lastnames ." para ". $asigneduser->user_names." ".$asigneduser->user_lastnames;
        }
        echo  '<div class="'.$class.'">'.$m->ticket_message.'</p>'.
              '<p class="datep">'.$asigned ."<br>".
               Yii::app()->dateFormatter->format("d MMMM y  HH:mm:ss",strtotime($m->ticket_message_date))."<br>".
                $link."</div>";
               
        echo "<br>";
       
    } 
}

   if((Yii::app()->user->checkAccess('Administrador')||Yii::app()->user->checkAccess('Mantención'))&& $model->ticket_status!="Cerrado"):
    $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
      'id'=>'dialog-animation',
      'options'=>array(
          'title'=>Yii::t('actions','Responder'),
          'autoOpen'=>$ticketm->haserrors(),
           'width'=> '60%',
          
          'show'=>array(
                  'effect'=>'blind',
                  'duration'=>1000,
              ),
          'hide'=>array(
                  'effect'=>'explode',
                  'duration'=>500,
              ),  
      ),
          'htmlOptions'=>array(
                  'class'=>'shadowdialog'
              ),
      ));
 echo $this->renderPartial('_form_message',array(
     'ticketm'=>$ticketm,
 ));
$this->endWidget('zii.widgets.jui.CJuiDialog');


 echo CHtml::button(Yii::t('actions','Responder'), array(
                       'class'=>'button grey',
                       'onclick'=>'$("#dialog-animation").dialog("open"); return false;',
                    ));
   if(empty($model->ticket_solution)){
    $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
      'id'=>'dialog-solution',
      'options'=>array(
          'title'=>Yii::t('actions','Solución'),
          'autoOpen'=>$model->haserrors(),
           'width'=> '60%',
          
          'show'=>array(
                  'effect'=>'blind',
                  'duration'=>1000,
              ),
          'hide'=>array(
                  'effect'=>'explode',
                  'duration'=>500,
              ),  
      ),
          'htmlOptions'=>array(
                  'class'=>'shadowdialog'
              ),
      ));
 echo $this->renderPartial('_form_solution',array(
     'model'=>$model,
 ));
$this->endWidget('zii.widgets.jui.CJuiDialog');

 echo CHtml::button(Yii::t('actions','Solución'), array(
                       'class'=>'button grey',
                       'onclick'=>'$("#dialog-solution").dialog("open"); return false;'
                    ));
   }
 endif;
 
 ?>
<br>
<?php 

if(Yii::app()->user->checkAccess('Cliente')&& $model->ticket_status!="Cerrado"){
  echo CHtml::link('<div align="center" style="width:20%;">
	    	<img src='.'"'. Yii::app()->theme->baseUrl.'/img/big_icons/icon-closeticket.png" alt="Cerrar Solicitud de no conformidad"  width="15%" />
	    	<div class="dashIconText"><h4>Cerrar Ticket</h4></div>
		</div>', 
		array('ticket/closeTicket', 'id'=>$model->id_ticket),
                array('confirm' => 'Desea Cerrar la solicitud?'));    
  
}

?>
<br>
