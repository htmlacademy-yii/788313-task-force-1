<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $loginForm frontend\controllers\LoginController */
?>
<section class="modal enter-form form-modal" id="enter-form">
    <h2>Вход на сайт</h2>
    <?php $form = ActiveForm::begin([
        'id' => 'enter',
        'options' => [],
        'fieldConfig' => [
            'errorOptions' => ['tag' => 'span'],
            'labelOptions' => ['class' => 'form-modal-description'],
            'inputOptions' => ['class' => 'enter-form-email input input-middle'],
            'options' => ['tag' => false]
        ]
    ]); ?>
    <?php echo $form->field($loginForm, 'email',['template' => '<p>{label}{input}{error}</p>'])->textInput(['id'=>'enter-email', 'type' => 'email']); ?>
    <?php echo $form->field($loginForm, 'password',['template' => '<p>{label}{input}{error}</p>'])->passwordInput(['id'=>'enter-password']); ?>
    <?php echo Html::submitButton('Войти', ['class' => 'button']); ?>
    <?php $form = ActiveForm::end();?>
    <button class="form-modal-close" type="button">Закрыть</button>
</section>
