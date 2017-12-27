<?php

class BonitaProcessContract extends BonitaRestAPI {

    public function __construct($processId) {
        $this->setEndpoint('bpm/process/' . $processId . '/contract');
    }

    public function get() {
        return parent::get();
    }

}