<?php

namespace frontend\models;

use Yii;
use \yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property string $name
 * @property float $lat
 * @property float $lng
 *
 * @property User[] $users
 */
class City extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName():string
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules():array
    {
        return [
            [['name', 'lat', 'lng'], 'required'],
            [['lat', 'lng'], 'number'],
            [['name'], 'string', 'max' => 50],
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
            'lat' => 'Lat',
            'lng' => 'Lng',
        ];
    }

    /**
     * Gets query for [[Users]].
     *
     * @return ActiveQuery
     */
    public function getUsers():object
    {
        return $this->hasMany(User::class, ['city_id' => 'id']);
    }
}
