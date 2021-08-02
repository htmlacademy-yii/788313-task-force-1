<?php


namespace frontend\controllers;


use Yii;
use yii\debug\models\search\Debug;
use yii\web\Controller;
use \yii\db\ActiveRecord;
use frontend\models\Task;
use frontend\models\TasksForm;
use frontend\models\Category;

class TasksController extends Controller
{
    public function actionIndex(): string
    {

        $tasksForm = new TasksForm;
        $tasksForm->load(Yii::$app->request->post());

        $tasks = Task::find()
            ->where (['idPerformer' => 0])
            ->filterWhere([
                'and',
                ['category_id' => $tasksForm['category_ids']],
                ['>=', 'date_create', $tasksForm['period'] ? date_format(date_modify(date_create(date('Y-m-d H:i:s')),'-1 '. $tasksForm['period']),'Y-m-d') : ''],
                ['like', 'title', $tasksForm['search']]
            ])
            ->orderBy('date_create DESC')
            ->all();

        $categories = Category::find()
            ->all();


        return $this->render('index', [
            'tasks' => $tasks,
            'tasksForm' => $tasksForm,
            'categories' => $categories
        ]);
    }

}
