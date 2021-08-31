<?php

use yii\helpers\Url;
use yii\helpers\Html;
use \yii\i18n\Formatter;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use \yii\widgets\Pjax;
use frontend\controllers\TrueForm;

/* @var $task frontend\controllers\TaskController */

$this->title = $task->title;
$trueForm = new TrueForm();
$responses = $task->responses;
?>

<main class="page-main">
    <div class="main-container page-container">
        <section class="content-view">
            <div class="content-view__card">
                <div class="content-view__card-wrapper">
                    <div class="content-view__header">
                        <div class="content-view__headline">
                            <h1><?php echo $task->title; ?></h1>
                            <span>Размещено в категории
                                    <a href="#" class="link-regular"><?php echo $task->category->name; ?></a>
                                    25 минут назад
                            </span>
                        </div>
                        <b class="new-task__price new-task__price--<?php echo $task->category->code; ?> content-view-price"><?php echo $task->price; ?><b> ₽</b></b>
                        <div class="new-task__icon new-task__icon--<?php echo $task->category->code; ?> content-view-icon"></div>
                    </div>
                    <div class="content-view__description">
                        <h3 class="content-view__h3">Общее описание</h3>
                        <p>
                            <?php echo $task->description; ?>
                        </p>
                    </div>
                    <div class="content-view__attach">
                        <h3 class="content-view__h3">Вложения</h3>
                        <a href="#">my_picture.jpeg</a>
                        <a href="#">agreement.docx</a>
                    </div>
                    <div class="content-view__location">
                        <h3 class="content-view__h3">Расположение</h3>
                        <div class="content-view__location-wrapper">
                            <div class="content-view__map">
                                <a href="#"><img src="..\img\map.jpg" width="361" height="292"
                                                 alt="Москва, Новый арбат, 23 к. 1"></a>
                            </div>
                            <div class="content-view__address">
                                <span class="address__town">Москва</span><br>
                                <span>Новый арбат, 23 к. 1</span>
                                <p>Вход под арку, код домофона 1122</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-view__action-buttons">
                    <button class=" button button__big-color response-button open-modal"
                            type="button" data-for="response-form">Откликнуться
                    </button>
                    <button class="button button__big-color refusal-button open-modal"
                            type="button" data-for="refuse-form">Отказаться
                    </button>
                    <button class="button button__big-color request-button open-modal"
                            type="button" data-for="complete-form">Завершить
                    </button>
                </div>
            </div>
            <div class="content-view__feedback">
                <h2>Отклики <span>(<?php echo count($task->responses); ?>)</span></h2>
                <?php foreach ($responses as $responce): ?>
                <div class="content-view__feedback-wrapper">

                    <div class="content-view__feedback-card">
                        <div class="feedback-card__top">
                            <a href="user.html"><img src="..\img\man-glasses.jpg" width="55" height="55" alt="<?php echo $responce->user->name; ?>"></a>
                            <div class="feedback-card__top--name">
                                <p><a href="user.html" class="link-regular"><?php echo $responce->user->name; ?></a></p>
                                <span <?php echo ($responce->user->getRating() < 1) ? 'class="star-disabled"' : ""; ?>></span>
                                <span <?php echo ($responce->user->getRating() < 2) ? 'class="star-disabled"' : ""; ?>></span>
                                <span <?php echo ($responce->user->getRating() < 3) ? 'class="star-disabled"' : ""; ?>></span>
                                <span <?php echo ($responce->user->getRating() < 4) ? 'class="star-disabled"' : ""; ?>></span>
                                <span <?php echo ($responce->user->getRating() < 5) ? 'class="star-disabled"' : ""; ?>></span>
                                <b><?php echo $responce->user->getRating(); ?></b>
                            </div>
                            <span class="new-task__time">25 минут назад</span>
                        </div>
                        <div class="feedback-card__content">
                            <p><?php echo $responce->review; ?></p>
                            <span><?php echo $responce->price; ?> ₽</span>
                        </div>
                        <div class="feedback-card__actions">
                            <a class="button__small-color response-button button"
                               type="button">Подтвердить</a>
                            <a class="button__small-color refusal-button button"
                               type="button">Отказать</a>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>

        </section>
        <section class="connect-desk">
            <div class="connect-desk__profile-mini">
                <div class="profile-mini__wrapper">
                    <h3>Заказчик</h3>
                    <div class="profile-mini__top">
                        <img src="..\img\man-glasses.jpg" width="62" height="62" alt="Аватар заказчика">
                        <div class="profile-mini__name five-stars__rate">
                            <p><?php echo $task->user->name; ?></p>
                        </div>
                    </div>
                    <p class="info-customer"><span><?php echo $task->user->complete_task; ?>
                            <?php echo $trueForm->getTrueForm($task->user->complete_task, 'задание', 'задания', 'заданий') ?></span><span class="last-">2 года на сайте</span></p>
                    <a href="<?php echo Url::to(['user/view', 'id' => $task->user->id]); ?>" class="link-regular">Смотреть профиль</a>
                </div>
            </div>
            <div id="chat-container">
                <!--                    добавьте сюда атрибут task с указанием в нем id текущего задания-->
                <chat class="connect-desk__chat"></chat>
            </div>
        </section>
    </div>
</main>
