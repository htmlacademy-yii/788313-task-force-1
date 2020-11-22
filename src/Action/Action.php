<?php


namespace TaskForce\Action;


abstract class Action
{
    abstract public function Title();

    abstract public function Name();

    abstract public function Verification(int $idPerformer, int $clientId, int $idCurrentClient);

}
