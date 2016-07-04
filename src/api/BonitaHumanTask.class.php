<?php

require_once 'BonitaCaseVariable.class.php';

class BonitaHumanTask extends BonitaRestAPI {
    
    /**
     * Class that handle requests to 'humanTask' endpoint.
     * 
     * @author Bruno E. Fuhr <brunofuhr@gmail.com>
     */
    public function __construct() {
        $this->setEndpoint('bpm/humanTask');
    }
    
    /**
     * Get a task
     * 
     * @param int $id The identifier of the task
     * @return stdClass The task object, if exists, or null
     * @throws Exception
     */
    public function get($id) {
        if ( is_null($id) ) {
            throw new Exception('You must inform the id of the task.');
        }
        
        $task = parent::get($id);
        return strlen($task->id) > 0 ? $task : NULL;
    }
    
    /**
     * Get the pending tasks of the user
     * 
     * @param int $userId The identifier of the user
     * @return Array List of the pending tasks for the specified user
     * @throws Exception
     */
    public function getPendingTasks($userId) {
        if ( is_null($userId) ) {
            throw new Exception('You must inform the id of the user.');
        }
        $this->filters['user_id'] = $userId;
        return parent::get();
    }
    
    /**
     * Get the assigned tasks of the user
     * 
     * @param int $userId The identifier of the user
     * @return Array List of the assigned tasks for the specified user
     * @throws Exception
     */
    public function getAssignedTasks($userId) {
        if ( is_null($userId) ) {
            throw new Exception('You must inform the id of the user.');
        }
        $this->filters['assigned_id'] = $userId;
        return parent::get();
    }
    
    /**
     * Assign a task to a user
     * 
     * @param int $taskId The identifier of the task
     * @param int $userId The identifier of the user
     * @return boolean Returns if the task was assigned to the user
     * @throws Exception
     */
    public function assignTaskToUser($taskId, $userId) {
        if ( is_null($userId) ) {
            throw new Exception('You must inform the id of the user.');
        }
        // Call PUT method to assign task to user.
        parent::put($taskId, array('assigned_id' => "{$userId}"));
        
        return $this->isTaskAssignedToUser($taskId, $userId);
    }
    
    /**
     * Execute a task
     * 
     * @param int $taskId The identifier of the task
     * @param int $userId The identifier of the user
     * @param Array $variables The variables of the process to update
     * @return boolean Return if the task was executed
     */
    public function executeTask($taskId, $userId, $variables = NULL) {
        if ( !$this->isTaskAssignedToUser($taskId, $userId) ) {
            throw new Exception("The task '{$taskId}' is not assigned to the user '{$userId}'");
        } else {
            $task = $this->get($taskId);
            if ( is_array($variables) ) {
                foreach ($variables as $variable) {
                    $variable = is_array($variable) ? (object) $variable : $variable;

                    $caseVariable = new BonitaCaseVariable();
                    $caseVariable->updateCaseVariable($task->caseId, $variable->name, $variable->type, $variable->value);
                }
            }
            
            // Call PUT method to execute task.
            parent::put($taskId, array('state' => BonitaRestAPI::STATE_COMPLETED, 'executedBySubstitute' => "{$userId}"));
        }
        
        return true;
    }

    /**
     * Verifies if the task was assigned to the specified user.
     * 
     * @param int $taskId The identifier of the task
     * @param int $userId The identifier of the user
     * 
     * @return boolean Return if task is assigned to user
     */
    public function isTaskAssignedToUser($taskId, $userId) {
        $task = $this->get($taskId);
        return $task->assigned_id == $userId;
    }
    
}
