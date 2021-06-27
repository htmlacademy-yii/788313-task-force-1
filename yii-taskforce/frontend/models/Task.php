<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "task".
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
 * @property Review[] $reviews
 * @property User $user
 * @property Category $category
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName():string
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules():array
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
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels():array
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
     * @return ActiveQuery
     */
    public function getReviews():object
    {
        return $this->hasMany(Review::class, ['task_id' => 'id']);
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
     * Gets query for [[Category]].
     *
     * @return ActiveQuery
     */
    public function getCategory():object
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
}
