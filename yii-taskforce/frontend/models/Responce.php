<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "responce".
 *
 * @property int $id
 * @property int $user_id
 * @property int $task_id
 * @property string $date_add
 * @property int $price
 * @property string $review
 */
class Responce extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName():string
    {
        return 'responce';
    }

    /**
     * {@inheritdoc}
     */
    public function rules():array
    {
        return [
            [['user_id', 'task_id', 'date_add', 'price', 'review'], 'required'],
            [['user_id', 'task_id', 'price'], 'integer'],
            [['date_add'], 'safe'],
            [['review'], 'string'],
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
            'price' => 'Price',
            'review' => 'Review',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser():ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Task]].
     *
     * @return ActiveQuery
     */
    public function getTask():ActiveQuery
    {
        return $this->hasOne(Task::class, ['id' => 'task_id']);
    }
}
