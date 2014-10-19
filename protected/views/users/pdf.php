<?php 
$this->pageTitle=Yii::app()->name . ' - Create Resume';
echo '<pre>', var_dump($model), '</pre>' ;
 ?>

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

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'find' : 'Save'); ?>
		
	</div>

	<?php $this->endWidget(); ?>



</div><!-- form -->

<?php 
echo '<pre>', var_dump($model), '</pre>' ;
 ?>