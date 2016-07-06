<?php

require_once 'src/autoload.php';

$bonitaUser = new BonitaUser();
$bonitaProcess = new BonitaProcess();
$bonitaCase = new BonitaCase();
$bonitaRole = new BonitaRole();
$bonitaGroup = new BonitaGroup();
$bonitaMembership = new BonitaMembership();

$username = 'bruno.fuhr';
$user = $bonitaUser->getByUserName($username);

echo '<pre>';
//var_dump($bonitaMembership->getUserMemberships($user->id));
//var_dump($bonitaGroup->getGroup(14));
//var_dump($bonitaRole->getRole(2));

// CREATE USER
//$user = $bonitaUser->create('bruno.fuhr', '123', 'Bruno', 'Fuhr');
var_dump($user);
//var_dump($bonitaMembership->assignMembership($user->id, 14, 2));
var_dump($bonitaMembership->getUserMemberships($user->id));


// DELETE USER
//var_dump($bonitaUser->delete(107));

// Listar tarefas dos usuários
//$users = $bonitaUser->getUsersList();
//foreach ( $users as $user ) {
//    $bonitaTasks = new BonitaHumanTask();
//    $pendingTasks = $bonitaTasks->getPendingTasks($user->id);
//    $assignedTasks = $bonitaTasks->getAssignedTasks($user->id);
//    
//    echo 'Pending tasks to user ' . $user->firstname . ' ' . $user->lastname;
//    echo('<br>-------------------------------------------------------------------------------<br>');
//    var_dump($pendingTasks);
//    echo('<br>-------------------------------------------------------------------------------<br>');
//    echo 'Assigned tasks to user ' . $user->firstname . ' ' . $user->lastname;
//    echo('<br>-------------------------------------------------------------------------------<br>');
//    var_dump($assignedTasks);
//    echo('<br>-------------------------------------------------------------------------------<br>');
//}


$processes = $bonitaProcess->getProcessList();
//$bonitaCase->createCase($processes[0]->id, $user->id);

echo "Pending tasks to user {$username}<br>";
$bonitaTask = new BonitaHumanTask();
$pendingTask = $bonitaTask->getPendingTasks($user->id);
var_dump($pendingTask);
//$bonitaTask->assignTaskToUser($userTask[0]->id, $user->id);
echo('<br>-------------------------------------------------------------------------------<br>');
echo "Assigned tasks to user {$username}<br>";
$assignedTask = $bonitaTask->getAssignedTasks($user->id);
var_dump($assignedTask);
//$bonitaTask->executeTask($userTask[0]->id, $user->id, array(array('name' => 'aprovado', 'type' => 'bool', 'value' => 'true'), array('name' => 'obs', 'type' => 'string', 'value' => 'teste')));
echo('<br>-------------------------------------------------------------------------------<br>');
