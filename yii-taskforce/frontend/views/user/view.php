<?php

use frontend\controllers\TrueForm;
use yii\helpers\Url;

/* @var $user frontend\controllers\UserController */
$trueForm = new TrueForm();
$this->title = $user->name;
?>
<main class="page-main">
    <div class="main-container page-container">
        <section class="content-view">
            <div class="user__card-wrapper">
                <div class="user__card">
                    <img src="..\img\man-hat.png" width="120" height="120" alt="Аватар пользователя">
                    <div class="content-view__headline">
                        <h1><?php echo $user->name; ?></h1>
                        <p>Россия, Санкт-Петербург, 30 лет</p>
                        <div class="profile-mini__name five-stars__rate">
                            <span <?php echo ($user->getRating() < 1) ? 'class="star-disabled"' : ""; ?>></span>
                            <span <?php echo ($user->getRating() < 2) ? 'class="star-disabled"' : ""; ?>></span>
                            <span <?php echo ($user->getRating() < 3) ? 'class="star-disabled"' : ""; ?>></span>
                            <span <?php echo ($user->getRating() < 4) ? 'class="star-disabled"' : ""; ?>></span>
                            <span <?php echo ($user->getRating() < 5) ? 'class="star-disabled"' : ""; ?>></span>
                            <b><?php echo $user->getRating(); ?></b>
                        </div>
                        <b class="done-task">Выполнил <?php echo $user->complete_task; ?> <?php echo $trueForm->getTrueForm($user->complete_task, 'заказ', 'заказа', 'заказов'); ?></b>
                        <b class="done-review">Получил <?php echo count($user->reviews); ?> <?php echo $trueForm->getTrueForm(count($user->reviews), 'отзыв', 'отзыва', 'отзывов'); ?></b>
                    </div>
                    <div class="content-view__headline user__card-bookmark user__card-bookmark--current">
                        <span>Был на сайте 25 минут назад</span>
                        <a href="#"><b></b></a>
                    </div>
                </div>
                <div class="content-view__description">
                    <p><?php echo $user->about; ?></p>
                </div>
                <div class="user__card-general-information">
                    <div class="user__card-info">
                        <?php if ($user->categories): ?>
                            <h3 class="content-view__h3">Специализации</h3>
                        <?php endif ?>
                        <div class="link-specialization">
                            <?php foreach ($user->categories as $value): ?>
                                <a href="#" class="link-regular"><?php echo $value->name; ?></a>
                            <?php endforeach ?>
                        </div>
                        <h3 class="content-view__h3">Контакты</h3>
                        <div class="user__card-link">
                            <a class="user__card-link--tel link-regular" href="#"><?php echo $user->phone; ?></a>
                            <a class="user__card-link--email link-regular" href="#"><?php echo $user->email; ?></a>
                            <a class="user__card-link--skype link-regular" href="#"><?php echo $user->skype; ?></a>
                        </div>
                    </div>
                    <div class="user__card-photo">
                        <h3 class="content-view__h3">Фото работ</h3>
                        <a href="#"><img src="..\img\rome-photo.jpg" width="85" height="86" alt="Фото работы"></a>
                        <a href="#"><img src="..\img\smartphone-photo.png" width="85" height="86" alt="Фото работы"></a>
                        <a href="#"><img src="..\img\dotonbori-photo.png" width="85" height="86" alt="Фото работы"></a>
                    </div>
                </div>
            </div>
            <div class="content-view__feedback">
                <h2>Отзывы <span>(<?php echo count($user->reviews); ?>)</span></h2>
                <div class="content-view__feedback-wrapper reviews-wrapper">
                    <?php foreach ($user->reviews as $review): ?>
                        <div class="feedback-card__reviews">
                            <p class="link-task link">Задание <a href="<?php echo Url::to(['task/view', 'id' => $review->task->id]); ?>" class="link-regular">«<?php echo $review->task->title; ?>»</a></p>
                            <div class="card__review">
                                <a href="<?php echo Url::to(['user/view', 'id' => $review->user->id]); ?>"><img src="..\img\man-glasses.jpg" width="55" height="54" alt="<?php echo $review->user->name; ?>"></a>
                                <div class="feedback-card__reviews-content">
                                    <p class="link-name link"><a href="<?php echo Url::to(['user/view', 'id' => $review->user->id]); ?>" class="link-regular"><?php echo $review->user->name; ?></a></p>
                                    <p class="review-text"><?php echo $review->review; ?></p>
                                </div>
                                <div class="card__review-rate">
                                    <p class="five-rate big-rate"><?php echo $review->rating; ?><span></span></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </section>
        <section class="connect-desk">
            <div class="connect-desk__chat">

            </div>
        </section>
    </div>
</main>
