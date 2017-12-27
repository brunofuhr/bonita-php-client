<?php

class BonitaCase extends BonitaRestAPI {

    /**
     * Class that handle requests to 'bpm/case' endpoint.
     *
     * @author Bruno E. Fuhr <brunofuhr@gmail.com>
     */
    public function __construct() {
        $this->setEndpoint('bpm/case');
    }

    public function get($id) {
        if ( is_null($id) ) {
            throw new Exception('You must inform the id of the case.');
        }
        return parent::get($id);
    }

    public function getCasesList() {
        return parent::get();
    }

    public function createCase($processId, $userId) {
        if (is_null($processId)) {
            throw new Exception('You must inform the process id to start a case.');
        }
        if (is_null($userId)) {
            throw new Exception('You must inform the user id to start a case.');
        }
        return parent::post(array('processDefinitionId' => "{$processId}", 'startedBySubstitute' => "{$userId}"));
    }

}

