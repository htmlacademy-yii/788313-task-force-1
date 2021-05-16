<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Задания';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date_create',
            'title',
            'description:ntext',
            'img',
            //'price',
            //'date_end',
            //'user_id',
            //'idPerformer',
            //'category_id',
            //'address',
            //'lat',
            //'lng',
            //'status_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
