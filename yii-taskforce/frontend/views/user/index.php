<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php echo GridView::widget([
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
