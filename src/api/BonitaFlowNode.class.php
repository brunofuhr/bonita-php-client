<?php

class BonitaFlowNode extends BonitaRestAPI {

    /**
     * Class that handle requests to 'flowNode' endpoint.
     *
     * @author Bruno E. Fuhr <brunofuhr@gmail.com>
     */
    public function __construct() {
        $this->setEndpoint('bpm/flowNode');
    }

    /**
     * Get the list of nodes from a process
     *
     * @param int $processId The identifier of the process
     * @return Array List of nodes from the process
     * @throws Exception
     */
    public function getProcessNodes($processId) {
        if ( is_null($processId) ) {
            throw new Exception('You must inform the id of the process.');
        }
        $this->filters['processId'] = $processId;
        return parent::get();
    }

}