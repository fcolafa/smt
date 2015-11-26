<h1> <?php echo "Solución No Conformidad Emitida, " ;?>Numero de Solicitud: <?php echo $model->id_ticket?></h1>
<p>
    Se ha dado solución a la siguiente No Conformidad.  <?php echo CHtml::link("Haga clic aqui ",$_SERVER["SERVER_NAME"]."/ticket/view?id=".$model->id_ticket);  ?> para revisar.
</p>
        

<?php //CHtml::link("http://".$_SERVER["SERVER_NAME"].Yii::app()->controller->renderPartial('render', array(),true), array("presupuesto/view&id=".$data->ID_PRESUPUESTO)));?>

