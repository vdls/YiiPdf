<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Register',
);


?>

<h1>Registration Details</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>