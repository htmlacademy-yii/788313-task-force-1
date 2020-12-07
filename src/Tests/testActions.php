<?php

require_once  "C:/OpenServer/domains/788313-task-force-1/src/Task.php";
require_once  "C:/OpenServer/domains/788313-task-force-1/src/Action/Action.php";
require_once  "C:/OpenServer/domains/788313-task-force-1/src/Action/DoneAction.php";
require_once  "C:/OpenServer/domains/788313-task-force-1/src/Action/RefuseAction.php";
require_once  "C:/OpenServer/domains/788313-task-force-1/src/Action/RespondAction.php";
require_once  "C:/OpenServer/domains/788313-task-force-1/src/Action/UndoAction.php";

use TaskForce\Task;
use TaskForce\Action\RespondAction;
use TaskForce\Action\UndoAction;
use TaskForce\Action\RefuseAction;
use TaskForce\Action\DoneAction;

//Статус New, id заказчика 1, id исполнителя 2,
$activeStatus = "New";
$clientId = 1;
$idPerformer = 2;

$task = new Task($idPerformer, $clientId, $activeStatus);
echo('Метод Task->getNextStatus действие - Respond');
var_dump($task->getNextStatus('Respond'));
echo('Метод Task->getNextStatus действие - Undo');
var_dump($task->getNextStatus('Undo'));
echo('Метод Task->getNextStatus действие - Refuse');
var_dump($task->getNextStatus('Refuse'));
echo('Метод Task->getNextStatus действие - Done');
var_dump($task->getNextStatus('Done'));

echo('Метод Task->actions');
var_dump($task->actions());

echo('Метод Task->availableActions, статус New, id заказчика 1, id исполнителя 2, текущий пользователь 1');
var_dump($task->availableActions(1));
echo('Метод Task->availableActions, статус New, id заказчика 1, id исполнителя 2, текущий пользователь 2');
var_dump($task->availableActions(2));
echo('Метод Task->availableActions, статус New, id заказчика 1, id исполнителя 2, текущий пользователь 3');
var_dump($task->availableActions(3));

$activeStatus = "Work";
$task = new Task($idPerformer, $clientId, $activeStatus);
echo('Метод Task->availableActions, статус Work, id заказчика 1, id исполнителя 2, текущий пользователь 1');
var_dump($task->availableActions(1));
echo('Метод Task->availableActions, статус Work, id заказчика 1, id исполнителя 2, текущий пользователь 2');
var_dump($task->availableActions(2));
echo('Метод Task->availableActions, статус Work, id заказчика 1, id исполнителя 2, текущий пользователь 3');
var_dump($task->availableActions(3));
