<?php

interface TaskInterface
{
    public function __construct (int $idPerformer, int $idClient, string $activeStatus);
    public function LanguageMap ();
    public function availableStatus ();
    public function getNextStatus (string $action, int $statusUser);
}
