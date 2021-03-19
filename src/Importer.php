<?php


namespace TaskForce;


use TaskForce\Exception\TaskException;
use SplFileObject;

class Importer
{
    private string $_fileName;
    private object $_fileObject;
    private array  $_columns;
    private string $_tableName;
    private array  $result = [];

    public function __construct(string $fileName, string $tableName, array $columns)
    {
        $this->_fileName = $fileName;
        $this->_columns = $columns;
        $this->_tableName = $tableName;
    }

    public function import():void
    {
        if (!file_exists($this->_fileName)) {
            throw new TaskException("Файл не существует.");
        }
        if (!$this->validateColumns($this->_columns)) {
            throw new TaskException("Неверные заголовки столбцов");
        }
        $this->_fileObject = new SplFileObject($this->_fileName. ".sql", "a+");
        foreach ($this->getNextLine() as $line) {
            $this->result[] = $line;
        }
        $column = $this->_columns;
        $header = $this->getHeaderData();
        if (!in_array($header, $column, true)) {
            throw new TaskException("Файл не содержит необходимых столбцов");
        }
        $randCount = count($column) - count($header);
        $stringHead = implode(", ",$column);

        $this->_fileObject->fwrite("INSERT INTO $this->_tableName ($stringHead) VALUES ");
        foreach ($this->result as $row) {
            $this->_fileObject->fwrite("($row");
            for ($i = 1; $i < $randCount; $i++) {
                $this->_fileObject->fwrite(", " . rand(1,6));
            }
        }
        $this->_fileObject->fseek(1,SEEK_END);
        $this->_fileObject->fwrite(";");
    }

    private function validateColumns(array $columns):bool
    {
        if (count($columns)) {
            foreach ($columns as $column) {
                if (!is_string($column)) {
                    return false;
                }
            }
        } else {
            return false;
        }
        return true;
    }

    public function getHeaderData():?array
    {
        $this->_fileObject->rewind();
        return $this->_fileObject->fgetcsv();
    }

    public function getNextLine():iterable
    {
        while (!$this->_fileObject->eof()) {
            yield $this->_fileObject->fgetcsv();
        }
    }

}
