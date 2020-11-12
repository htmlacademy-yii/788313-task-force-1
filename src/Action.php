<?php


namespace TaskForce;


abstract class Action
{
    abstract public function Title($title);

    abstract public function Name();

    abstract public function Verification(int $idPerformer, int $idClient, int $idCurrentClient);

}

class Status1 extends Action
{
    public function Title($title)
    {
        return $title;
    }

    public function Name()
    {
        return "New";
    }

    public function Verification(int $idPerformer, int $idClient, int $idCurrentClient)
    {
        return true;
    }
}

class Status2 extends Action
{
    public function Title($title)
    {
        return $title;
    }

    public function Name()
    {
        return "Cancel";
    }

    public function Verification(int $idPerformer, int $idClient, int $idCurrentClient)
    {
        return ($this->$idClient = $idCurrentClient) ? "true" : "false";
    }
}

class Status3 extends Action
{
    public function Title($title)
    {
        return $title;
    }

    public function Name()
    {
        return "Work";
    }

    public function Verification(int $idPerformer, int $idClient, int $idCurrentClient)
    {
        return ($this->$idClient = $idCurrentClient) ? "true" : "false";
    }
}

class Status4 extends Action
{
    public function Title($title)
    {
        return $title;
    }

    public function Name()
    {
        return "Ready";
    }

    public function Verification(int $idPerformer, int $idClient, int $idCurrentClient)
    {
        return ($this->$idClient = $idCurrentClient) ? "true" : "false";
    }
}

class Status5 extends Action
{
    public function Title($title)
    {
        return $title;
    }

    public function Name()
    {
        return "Failed";
    }

    public function Verification(int $idPerformer, int $idClient, int $idCurrentClient)
    {
        return ($this->$idPerformer = $idCurrentClient) ? "true" : "false";
    }
}
