<?php

class BonitaActor extends BonitaRestAPI {

    /**
     * Class that handle requests to 'bpm/actor' endpoint.
     *
     * @author Bruno E. Fuhr <brunofuhr@gmail.com>
     */
    public function __construct() {
        $this->setEndpoint('bpm/actor');
    }

    public function get($id) {
        if ( is_null($id) ) {
            throw new Exception('You must inform the id of the actor.');
        }
        return parent::get($id);
    }

    /**
     * Get actors for a process
     *
     * @param String $processId
     * @return Object Returns an array of actors of the process
     */
    public function getActorsByProcess($processId) {
        $this->setFilters(array('process_id' => $processId));
        return parent::get();
    }
    
    public function update($id, $displayName, $description = '') {
        $data = array(
            "displayName" => "{$displayName}",
            "description" => "{$description}"
        );
        return parent::put($id, $data);
    }
}
