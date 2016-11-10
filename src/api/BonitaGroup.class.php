<?php

class BonitaGroup extends BonitaRestAPI {

    /**
     * Class that handle requests to 'identity/group' endpoint.
     *
     * @author Bruno E. Fuhr <brunofuhr@gmail.com>
     */
    public function __construct() {
        $this->setEndpoint('identity/group');
    }

    public function getGroup($id) {
        if (strlen($id) == 0) {
            return new Exception('You must inform the group id');
        }
        return parent::get($id);
    }

    public function getGroupsList() {
        return parent::get();
    }

    public function create($name, $displayName, $description, $parentGroupId = NULL) {
        $data = array(
            "icon" => "",
            "name" => "{$name}",
            "displayName" => "{$displayName}",
            "description" => "{$description}",
            "parent_group_id" => "{$parentGroupId}"
        );
        return parent::post($data);
    }

}
