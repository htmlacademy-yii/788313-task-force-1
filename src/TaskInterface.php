<?php

interface TaskInterface
{
    public function __construct (int $idPerformer, int $idClient);
    public function languageMap (int $status);
    public function availableStatus (int $status);
    public function setStatus (int $status);
}
