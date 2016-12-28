<?php

namespace App\Policies;

use App\User;
use App\Company;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Company $company)
    {
        return $user->id === $company->user_id;
    }

    public function delete(User $user, Company $company)
    {
        
    }
}
