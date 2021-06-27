<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "review".
 *
 * @property int $id
 * @property int $user_id
 * @property int $task_id
 * @property string $date_add
 * @property int $rating
 * @property string $review
 *
 * @property User $user
 * @property Task $task
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName():string
    {
        return 'review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules():array
    {
        return [
            [['user_id', 'task_id', 'date_add', 'rating', 'review'], 'required'],
            [['user_id', 'task_id', 'rating'], 'integer'],
            [['date_add'], 'safe'],
            [['review'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::class, 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels():array
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'task_id' => 'Task ID',
            'date_add' => 'Date Add',
            'rating' => 'Rating',
            'review' => 'Review',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser():object
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Task]].
     *
     * @return ActiveQuery
     */
    public function getTask():object
    {
        return $this->hasOne(Task::class, ['id' => 'task_id']);
    }
}
