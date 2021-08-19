<?php

namespace frontend\models;

use Yii;
use \yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use \yii\base\InvalidConfigException;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $date_reg
 * @property string $name
 * @property int $status
 * @property string $email
 * @property string $phone
 * @property string $skype
 * @property string $telegram
 * @property string $img
 * @property string $birthday
 * @property string $address
 * @property int $city_id
 * @property string $about
 * @property int $rating
 * @property int $failed_task
 * @property int $complete_task
 * @property string $password_hash
 *
 * @property File[] $files
 * @property Review[] $review
 * @property Setting[] $settings
 * @property Task[] $task
 * @property City $city
 * @property Category[] $Categories
 */
class User extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName():string
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules():array
    {
        return [
            [['date_reg', 'name', 'status', 'email', 'phone', 'skype', 'telegram', 'img', 'birthday', 'address', 'city_id', 'about', 'rating', 'failed_task', 'complete_task', 'password_hash'], 'required'],
            [['date_reg', 'birthday'], 'safe'],
            [['status', 'city_id', 'rating', 'failed_task', 'complete_task'], 'integer'],
            [['name', 'email'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 11],
            [['skype', 'telegram'], 'string', 'max' => 40],
            [['img', 'password_hash'], 'string', 'max' => 250],
            [['address'], 'string', 'max' => 100],
            [['about'], 'string', 'max' => 200],
            [['email'], 'unique'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels():array
    {
        return [
            'id' => 'ID',
            'date_reg' => 'Date Reg',
            'name' => 'Name',
            'status' => 'Status',
            'email' => 'Email',
            'phone' => 'Phone',
            'skype' => 'Skype',
            'telegram' => 'Telegram',
            'img' => 'Img',
            'birthday' => 'Birthday',
            'address' => 'Address',
            'city_id' => 'City ID',
            'about' => 'About',
            'rating' => 'Rating',
            'failed_task' => 'Failed Task',
            'complete_task' => 'Complete Task',
            'password_hash' => 'Password Hash',
        ];
    }

    /**
     * Gets query for [[Files]].
     *
     * @return ActiveQuery
     */
    public function getFiles():object
    {
        return $this->hasMany(File::class, ['users_id' => 'id']);
    }

    /**
     * Gets query for [[Review]].
     *
     * @return ActiveQuery
     */
    public function getReviews():object
    {
        return $this->hasMany(Review::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Settings]].
     *
     * @return ActiveQuery
     */
    public function getSettings():object
    {
        return $this->hasMany(Setting::class, ['users_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return ActiveQuery
     */
    public function getTasks():object
    {
        return $this->hasMany(Task::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return ActiveQuery
     */
    public function getCity():object
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getCategories():object
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])
            ->viaTable('user_category', ['user_id' => 'id']);
    }
}
