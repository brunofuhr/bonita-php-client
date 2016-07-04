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
