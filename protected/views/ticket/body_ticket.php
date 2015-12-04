


<h1> <?php echo "No Conformidad Emitida" ;?></h1>
<p>
    Se ha generado una nueva No Conformidad que requiere su atención.  <?php echo CHtml::link("Haga clic aqui ",$_SERVER["SERVER_NAME"]."/ticket/view?id=".$model->id_ticket);  ?> para revisar
</p>

<?php //CHtml::link("http://".$_SERVER["SERVER_NAME"].Yii::app()->controller->renderPartial('render', array(),true), array("presupuesto/view&id=".$data->ID_PRESUPUESTO)));?>

