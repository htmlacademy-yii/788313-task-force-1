<?php


namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\Contact;

class ContactsController extends Controller
{
    public function actionIndex():string
    {
        $contact = new Contact();
        $contact->name = "Петров Иван";
        $contact->phone = "79005552211";
        $contact->email = "petro.ivan@mail.ru";
        $contact->position = "Менеджер";
        $contact->save();
        return $this->render('index');
    }
}
