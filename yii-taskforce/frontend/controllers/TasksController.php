<?php


namespace frontend\controllers;


use yii\web\Controller;
use \yii\db\ActiveRecord;
use frontend\models\Task;

class TasksController extends Controller
{
    public array $tasks;
    public function actionIndex():string
    {
        $tasks = Task::find()
            ->where (['idPerformer' => 0])
            ->orderBy('date_create DESC')
            ->all();

        return $this->render('index', [
            'tasks' => $tasks
        ]);
    }

}
