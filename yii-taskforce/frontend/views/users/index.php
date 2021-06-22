<?php

use frontend\models\Review;
use yii\helpers\Html;
use frontend\controllers\TrueForm;
use frontend\controllers\TimePass;

/* @var $this yii\web\View */
/* @var $users frontend\controllers\UsersController */
/* @var $review frontend\controllers\TrueForm */
/* @var $getTime frontend\controllers\TimePass */

$this->title = 'Исполнители';
$review = new TrueForm();
$getTime = new TimePass();
?>

<main class="page-main">
        <div class="main-container page-container">
            <section class="user__search">
                <?php foreach ($users as $user): ?>
                <div class="content-view__feedback-card user__search-wrapper">
                    <div class="feedback-card__top">
                        <div class="user__search-icon">
                            <a href="#"><img src="img/man-glasses.jpg" width="65" height="65"></a>
                            <span><?php echo $user['complete_task']; ?>
                                <?php echo $review->getTrueForm($user['complete_task'], 'задание', 'задания', 'заданий') ?></span>
                            <span><?php echo count($user->reviews); ?>
                                <?php echo $review->getTrueForm(count($user->reviews), 'отзыв', 'отзыва', 'отзывов') ?></span>
                        </div>
                        <div class="feedback-card__top--name user__search-card">
                            <p class="link-name"><a href="#" class="link-regular"><?php echo $user['name']; ?></a></p>
                            <span <?php echo ($user['rating'] < 1) ? 'class="star-disabled"' : ""; ?>></span>
                            <span <?php echo ($user['rating'] < 2) ? 'class="star-disabled"' : ""; ?>></span>
                            <span <?php echo ($user['rating'] < 3) ? 'class="star-disabled"' : ""; ?>></span>
                            <span <?php echo ($user['rating'] < 4) ? 'class="star-disabled"' : ""; ?>></span>
                            <span <?php echo ($user['rating'] < 5) ? 'class="star-disabled"' : ""; ?>></span>
                            <b><?php echo $user['rating']; ?></b>
                            <p class="user__search-content">
                                <?php echo $user['about']; ?>
                            </p>
                        </div>
                        <span class="new-task__time">Был на сайте 25 минут назад</span>
                    </div>
                    <div class="link-specialization user__search-link--bottom">
                        <?php foreach ($user->categories as $value): ?>
                        <a href="#" class="link-regular"><?php echo $value['name']; ?></a>
                        <?php endforeach ?>
                    </div>
                </div>
                <?php endforeach ?>
            </section>
            <section class="search-task">
                <div class="search-task__wrapper">
                    <form class="search-task__form" name="users" method="post" action="#">
                        <fieldset class="search-task__categories">
                            <legend>Категории</legend>
                            <label class="checkbox__legend">
                                <input class="visually-hidden checkbox__input" type="checkbox" name="" value="" checked disabled>
                                <span>Курьерские услуги</span>
                            </label>
                            <label class="checkbox__legend">
                                <input class="visually-hidden checkbox__input" type="checkbox" name="" value="" checked>
                                <span>Грузоперевозки</span>
                            </label>
                            <label class="checkbox__legend">
                                <input class="visually-hidden checkbox__input" type="checkbox" name="" value="">
                                <span>Переводы</span>
                            </label>
                            <label class="checkbox__legend">
                                <input class="visually-hidden checkbox__input" type="checkbox" name="" value="">
                                <span>Строительство и ремонт</span>
                            </label>
                            <label class="checkbox__legend">
                                <input class="visually-hidden checkbox__input" type="checkbox" name="" value="">
                                <span>Выгул животных</span>
                            </label>
                        </fieldset>
                        <fieldset class="search-task__categories">
                            <legend>Дополнительно</legend>
                            <label class="checkbox__legend">
                                <input class="visually-hidden checkbox__input" type="checkbox" name="" value="">
                                <span>Сейчас свободен</span>
                            </label>
                            <label class="checkbox__legend">
                                <input class="visually-hidden checkbox__input" type="checkbox" name="" value="">
                                <span>Сейчас онлайн</span>
                            </label>
                            <label class="checkbox__legend">
                                <input class="visually-hidden checkbox__input" type="checkbox" name="" value="">
                                <span>Есть отзывы</span>
                            </label>
                            <label class="checkbox__legend">
                                <input class="visually-hidden checkbox__input" type="checkbox" name="" value="">
                                <span>В избранном</span>
                            </label>
                        </fieldset>
                        <label class="search-task__name" for="110">Поиск по имени</label>
                        <input class="input-middle input" id="110" type="search" name="q" placeholder="">
                        <button class="button" type="submit">Искать</button>
                    </form>
                </div>
            </section>
        </div>
    </main>

