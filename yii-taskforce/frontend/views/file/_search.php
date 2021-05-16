<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="file-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'users_id') ?>

    <?php echo $form->field($model, 'file_1') ?>

    <?php echo $form->field($model, 'file_2') ?>

    <?php echo $form->field($model, 'file_3') ?>

    <?php // echo $form->field($model, 'file_4') ?>

    <?php // echo $form->field($model, 'file_5') ?>

    <?php // echo $form->field($model, 'file_6') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
