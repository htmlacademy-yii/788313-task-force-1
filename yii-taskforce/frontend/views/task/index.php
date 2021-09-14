<?php

use yii\helpers\Html;
use \yii\i18n\Formatter;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use \yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $tasks frontend\controllers\TaskController */
/* @var $taskForm frontend\controllers\TaskController */
/* @var $categories frontend\controllers\TaskController */

$this->title = 'Новые задания';
?>

<main class="page-main">
    <div class="main-container page-container">
        <section class="new-task">
            <div class="new-task__wrapper">
                <h1><?php echo Html::encode($this->title); ?></h1>
                <?php foreach ($tasks as $task): ?>
                <div class="new-task__card">
                    <div class="new-task__title">
                        <a href="<?php echo Url::to(['task/view', 'id' => $task->id]); ?>" class="link-regular"><h2><?php echo $task->title; ?></h2></a>
                        <a  class="new-task__type link-regular" href="#"><p><?php echo $task->category->name; ?></p></a>
                    </div>
                    <div class="new-task__icon new-task__icon--<?php echo $task->category->code; ?>"></div>
                    <p class="new-task_description">
                        <?php echo $task->description; ?>
                    </p>
                    <b class="new-task__price new-task__price--translation"><?php echo $task->price; ?><b> ₽</b></b>
                    <p class="new-task__place"><?php echo $task->address; ?></p>
                    <span class="new-task__time"><?php echo Yii::$app->formatter->asRelativeTime($task->date_create); ?></span>
                </div>
                <?php endforeach ?>
            </div>
            <div class="new-task__pagination">
                <ul class="new-task__pagination-list">
                    <li class="pagination__item"><a href="#"></a></li>
                    <li class="pagination__item pagination__item--current">
                        <a>1</a></li>
                    <li class="pagination__item"><a href="#">2</a></li>
                    <li class="pagination__item"><a href="#">3</a></li>
                    <li class="pagination__item"><a href="#"></a></li>
                </ul>
            </div>
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
                        <?php echo $form->field($taskForm, 'category_id', [
                            'template' => '{input}',
                            'labelOptions' =>['class' => 'checkbox__legend']
                        ])->checkboxList(ArrayHelper::map($categories, 'id', 'name'),
                            ['item' => function ($index, $label, $name, $checked, $value) {
                                $chek = $checked ? 'checked' : '';
                                return '<label class="checkbox__legend">'
                                    . '<input class="visually-hidden checkbox__input" type="checkbox" name="' . $name . '" value="' . $value . '" ' . $chek . '>'
                                    . '<span>'. $label .'</span>'
                                    . '</label>';
                            },
                            ]
                        )?>
                    </fieldset>
                    <fieldset class="search-task__categories">
                        <legend>Дополнительно</legend>
                        <?php echo $form->field($taskForm, 'additionally', ['template' => '{input}'])
                            ->checkboxList(['nonUsers' => 'Без исполнителя', 'offCity' => 'Удаленная работа'],
                            ['item' => function ($index, $label, $name, $checked, $value) {
                                $chek = $checked ? 'checked' : '';
                                return '<div><label class="checkbox__legend">'
                                    . '<input class="visually-hidden checkbox__input" type="checkbox" name="' . $name . '" value="' . $value . '" ' . $chek . '>'
                                    . '<span>'. $label .'</span>'
                                    . '</label></div>';
                            },
                            ]
                            )?>
                    </fieldset>
                    <div class="field-container">
                        <?php echo $form->field($taskForm, 'period', [
                            'labelOptions' =>['class' => 'search-task__name'],
                            'template' => '{label} {input}',
                        ])->
                        dropDownList(['day' => 'За день', 'week' => 'За неделю', 'month' => 'За месяц', '' => 'За всё время'],[
                            'class' => 'multiple-select input',
                            'options' => [$taskForm->period => ['selected' => true]]
                        ])->label('Период') ?>
                    </div>
                    <div class="field-container">
                        <?php echo $form->field($taskForm, 'search', [
                            'labelOptions' =>['class' => 'search-task__name'],
                            'template' => '{label} {input}',
                        ])->textInput(['class' => 'input-middle input'])->label('Поиск по названию');
                        ?>
                    </div>
                    <?php echo Html::submitButton('Искать', ['class' => 'button']) ?>
                <?php $form = ActiveForm::end();?>
            </div>
        </section>
    </div>
</main>
