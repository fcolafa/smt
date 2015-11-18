<?php
/* @var $this TicketController */
/* @var $model Ticket */
$this->breadcrumbs=array(
	Yii::t('database','Tickets')=>array('admin'),
	$model->id_ticket,
);
$this->menu=array(
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Ticket'), 'url'=>array('create'),'visible'=>!Yii::app()->user->checkAccess('Administrador')),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Ticket'), 'url'=>array('admin')),
);
$days=" ";
if($model->ticket_status!='Cerrado'){
    $days=" (".$model->getDaysPassed()." Día(s) transcurrido desde la emisión)";
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
            'name'=>'ticket_file',
            'type'=>'raw',
            'value'=> CHtml::link(CHtml::encode($model->ticket_file), Yii::app()->baseUrl . '/images/tickets/' . $model->ticket_file),
           
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
            'name'=>'ticket_solution_file',
            'type'=>'raw',
            'value'=> CHtml::link(CHtml::encode($model->ticket_solution_file), Yii::app()->baseUrl . '/images/tickets_solution/' . $model->ticket_solution_file),
           
            ),
           
                
		
	),
)); ?>
<br>
<?php if(Yii::app()->user->checkAccess('Administrador')){
$criteria=new CDbCriteria();
$criteria->condition='id_ticket='.$model->id_ticket;
$message= TicketMessage::model()->findAll($criteria);
    foreach($message as  $m){
        $user=Users::model()->findByPK($m->id_user);
        $link="";
        $asigned=$user->user_names." ".$user->user_lastnames;
        if($m->idUser->role=="Administrador"){
        $role="(Administrador)";
        $class="triangle-isosceles left";
        }
        if(!empty($m->ticket_message_file)){
             $file=$m->ticket_message_file;
            $folder=Yii::getPathOfAlias('webroot').'/images/tickets_message/'; 
            $link=' <a href="'.$folder.'" download="'.$file.'">Archivo Adjunto</a></p></div>';
            $link=CHtml::link(CHtml::encode("archivo adjunto"), Yii::app()->baseUrl.'/images/tickets_message/'. $m->ticket_message_file,array('target'=>'_blank'));
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

   if(Yii::app()->user->checkAccess('Administrador')&& $model->ticket_status!="Cerrado"):
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
   
 endif;
 
 ?>
<br>
<?php 

if(!Yii::app()->user->checkAccess('Administrador')&& $model->ticket_status!="Cerrado"){
  echo CHtml::link('<div align="center" style="width:20%;">
	    	<img src='.'"'. Yii::app()->theme->baseUrl.'/img/big_icons/icon-closeticket.png" alt="Cerrar Solicitud de no conformidad"  width="15%" />
	    	<div class="dashIconText"><h4>Cerrar Ticket</h4></div>
		</div>', 
		array('ticket/closeTicket', 'id'=>$model->id_ticket),
                array('confirm' => 'Desea Cerrar la solicitud?'));    
  
}

?>
<br>
