<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
echo '<pre>', var_dump($model), '</pre>' ;
?>

<?php $this->pageTitle=Yii::app()->name . ' - Login'; ?>

<div class="row-fluid">
  <div class="span6 offset6">
    <div id="maincontent" class="span8"> 

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
                'validateOnSubmit'=>false,
        ),

	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Login'); ?>
		
	</div>
	<p>Not a member yet !! <a href="register">Click Here</a> to Register</p>
	<!-- <p><a href="forgot_pass">Forgot Password?</a></p> -->

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>
    <!-- .span --> 
  </div>
  <!-- .row -->
  
</div>
<!-- .container -->