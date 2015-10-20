


<h1> <?php echo "Cuenta de Usuario Creada" ;?></h1>
<table>
    <thead></thead>
    <tbody>
        <tr>
            <td>Nombre de Usuario</td>
            <td>Nombre Completo</td>
            <td>Rut</td>
            <td>Email</td>
            <td>Contraseña</td>
            <td>Fecha de Creacion</td>
        </tr>
         <tr>
            <td><?php echo $model->user_name?></td>
            <td><?php echo $model->user_names." ".$model->user_lastnames ?></td>
            <td><?php echo $model->user_rut?></td>
            <td><?php echo $model->email ?></td>
            <td><?php echo $pass ?></td>
            <td><?php echo $model->date_create ?></td>
        </tr>
    </tbody>
        
</table>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_user',
		'user_name',
		  array(
                'name'=>'date_create',
                //'value'=>'date("d M Y",strtotime($data["work_date"]))'
                'value'=>Yii::app()->dateFormatter->format("d MMMM y | HH:mm:ss",strtotime($model->date_create))
                ),
		'email',
                array(
                  'name'=>'Nombre Completo',
                  'value'=> $model->user_names ." ".$model->user_lastnames,
                ),
                'user_rut',
                'idCompany.company_name',
                'role',
	),
)); ?>
<?php //CHtml::link("http://".$_SERVER["SERVER_NAME"].Yii::app()->controller->renderPartial('render', array(),true), array("presupuesto/view&id=".$data->ID_PRESUPUESTO)));?>

