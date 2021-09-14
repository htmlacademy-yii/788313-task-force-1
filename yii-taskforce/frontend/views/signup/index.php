<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Регистрация';

/* @var $city frontend\controllers\SignupController */
/* @var $signupForm frontend\controllers\SignupController */
?>

<main class="page-main">
    <div class="main-container page-container">
        <section class="registration__user">
            <h1>Регистрация аккаунта</h1>
            <div class="registration-wrapper">
                <?php $form = ActiveForm::begin([
                    'id' => 'TaskForm',
                    'options' => ['class' => 'registration__user-form form-create'],
                    'errorCssClass' => 'has-error',
                    'fieldConfig' => [
                        'options' => ['class' => 'field-container field-container--registration'],
                        'inputOptions' => ['class' => 'input textarea'],
                        'errorOptions' => ['tag' => 'span', 'class' => 'registration__text-error']
                    ]
                    ]); ?>
                    <?php echo $form->field($signupForm, 'email'); ?>
                    <?php echo $form->field($signupForm, 'name'); ?>
                    <?php echo $form->field($signupForm, 'city')->dropdownList($city); ?>
                    <?php echo $form->field($signupForm, 'password')->passwordInput(); ?>
                    <?php echo Html::submitButton('Cоздать аккаунт', ['class' => 'button button__registration']) ?>
                <?php $form = ActiveForm::end();?>
            </div>
        </section>
    </div>
</main>
