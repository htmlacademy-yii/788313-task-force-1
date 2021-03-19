<?php

use PHPUnit\Framework\TestCase;
use TaskForce\Exception\TaskException;
use TaskForce\Importer;



class importerTest extends TestCase
{

    private $import;
    public string $fileName = '\data\tasks.csv';
    public string $table = 'tasks';
    public array $header = [
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
        'category_id'];

    protected function setUp(): void
    {
        $this->import = new Importer($this->fileName, $this->table, $this->header);
    }

    protected function tearDown(): void
    {
        $this->task = null;
    }

    public function testImport(): void
    {

    }

}
