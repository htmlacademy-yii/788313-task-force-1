<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'category_id')->textInput() ?>

    <?php echo $form->field($model, 'date_reg')->textInput() ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'status')->textInput() ?>

    <?php echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'skype')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'telegram')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'birthday')->textInput() ?>

    <?php echo $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'city_id')->textInput() ?>

    <?php echo $form->field($model, 'about')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'rating')->textInput() ?>

    <?php echo $form->field($model, 'failed_task')->textInput() ?>

    <?php echo $form->field($model, 'complete_task')->textInput() ?>

    <?php echo $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?php echo Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
