<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $loginForm frontend\controllers\LoginController */

?>
<section class="modal enter-form form-modal" id="enter-form">
    <h2>Вход на сайт</h2>
    <?php $form = ActiveForm::begin([
        'id' => 'enter-form',
        'enableClientScript' => false,
        /*'enableAjaxValidation'   => false,
        'enableClientValidation' => false,
        'validateOnBlur'         => false,
        'validateOnType'         => false,
        'validateOnChange'       => false,
        'validateOnSubmit'       => false,*/
        'options' => [],
        'fieldConfig' => [
            'labelOptions' => ['class' => 'form-modal-description'],
            'inputOptions' => ['class' => 'enter-form-email input input-middle'],
            'options' => ['tag' => false]
        ]
    ]); ?>
    <?php echo $form->field($loginForm, 'email',['template' => '<p>{label}{input}{error}</p>']); ?>
    <?php echo $form->field($loginForm, 'password',['template' => '<p>{label}{input}{error}</p>'])->passwordInput(); ?>
    <?php echo Html::submitButton('Войти', ['class' => 'button']); ?>
    <?php $form = ActiveForm::end();?>
    <button class="form-modal-close" type="button">Закрыть</button>
</section>
