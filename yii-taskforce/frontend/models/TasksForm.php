<?php


namespace frontend\models;

use \yii\base\Model;

class TasksForm extends Model
{
    public $category_ids;
    public $additionally;
    public $search;
    public $period;


    public function attributeLabels(): array
    {
        return ['category_ids' => 'Category ID',
                'additionally' => 'Additionally',
                'search' => 'Search',
                'period' => 'Period'
        ];
    }

    public function rules(): array
    {
        return [
            [['category_ids', 'additionally', 'search', 'period'], 'trim'],
            [['category_ids', 'additionally', 'search', 'period'], 'default']
        ];
    }
}
