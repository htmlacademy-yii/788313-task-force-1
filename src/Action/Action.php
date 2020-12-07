<?php


namespace TaskForce\Action;


abstract class Action
{
    abstract public function Title(): string;

    abstract public function Name(): string;

    abstract public function Verification(int $idPerformer, int $clientId, int $idCurrentClient): bool;

}
