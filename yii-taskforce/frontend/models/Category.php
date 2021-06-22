<?php

namespace frontend\models;

use Yii;

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
class Category extends \yii\db\ActiveRecord
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
     * @return \yii\db\ActiveQuery
     */
    public function getTasks():object
    {
        return $this->hasMany(Task::class, ['category_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getUsers():object
    {
        return $this->hasMany(User::class, ['id' => 'user_id'])
            ->viaTable('user_category', ['category_id' => 'id']);
    }
}
