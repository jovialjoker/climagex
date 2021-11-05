<?php

namespace App\Observers;

use App\Models\Organization;
use App\Models\User;

class OrganizationObserver
{
    public function created(Organization $organization) {
        $organizationOwner = User::createOrganizationOwner($organization);

        $dispatchData = [
            'password' => $organizationOwner[1],
            'email' => $organizationOwner[0]->email,
            'name' => $organization[0]->name,
        ];

        dispatch(new CreateOrganizationJob($dispatchData));
    }
}
