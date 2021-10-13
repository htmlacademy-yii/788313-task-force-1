<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\base\InvalidConfigException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $date_reg
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $skype
 * @property string $telegram
 * @property string $img
 * @property string $birthday
 * @property string $address
 * @property int $city_id
 * @property string $about
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
class User extends ActiveRecord implements IdentityInterface
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
            [['date_reg', 'name', 'email', 'phone', 'skype', 'telegram', 'img', 'birthday', 'address', 'city_id', 'about', 'failed_task', 'complete_task', 'password_hash'], 'required'],
            [['date_reg', 'birthday'], 'safe'],
            [['city_id', 'failed_task', 'complete_task'], 'integer'],
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
            'date_reg' => 'Дата регистрации',
            'name' => 'Имя',
            'email' => 'Электронная почта',
            'phone' => 'Номер телефона',
            'skype' => 'Skype',
            'telegram' => 'Telegram',
            'img' => 'Img',
            'birthday' => 'День рождения',
            'address' => 'Адрес',
            'city_id' => 'City ID',
            'about' => 'Обо мне',
            'failed_task' => 'Проваленные задания',
            'complete_task' => 'Выполненные задания',
            'password_hash' => 'Password Hash',
        ];
    }

    /**
     * Gets query for [[Files]].
     *
     * @return ActiveQuery
     */
    public function getFiles():ActiveQuery
    {
        return $this->hasMany(File::class, ['users_id' => 'id']);
    }

    /**
     * Gets query for [[Review]].
     *
     * @return ActiveQuery
     */
    public function getReviews():ActiveQuery
    {
        return $this->hasMany(Review::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return ActiveQuery
     */
    public function getResponses():ActiveQuery
    {
        return $this->hasMany(Responce::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Settings]].
     *
     * @return ActiveQuery
     */
    public function getSettings():ActiveQuery
    {
        return $this->hasMany(Setting::class, ['users_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return ActiveQuery
     */
    public function getTasks():ActiveQuery
    {
        return $this->hasMany(Task::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return ActiveQuery
     */
    public function getCity():ActiveQuery
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getCategories():ActiveQuery
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])
            ->viaTable('user_category', ['user_id' => 'id']);
    }

    public function getRating():?float
    {
        $median = $this->getReviews()->average('rating');
        return number_format($median, 1, '.', '');
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
}
