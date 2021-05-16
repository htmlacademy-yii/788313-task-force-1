<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "file".
 *
 * @property int $id
 * @property int $users_id
 * @property string|null $file_1
 * @property string|null $file_2
 * @property string|null $file_3
 * @property string|null $file_4
 * @property string|null $file_5
 * @property string|null $file_6
 *
 * @property User $users
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName():string
    {
        return 'file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules():array
    {
        return [
            [['users_id'], 'required'],
            [['users_id'], 'integer'],
            [['file_1', 'file_2', 'file_3', 'file_4', 'file_5', 'file_6'], 'string', 'max' => 250],
            [['users_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class(), 'targetAttribute' => ['users_id' => 'id']],
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
            'file_1' => 'File 1',
            'file_2' => 'File 2',
            'file_3' => 'File 3',
            'file_4' => 'File 4',
            'file_5' => 'File 5',
            'file_6' => 'File 6',
        ];
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers():object
    {
        return $this->hasOne(User::class(), ['id' => 'users_id']);
    }
}
