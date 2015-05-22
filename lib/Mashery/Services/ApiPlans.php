<?php

require_once( constant('MASHERYPORTAL_ROOT') . '/lib/Mashery/Services/BaseService.php' );

Class Mashery_Services_ApiPlans extends Mashery_Services_BaseService
{
    public function fetch($username)
    {
        $currentUserKeys = $this->_fetchAll('package_keys', '*,package,plan', 'WHERE username =\'' . $username . '\'');
        $currentUserRoles = $this->_fetchAll('members', 'roles', 'WHERE username =\'' . $username . '\'');
        $packages = $this->_fetchAll('packages', 'id,name,plans,plans.roles', null);

        $currentUserKeys = json_decode($currentUserKeys);
        $currentUserRoles = json_decode($currentUserRoles);
        $packages = json_decode($packages);

        $registerableApiPackages = array();
        foreach ($packages as $package) {
            $new_package = array(
                "id" => $package->id,
                "name" => $package->name,
                "description" => $package->description,
                "plans" => array()
            );
            $registerableApiPlans = array();
            foreach ($package->plans as $plan) {
                if ($this->registerable($plan, $currentUserKeys, $currentUserRoles->result->items[0]->roles))
                {
                    $new_plan =  array( 
                        "id" => $plan->id,
                        "name" => $plan->name,
                        "description" => $plan->description
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
        return json_encode($registerableApiPackages);
    }

    private function registerable($plan, $currentUserKeys, $currentUserRoles)
    {
        if ($plan->selfServiceKeyProvisioningEnabled == 1 
            && $this->matchedRoles($plan->roles, $currentUserRoles)
            && $this->moreKeysAllowed($plan, $currentUserKeys)) {
            return true;
        }
        return false;
    }
    private function moreKeysAllowed($plan, $currentUserKeys)
    {
        $keyCt = 0;
        foreach ($currentUserKeys as $userKey) {
            if ($userKey->plan->uuid == $plan->id)
            {
                $keyCt++;
            }

        }
        if ($keyCt < $plan->maxNumKeysAllowed)
        {
            return true;
        }
        return false;
    }

}



