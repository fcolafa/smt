<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs=array(
	Yii::t('database','Tickets')=>array('index'),
	$model->id_ticket,
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','Ticket'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Ticket'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Ticket'), 'url'=>array('admin')),
);
?>

<h1> Detalle <?php echo Yii::t('database','Ticket')?> N°<?php echo $model->id_ticket; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idEmbarkation.embarkation_name',
            array(
              'name'=>'Cliente',
                'value'=>$model->idUser->idCompany->company_name,
            ),
             array(
              'name'=>'Nombre de Usuario',
                'value'=>$model->idUser->user_name,
            ),
              array(
              'name'=>'Centro',
              'value'=>$model->idHeadquarter->headquarter_name,
            ),
              array(
                'name'=>'Nombre de pila',
                'value'=>CHtml::link(
                        ' '.$model->idUser->user_names.' '.
                        ' '.$model->idUser->user_lastnames
                        ,array('users/viewClient','id'=>$model->id_user)),
                'type'=>'raw',
                  'visible'=>Yii::app()->user->checkAccess('Cliente')
                  
            ),
              array(
                'name'=>'Nombre de pila',
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
	
		'ticket_description',
		'ticket_status',
	),
)); ?>

<?php 
$criteria=new CDbCriteria();
$criteria->condition='id_ticket='.$model->id_ticket;
$message= TicketMessage::model()->findAll($criteria);
echo '<div class="append-1">';
    foreach($message as  $m){
        $user=Users::model()->findByPK($m->id_user);
        if($m->idUser->role=="Administrador"){
        $role="(Administrador)";
        $class="triangle-isosceles left";
        }else
            {
        $role=" ";
        $class="triangle-isosceles right";
        }
        echo  '<div class="'.$class.'">'.$m->ticket_message.'</p>'.
              '<p class="datep">'.$user->user_names." ".$user->user_lastnames .$role ."<br>".
               Yii::app()->dateFormatter->format("d MMMM y  HH:mm:ss",strtotime($m->ticket_message_date)).'<p><p></div>';
        echo "<br>";
       
    } 

   echo "</div>";
    ?>
 <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
      'id'=>'dialog-animation',
      'options'=>array(
          'title'=>Yii::t('actions','Responder'),
          'autoOpen'=>false,
           'width'=> '50%',
          
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
                    ));?>

