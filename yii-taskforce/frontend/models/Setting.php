<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "setting".
 *
 * @property int $id
 * @property int $users_id
 * @property string $setting
 *
 * @property User $users
 */
class Setting extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName():string
    {
        return 'setting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules():array
    {
        return [
            [['users_id', 'setting'], 'required'],
            [['users_id'], 'integer'],
            [['setting'], 'string'],
            [['users_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['users_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels():array
    {
        return [
            'id' => 'ID',
            'users_id' => 'Users ID',
            'setting' => 'Setting',
        ];
    }

    /**
     * Gets query for [[Users]].
     *
     * @return ActiveQuery
     */
    public function getUsers():object
    {
        return $this->hasOne(User::class, ['id' => 'users_id']);
    }
}
