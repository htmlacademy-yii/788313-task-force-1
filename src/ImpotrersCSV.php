<?php


namespace TaskForce;


use TaskForce\Exception\TaskException;
use TaskForce\Importer;

class ImpotrersCSV
{
    public array $interpritator = [
        'cities.csv'     => [
                    'table'  => 'cities',
                    'header' => [
                        'name',
                        'lat',
                        'lng']
        ],
        'categories.csv' => [
                    'table'  => 'categories',
                    'header' => [
                        'name',
                        'code']
        ],
        'profiles.csv'   => [
                    'table'  => 'users',
                    'header' => [
                        'city_id',
                        'birthday',
                        'about',
                        'phone',
                        'skype']
        ],
        'users.csv'      => [
                    'table'  => 'users',
                    'header' => [
                        'email',
                        'name',
                        'password',
                        'date_reg',
                        'city_id',
                        'category_id']
        ],
        'tasks.csv'      => [
                    'table'  => 'tasks',
                    'header' => [
                        'date_create',
                        'category_id',
                        'description',
                        'date_end',
                        'title',
                        'city_id',
                        'price',
                        'lat',
                        'lng',
                        'user_id',
                        'city_id',
                        'category_id']
        ],
        'opinions.csv'   => [
                    'table'  => 'reviews',
                    'header' => [
                        'date_add',
                        'rating',
                        'review']
        ],
        'replies.csv'    => [
                    'table'  => 'reviews',
                    'header' => [
                        'date_add',
                        'rating',
                        'review',
                        'user_id',
                        'task_id']
        ]
    ];

    public function interpritator():void
    {
        foreach ($this->interpritator as $files => $table) {
            $filename = '/data/' . $files;
            try {
                $import = new Importer($filename, $table['table'], $table['header']);
            }
            catch (TaskException $e) {
                error_log("Не найден файл: ". $e->getMessage());
            }

        }
    }


}
