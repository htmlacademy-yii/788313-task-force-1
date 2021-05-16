<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\File */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="file-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'users_id')->textInput() ?>

    <?php echo $form->field($model, 'file_1')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'file_2')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'file_3')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'file_4')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'file_5')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'file_6')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?php echo Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
