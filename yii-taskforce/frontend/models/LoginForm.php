<?php

namespace frontend\models;

use yii\base\Model;
use frontend\models\User;

class LoginForm extends Model
{
    public $email;
    public $password;

    private $_user;

    public function attributeLabels(): array
    {
        return ['email' => 'Email',
            'password' => 'Пароль'
        ];
    }

    public function rules():array
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email', 'message' => 'Введите валидный адрес электронной почты'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неправильный email или пароль');
            }
        }
    }

    public function getUser():?User
    {
        if ($this->_user === null) {
            $this->_user = User::findOne(['email' => $this->email]);
        }
        return $this->_user;
    }

}
