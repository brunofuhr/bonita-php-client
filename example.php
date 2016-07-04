<?php

require_once 'src/autoload.php';

$bonitaUser = new BonitaUser();

echo '<pre>';

// Listar tarefas dos usuários
$users = $bonitaUser->getUsersList();
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
}

echo 'Assign and execute task to user william.jobs<br>';
$williamJobs = $bonitaUser->getByUserName('william.jobs');
$bonitaTask = new BonitaHumanTask();
$williamTask = $bonitaTask->getPendingTasks($williamJobs->id);
$bonitaTask->assignTaskToUser($williamTask[0]->id, $williamJobs->id);
$bonitaTask->executeTask($williamTask[0]->id, $williamJobs->id, array(array('name' => 'aprovado', 'type' => 'bool', 'value' => 'true'), array('name' => 'obs', 'type' => 'string', 'value' => 'teste')));
echo('<br>-------------------------------------------------------------------------------<br>');
