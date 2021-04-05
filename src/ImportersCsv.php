<?php


namespace TaskForce;

use TaskForce\Exception\TaskException;
use TaskForce\Importer;
use SplFileObject;

class ImportersCsv
{
    private array $accord = [
        'cities.csv'      => [
                    'table'  => 'cities',
                    'header' => [
                        'name',
                        'lat',
                        'lng']
        ],
        'categories.csv'  => [
                    'table'  => 'categories',
                    'header' => [
                        'name',
                        'code']
        ],
        'users-profiles.csv'=> [
                    'table'  => 'users',
                    'header' => [
                        'email',
                        'name',
                        'password_hash',
                        'date_reg',
                        'address',
                        'birthday',
                        'about',
                        'phone',
                        'skype',
                        'city_id',
                        'category_id']
        ],
        'tasks.csv'       => [
                    'table'  => 'tasks',
                    'header' => [
                        'date_create',
                        'category_id',
                        'description',
                        'date_end',
                        'title',
                        'address',
                        'price',
                        'lat',
                        'lng',
                        'user_id']
        ],
        'opinions.csv'    => [
                    'table'  => 'reviews',
                    'header' => [
                        'date_add',
                        'rating',
                        'review',
                        'user_id',
                        'task_id']
        ],
        'replies.csv'     => [
                    'table'  => 'reviews',
                    'header' => [
                        'date_add',
                        'rating',
                        'review',
                        'user_id',
                        'task_id']
        ]
    ];
    public array $userResult;
    private array $profileResult;
    private array $output;

    public function joinCSVUser():void
    {
        $user     = new SplFileObject('data/users.csv');
        $user->setFlags(SplFileObject::SKIP_EMPTY | SplFileObject::READ_AHEAD | SplFileObject::DROP_NEW_LINE);
        $profile = new SplFileObject('data/profiles.csv');
        while (!$user->eof()) {
            $userResult[] = $user->fgets();
        }
        while (!$profile->eof()) {
            $profilesResult[] = $profile->fgets();
        }
        $min = min(count($userResult), count($profilesResult));
        $output = new SplFileObject('data/users-profiles.csv', "a+");
        for ($i = 0; $i < $min-1; $i++) {
            $output->fwrite($userResult[$i] . ', ' . $profilesResult[$i]);
        }
    }
    public function interpreter():void
    {
        foreach ($this->accord as $files => $table) {
            $filename = 'data/' . $files;
                $import = new Importer($filename, $table['table'], $table['header']);
            try {
                $import->import();
            } catch (TaskException $e) {
                error_log("Ошибка: ". $e->getMessage());
            }
        }
    }


}
