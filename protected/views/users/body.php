


<h1> <?php echo "Cuenta de Usuario Creada" ;?></h1>
<table>
    <thead></thead>
    <tbody>
        <tr><td>Nombre de Usuario</td>  <td><?php echo $model->user_name?></td> </tr>
        <tr><td>Nombre Completo</td><td><?php echo $model->user_names." ".$model->user_lastnames ?></td></tr>
        <tr><td>Rut</td>   <td><?php echo $model->user_rut?></td></tr>
        <tr><td>Email</td><td><?php echo $model->email ?></td></tr>
        <tr><td>Contraseña</td>  <td><?php echo $pass ?></td></tr>
        <tr><td>Fecha de Creacion</td>  <td><?php echo $model->date_create ?></td></tr>
    </tbody>
        
</table>

        <?php echo CHtml::link("Enlace al sistema ",$_SERVER["SERVER_NAME"]."/site/index");  ?>

<?php //CHtml::link("http://".$_SERVER["SERVER_NAME"].Yii::app()->controller->renderPartial('render', array(),true), array("presupuesto/view&id=".$data->ID_PRESUPUESTO)));?>

