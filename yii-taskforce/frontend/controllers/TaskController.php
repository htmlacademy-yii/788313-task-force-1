<?php


namespace frontend\controllers;


use Yii;
use yii\web\Controller;
use \yii\db\ActiveRecord;
use frontend\models\Task;
use frontend\models\TaskForm;
use frontend\models\Category;
use yii\web\NotFoundHttpException;

class TaskController extends Controller
{
    public function actionIndex(): string
    {
        $taskForm = new TaskForm;
        $taskForm->load(Yii::$app->request->post());

        $tasks = Task::find()
            ->where (['idPerformer' => 0])
            ->filterWhere([
                'and',
                ['category_id' => $taskForm->getCategoryId()],
                ['>=', 'date_create', $taskForm->getPeriod()],
                ['like', 'title', $taskForm->getSearch()]
            ])
            ->orderBy('date_create DESC')
            ->all();

        $categories = Category::find()
            ->all();


        return $this->render('index', [
            'tasks' => $tasks,
            'taskForm' => $taskForm,
            'categories' => $categories
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionView($id): string
    {

        $task = Task::find()
            ->where (['id' => $id])
            ->one();

        if (empty($task))
        {
            throw new NotFoundHttpException('Проверьте правильность введенных данных');
        }

        return $this->render('view', [
            'task' => $task
        ]);
    }

}
