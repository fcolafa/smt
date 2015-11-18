


<h1> <?php echo "No Conformidad Emitida, " ;?>Numero de Solicitud: <?php echo $model->id->ticket?></h1>
<p>
    Se le ha asignado una notificacionn en la siguiente No Conformidad.  <?php echo CHtml::link("Haga clic  Aqui ",$_SERVER["SERVER_NAME"]."/ticket/view?id=".$model->id_ticket);  ?> para revisar
</p>
        

<?php //CHtml::link("http://".$_SERVER["SERVER_NAME"].Yii::app()->controller->renderPartial('render', array(),true), array("presupuesto/view&id=".$data->ID_PRESUPUESTO)));?>

