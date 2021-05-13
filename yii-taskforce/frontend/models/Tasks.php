<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $date_create
 * @property string $title
 * @property string $description
 * @property string $img
 * @property int $price
 * @property string|null $date_end
 * @property int $user_id
 * @property int $idPerformer
 * @property int $category_id
 * @property string $address
 * @property float $lat
 * @property float $lng
 * @property string $status_id
 *
 * @property Reviews[] $reviews
 * @property Users $user
 * @property Categories $category
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_create', 'title', 'description', 'img', 'price', 'user_id', 'idPerformer', 'category_id', 'address', 'lat', 'lng', 'status_id'], 'required'],
            [['date_create', 'date_end'], 'safe'],
            [['description'], 'string'],
            [['price', 'user_id', 'idPerformer', 'category_id'], 'integer'],
            [['lat', 'lng'], 'number'],
            [['title'], 'string', 'max' => 50],
            [['img'], 'string', 'max' => 250],
            [['address'], 'string', 'max' => 100],
            [['status_id'], 'string', 'max' => 20],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_create' => 'Date Create',
            'title' => 'Title',
            'description' => 'Description',
            'img' => 'Img',
            'price' => 'Price',
            'date_end' => 'Date End',
            'user_id' => 'User ID',
            'idPerformer' => 'Id Performer',
            'category_id' => 'Category ID',
            'address' => 'Address',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'status_id' => 'Status ID',
        ];
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Reviews::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }
}
