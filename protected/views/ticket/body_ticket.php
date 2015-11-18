


<h1> <?php echo "No Conformidad Emitida" ;?></h1>
<p>
    Se ha generado una nueva No Conformidad que requiere su atención.  <?php echo CHtml::link("Haga clic  Aqui ",$_SERVER["SERVER_NAME"]."/ticket/view?id=".$model->id_ticket);  ?> para revisar
</p>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                'id_ticket',
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
                'value'=>$model->idUser->user_names.' '.$model->idUser->user_lastnames,          
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
            'ticket_subject',
            'idClassification.classification_name',
            'ticket_description',
            'ticket_status',	
	),
)); ?>

        

<?php //CHtml::link("http://".$_SERVER["SERVER_NAME"].Yii::app()->controller->renderPartial('render', array(),true), array("presupuesto/view&id=".$data->ID_PRESUPUESTO)));?>

