<?php


namespace TaskForce;


abstract class Action
{
    abstract public function Title(int $idPerformer, int $clientId);

    abstract public function Name();

    abstract public function Verification(int $idPerformer, int $clientId, int $idCurrentClient);

}

class StatusNew extends Action
{
    public function Title(int $idPerformer, int $clientId)
    {
        $title = new TaskForce($idPerformer, $clientId);
        return $title->languageMap(1);
    }

    public function Name()
    {
        return 1;
    }

    public function Verification(int $idPerformer, int $clientId, int $idCurrentClient)
    {
        return 1;
    }
}

class StatusCancel extends Action
{
    public function Title(int $idPerformer, int $clientId)
    {
        $title = new TaskForce($idPerformer, $clientId);
        return $title->languageMap(2);
    }

    public function Name()
    {
        return 2;
    }

    public function Verification(int $idPerformer, int $clientId, int $idCurrentClient)
    {
        return ($this->$clientId === $idCurrentClient) ? 1 : 0;
    }
}

class StatusWork extends Action
{
    public function Title(int $idPerformer, int $clientId)
    {
        $title = new TaskForce($idPerformer, $clientId);
        return $title->languageMap(3);
    }

    public function Name()
    {
        return 3;
    }

    public function Verification(int $idPerformer, int $clientId, int $idCurrentClient)
    {
        return ($this->$clientId === $idCurrentClient) ? 1 : 0;
    }
}

class StatusReady extends Action
{
    public function Title(int $idPerformer, int $clientId)
    {
        $title = new TaskForce($idPerformer, $clientId);
        return $title->languageMap(4);
    }

    public function Name()
    {
        return 4;
    }

    public function Verification(int $idPerformer, int $clientId, int $idCurrentClient)
    {
        return ($this->$clientId === $idCurrentClient) ? 1 : 0;
    }
}

class StatusFailed extends Action
{
    public function Title(int $idPerformer, int $clientId)
    {
        $title = new TaskForce($idPerformer, $clientId);
        return $title->languageMap(5);
    }

    public function Name()
    {
        return 5;
    }

    public function Verification(int $idPerformer, int $clientId, int $idCurrentClient)
    {
        return ($this->$idPerformer === $idCurrentClient) ? 1 : 0;
    }
}
