<?php

require_once 'src/autoload.php';

$bonitaUser = new BonitaUser();
$bonitaProcess = new BonitaProcess();
$bonitaCase = new BonitaCase();
$bonitaCaseVariable = new BonitaCaseVariable();
$bonitaRole = new BonitaRole();
$bonitaGroup = new BonitaGroup();
$bonitaMembership = new BonitaMembership();
$bonitaActivity = new BonitaActivity();
$bonitaActivityVariable = new BonitaActivityVariable();

$username = 'requerente';
$user = $bonitaUser->getByUserName($username);

echo '<pre>';
var_dump($user);
//var_dump($bonitaMembership->getUserMemberships($user->id));
//var_dump($bonitaGroup->getGroup(14));
//var_dump($bonitaRole->getRole(2));

// CREATE USER
//$user = $bonitaUser->create('bruno.fuhr', '123', 'Bruno', 'Fuhr');
//var_dump($user);
//var_dump($bonitaMembership->assignMembership($user->id, 14, 2));
//var_dump($bonitaMembership->getUserMemberships($user->id));


// DELETE USER
//var_dump($bonitaUser->delete(107));

// Listar tarefas dos usuários
/*$users = $bonitaUser->getUsersList();
foreach ( $users as $user ) {
    $bonitaTasks = new BonitaHumanTask();
    $pendingTasks = $bonitaTasks->getPendingTasks($user->id);
    $assignedTasks = $bonitaTasks->getAssignedTasks($user->id);

    echo 'Pending tasks to user ' . $user->firstname . ' ' . $user->lastname;
    echo('<br>-------------------------------------------------------------------------------<br>');
    var_dump($pendingTasks);
    echo('<br>-------------------------------------------------------------------------------<br>');
    echo 'Assigned tasks to user ' . $user->firstname . ' ' . $user->lastname;
    echo('<br>-------------------------------------------------------------------------------<br>');
    var_dump($assignedTasks);
    echo('<br>-------------------------------------------------------------------------------<br>');
}*/


$processes = $bonitaProcess->getProcessList();
var_dump($processes);
//$bonitaCase->createCase("7912243084376866761", $user->id);

echo('<br>-------------------------------------------------------------------------------<br>');
echo "Pending tasks to user {$username}<br>";
$bonitaTask = new BonitaHumanTask();
$pendingTask = $bonitaTask->getPendingTasks($user->id);
var_dump($pendingTask);
echo('<br>-------------------------------------------------------------------------------<br>');
//$bonitaTask->assignTaskToUser($pendingTask[0]->id, $user->id);
echo('<br>-------------------------------------------------------------------------------<br>');
echo "Assigned tasks to user {$username}<br>";
$assignedTask = $bonitaTask->getAssignedTasks($user->id);
var_dump($assignedTask);
//$bonitaTask->executeTask($assignedTask[0]->id, $user->id, array(array('name' => 'status', 'type' => 'int', 'value' => '3')));
echo('<br>-------------------------------------------------------------------------------<br>');

//var_dump($bonitaActivity->getCaseActivities($pendingTask[1]->caseId));
//var_dump($bonitaActivity->getActivity($pendingTask[0]->id));
//var_dump($bonitaActivityVariable->getActivityVariable($pendingTask[0]->id, 'teste'));
//var_dump($bonitaCaseVariable->getVariablesList($pendingTask[0]->caseId));