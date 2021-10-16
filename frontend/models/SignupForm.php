<?php

namespace frontend\models;

use Yii;
use yii\base\Exception;
use yii\base\Model;

class SignupForm extends Model
{
    public $email;
    public $name;
    public $city;
    public $password;

    public function attributeLabels() :array
    {
        return [
            'email' => 'Электронная почта',
            'name' => 'Ваше имя',
            'city' => 'Город проживания',
            'password' => 'Пароль'
        ];
    }

    public function rules() :array
    {
        return [
            ['city', 'integer'],
            [['email', 'name'], 'trim'],
            [['email', 'name','password'], 'required'],
            ['email', 'email', 'message' => 'Введите валидный адрес электронной почты'],
            ['email', 'string', 'max' => 50],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'Введенный адрес электронной почты уже занят' ],
            ['name', 'string', 'min' => 2, 'max' => 50, 'message' => 'Введите ваше имя'],
            ['password', 'string', 'min' => 6, 'max' => 250],
        ];
    }

    /**
     * @throws Exception
     */
    public function signup():bool
    {
        $user = new User();
        $user->email = $this->email;
        $user->name = $this->name;
        $user->city_id = $this->city + 1;
        $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
        $user->date_reg = date('Y-m-d H:i:s');
        $user->failed_task = 0;
        $user->complete_task = 0;
        $user->about = '';
        $user->phone = '';
        $user->address = '';
        $user->skype = '';
        $user->telegram = '';
        $user->img = '';
        $user->birthday = date('Y-m-d');
        return $user->save(false);
    }

}
