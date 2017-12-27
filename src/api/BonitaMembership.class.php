<?php

class BonitaMembership extends BonitaRestAPI {

    /**
     * Class that handle requests to 'identity/membership' endpoint.
     *
     * @author Bruno E. Fuhr <brunofuhr@gmail.com>
     */
    public function __construct() {
        $this->setEndpoint('identity/membership');
    }

    public function getUserMemberships($userId) {
        if (strlen($userId) == 0) {
            return new Exception('You must inform the user id');
        }
        $this->setFilters(array('user_id' => $userId));
        return parent::get();
    }

    public function assignMembership($userId, $groupId, $roleId) {
        $data = array(
            "user_id" => "{$userId}",
            "group_id" => "{$groupId}",
            "role_id" => "{$roleId}"
        );
        return parent::post($data);
    }

    public function deleteMembership($userId, $groupId, $roleId) {
        return parent::delete("{$userId}/{$groupId}/{$roleId}");
    }
}
