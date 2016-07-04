<?php

class BonitaProcess extends BonitaRestAPI {
    
    public function __construct() {
        $this->setEndpoint('bpm/process');
    }
    
    public function get($id) {
        if ( is_null($id) ) {
            throw new Exception('You must inform the id of the process.');
        }
        return parent::get($id);
    }
    
    public function getProcessList() {
        return parent::get();
    }
    
}
