<?php

interface TaskInterface
{
    public function __construct (int $idPerformer, int $idClient);
    public  function statusMap (string $status);
    public function availableStatus (string $status);
    public function setStatus (string $status);
}
