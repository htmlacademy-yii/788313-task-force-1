<?php


namespace TaskForce\action;


abstract class Action
{
    abstract public function Title(): string;

    abstract public function Name(): string;

    abstract public function Verification(int $performerId, int $clientId, int $currentClientId): bool;

}
