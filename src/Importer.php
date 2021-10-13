<?php


namespace TaskForce;


use TaskForce\Exception\TaskException;
use SplFileObject;

class Importer
{
    private string $_fileName;
    private array  $_columns;
    private string $_tableName;
    private object $_readFileObject;
    private object $_writeFileObject;
    private array $_header;
    private array  $result = [];

    public function __construct(string $fileName, string $tableName, array $columns)
    {
        $this->_fileName = $fileName;
        $this->_columns = $columns;
        $this->_tableName = $tableName;
    }

    public function readFile():array
    {
        if (!file_exists($this->_fileName)) {
            throw new TaskException("Файл не существует");
        }
        try {
            $this->_readFileObject = new SplFileObject($this->_fileName);
        }
        catch (TaskException $exception) {
            throw new TaskException("Не удалось открыть файл на чтение");
        }
        $this->_readFileObject->setFlags(SplFileObject::SKIP_EMPTY | SplFileObject::READ_AHEAD);
        $this->_header = $this->_readFileObject->fgetcsv();
        while (!$this->_readFileObject->eof()) {
            $this->result[] = str_replace("\r\n\r\n", " ", $this->_readFileObject->fgetcsv());
        }
        return array_filter($this->result);
    }

    public function import():void
    {
        $this->result = $this->readFile();
        $this->_writeFileObject = new SplFileObject($this->_fileName. ".sql", "a+");
        $randCount = count($this->_columns) - count($this->_header);
        $stringColumn = implode(", ",$this->_columns);
        $this->_writeFileObject->fwrite("USE taskforce;\r\n");
        $this->_writeFileObject->fwrite("INSERT INTO $this->_tableName ($stringColumn) VALUES\r\n");
        foreach ($this->result as $key=>$row) {
            if (count($row) !== count($this->_header)) {
                continue;
            }
            $stringRow = "('" . implode("', '",$row)."'";
            if ($randCount) {
                for ($i = 0; $i < $randCount; $i++) {
                    $rand = rand(1,6);
                    $stringRow .= ", '$rand'";
                }
                $stringRow .= "),\r\n";
            } else {
                $stringRow .= "),\r\n";
            }
            if ($key === array_key_last($this->result)) {
                $stringRow = substr_replace($stringRow,";",-3);
            }
            $this->_writeFileObject->fwrite($stringRow);
        }
    }
}
