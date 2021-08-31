<?php

namespace frontend\models;

use Yii;
use yii\base\InvalidConfigException;
use \yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 *
 * @property Task[] $tasks
 * @property User[] $users
 */
class Category extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName():string
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules():array
    {
        return [
            [['name', 'code'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['code'], 'string', 'max' => 10],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels():array
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
        ];
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return ActiveQuery
     */
    public function getTasks():ActiveQuery
    {
        return $this->hasMany(Task::class, ['category_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getUsers():ActiveQuery
    {
        return $this->hasMany(User::class, ['id' => 'user_id'])
            ->viaTable('user_category', ['category_id' => 'id']);
    }
}
