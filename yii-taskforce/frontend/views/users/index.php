<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Users', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'category_id',
            'date_reg',
            'name',
            'status',
            //'email:email',
            //'phone',
            //'skype',
            //'telegram',
            //'img',
            //'birthday',
            //'address',
            //'city_id',
            //'about',
            //'rating',
            //'failed_task',
            //'complete_task',
            //'password_hash',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
