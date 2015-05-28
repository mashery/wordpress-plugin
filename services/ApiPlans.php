<?php

require_once( constant('MASHERYPORTAL_ROOT') . '/lib/MasheryV2.php' );
require_once( constant('MASHERYPORTAL_ROOT') . '/services/BaseService.php' );

Class ApiPlans extends BaseService 
{
    public function fetch()
    {
        $currentUserKeys = $this->_fetchAll('package_keys', '*,package,plan');
        $currentUserRoles = $this->_fetchAll('members', 'roles');
        $packages = $this->_fetchAll('packages', 'id,name,plans,plans.roles');

        $registerableApiPackages = array();
        foreach ($packages as $package) {
            $new_package = array(
                "id" => $package['id'],
                "name" => $package['name'],
                "description" => $package['description'],
                "plans" => array()
            );
            $registerableApiPlans = array();
            foreach ($package['plans'] as $plan) {
                if ($this->registerable($plan, $currentUserKeys, $currentUserRoles[0]['roles']))
                {
                    $new_plan =  array( 
                        "id" => $plan['id'],
                        "name" => $plan['name'],
                        "description" => $plan['description']
                    );

                    $registerableApiPlans[] = $new_plan;
                }
            }
            if (sizeof($registerableApiPlans) > 0)
            {
                $new_package['plans'] = $registerableApiPlans;
                $registerableApiPackages[] = $new_package;
            }

        }
        return $registerableApiPackages;
    }

    private function registerable($plan, $currentUserKeys, $currentUserRoles)
    {
        if ($plan['selfServiceKeyProvisioningEnabled'] == 1 
            && $this->matchedRoles($plan['roles'], $currentUserRoles)
            && $this->moreKeysAllowed($plan, $currentUserKeys)) {
            return true;
        }
        return false;
    }
    private function moreKeysAllowed($plan, $currentUserKeys)
    {
        $keyCt = 0;
        foreach ($currentUserKeys as $userKey) {
            if ($userKey['plan']['uuid'] == $plan['id'])
            {
                $keyCt++;
            }

        }
        if ($keyCt < $plan['maxNumKeysAllowed'])
        {
            return true;
        }
        return false;
    }
    private function matchedRoles($planRoles, $userRoles)
    {
        foreach ($userRoles as $role) {
            foreach ($planRoles as $planRole) {
                if (array_search($role['name'], $planRole) || $planRole['name'] == 'Everyone') {
                    return true;
                }
            }
        }

        return $false;
    }
}



