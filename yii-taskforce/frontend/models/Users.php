<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property int $category_id
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
 * @property Files[] $files
 * @property Reviews[] $reviews
 * @property Settings[] $settings
 * @property Tasks[] $tasks
 * @property Cities $city
 * @property Categories $category
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'date_reg', 'name', 'status', 'email', 'phone', 'skype', 'telegram', 'img', 'birthday', 'address', 'city_id', 'about', 'rating', 'failed_task', 'complete_task', 'password_hash'], 'required'],
            [['category_id', 'status', 'city_id', 'rating', 'failed_task', 'complete_task'], 'integer'],
            [['date_reg', 'birthday'], 'safe'],
            [['name', 'email'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 11],
            [['skype', 'telegram'], 'string', 'max' => 40],
            [['img', 'password_hash'], 'string', 'max' => 250],
            [['address'], 'string', 'max' => 100],
            [['about'], 'string', 'max' => 200],
            [['email'], 'unique'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
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
            'category_id' => 'Category ID',
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
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['users_id' => 'id']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Reviews::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Settings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSettings()
    {
        return $this->hasMany(Settings::className(), ['users_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
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
