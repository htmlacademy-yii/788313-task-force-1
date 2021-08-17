<?php

use frontend\models\Review;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use frontend\controllers\TrueForm;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $users frontend\controllers\UserController */
/* @var $userForm frontend\controllers\UserController */
/* @var $review frontend\controllers\TrueForm */
/* @var $categories frontend\controllers\UserController */


$this->title = 'Исполнители';
$review = new TrueForm();
?>

<main class="page-main">
        <div class="main-container page-container">
            <section class="user__search">
                <?php foreach ($users as $user): ?>
                <div class="content-view__feedback-card user__search-wrapper">
                    <div class="feedback-card__top">
                        <div class="user__search-icon">
                            <a href="#"><img src="img/man-glasses.jpg" width="65" height="65"></a>
                            <span><?php echo $user->complete_task; ?>
                                <?php echo $review->getTrueForm($user->complete_task, 'задание', 'задания', 'заданий') ?></span>
                            <span><?php echo count($user->review); ?>
                                <?php echo $review->getTrueForm(count($user->review), 'отзыв', 'отзыва', 'отзывов') ?></span>
                        </div>
                        <div class="feedback-card__top--name user__search-card">
                            <p class="link-name"><a href="#" class="link-regular"><?php echo $user->name; ?></a></p>
                            <span <?php echo ($user->rating < 1) ? 'class="star-disabled"' : ""; ?>></span>
                            <span <?php echo ($user->rating < 2) ? 'class="star-disabled"' : ""; ?>></span>
                            <span <?php echo ($user->rating < 3) ? 'class="star-disabled"' : ""; ?>></span>
                            <span <?php echo ($user->rating < 4) ? 'class="star-disabled"' : ""; ?>></span>
                            <span <?php echo ($user->rating < 5) ? 'class="star-disabled"' : ""; ?>></span>
                            <b><?php echo $user->rating; ?></b>
                            <p class="user__search-content">
                                <?php echo $user->about; ?>
                            </p>
                        </div>
                        <span class="new-task__time">Был на сайте 25 минут назад</span>
                    </div>
                    <div class="link-specialization user__search-link--bottom">
                        <?php foreach ($user->category as $value): ?>
                        <a href="#" class="link-regular"><?php echo $value->name; ?></a>
                        <?php endforeach ?>
                    </div>
                </div>
                <?php endforeach ?>
            </section>
            <section class="search-task">
                <div class="search-task__wrapper">
                    <?php $form = ActiveForm::begin([
                        'id' => 'TaskForm',
                        'fieldConfig' => [
                            'options' => [
                                'tag' => false,
                            ],
                        ],
                        'options' => ['class' => 'search-task__form']
                    ]);
                    ?>
                    <fieldset class="search-task__categories">
                        <legend>Категории</legend>
                        <?php echo $form->field($userForm, 'category_id', [
                            'template' => '{input}',
                            'labelOptions' =>['class' => 'checkbox__legend']
                        ])->checkboxList(ArrayHelper::map($categories, 'id', 'name'),
                            ['item' => function ($index, $label, $name, $checked, $value) {
                                $chek = $checked ? 'checked' : "";
                                return '<label class="checkbox__legend">'
                                    . '<input class="visually-hidden checkbox__input" type="checkbox" name="'. $name . '" value="'. $value . '" ' . $chek . '>'
                                    . '<span>'. $label .'</span>'
                                    . '</label>';
                            },
                            ]
                        )?>
                    </fieldset>
                    <fieldset class="search-task__categories">
                        <legend>Дополнительно</legend>
                        <?php echo $form->field($userForm, 'additionally', ['template' => '{input}'])
                            ->checkboxList(['free' => 'Сейчас свободен', 'online' => 'Сейчас онлайн', 'rew' => 'Есть отзывы', 'fav' => 'В избранном'],
                            ['item' => function ($index, $label, $name, $checked, $value) {
                                $chek = $checked ? 'checked' : "";
                                return '<div><label class="checkbox__legend">'
                                    . '<input class="visually-hidden checkbox__input" type="checkbox" name="'. $name . '" value="'. $value . '" ' . $chek . '>'
                                    . '<span>'. $label .'</span>'
                                    . '</label></div>';
                            },
                            ]
                        ); ?>
                    </fieldset>
                    <?php echo $form->field($userForm, 'search', [
                        'labelOptions' =>['class' => 'search-task__name'],
                        'template' => '{label} {input}',
                    ])->textInput(['class' => 'input-middle input'])->label('Поиск по имени');
                    ?>
                    <?php echo Html::submitButton('Искать', ['class' => 'button']) ?>
                    <?php $form = ActiveForm::end();?>
                </div>
            </section>
        </div>
    </main>

