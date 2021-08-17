<?php


namespace frontend\models;

use \yii\base\Model;
use yii\base\BaseObject;

class TaskForm extends Model
{
    public $category_id;
    public $additionally;
    public $search;
    public $period;


    public function attributeLabels(): array
    {
        return ['category_id' => 'Category ID',
                'additionally' => 'Additionally',
                'search' => 'Search',
                'period' => 'Period'
        ];
    }

    public function rules(): array
    {
        return [
            [['category_id', 'additionally', 'search', 'period'], 'trim'],
            [['category_id', 'additionally', 'search', 'period'], 'default']
        ];
    }

    public function getCategoryId(): array
    {
        return !empty($this->category_id) ? $this->category_id : [];
    }

    public function getSearch(): ?string
    {
        return $this->search;
    }

    public function getPeriod()
    {
        return $this->period ? date_format(date_modify(date_create(date('Y-m-d H:i:s')),'-1 '. $this->period),'Y-m-d') : '';
    }


}
