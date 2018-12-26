<?php
namespace Gaia\Services\User;

interface UserServiceInterface {

    /**
     * 
     * @param string $username email or loginName
     * @param string $password
     * @return bool
     */
    public function login($username, $password): bool;
}