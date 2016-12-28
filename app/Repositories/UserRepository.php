<?php

namespace App\Repositories;

use Rinvex\Repository\Repositories\EloquentRepository;

class UserRepository extends EloquentRepository
{
    protected $repositoryId = 'rinvex.repository.user';
    protected $model = 'App\User';
}