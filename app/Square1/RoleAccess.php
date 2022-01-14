<?php

namespace App\Square1;

use App\Models\User;
use Illuminate\Support\Arr;

/**
 * 
 */
class RoleAccess
{
	private $accessMap = [
        User::ROLE_ADMIN => [
            User::ROLE_ADMIN,
            User::ROLE_CONTRIBUTOR
        ],
    ];

    private $roles = [
        User::ROLE_ADMIN,
        User::ROLE_CONTRIBUTOR
    ];

    /**
     * static method to check user access
     * 
     * @param string $role
     * @param string $to
     * 
     * @return bool
    */
    public static function hasAccess(string $role, string $to)
    {
    	$retval = true;
        $checker = new static();

        if (! in_array( $role, $checker->getRoles(), true ) || ! in_array( $to, $checker->getRoles(), true )) {
            throw new \Exception("Role [$role] or [$to] does not supported by system.");
        }

        if ($role === $to) {
            return $retval;
        }

        $accessMap = $checker->getAccessMap();

        if (Arr::get($accessMap, $role) && in_array( $to, $accessMap[ $role ], true )) {
            return $retval;
        }

        return false;
    }

    /**
     * @return array
    */
    public function getAccessMap(): array
    {
        return $this->accessMap;
    }

    /**
     * @return array
    */
    public function getRoles(): array
    {
        return $this->roles;
    }
}