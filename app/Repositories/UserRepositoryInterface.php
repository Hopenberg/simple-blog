<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function getAllWithPagination(int $pageLength);
    public function findOrFail(int $id): User;
    public function createUser(array $details): User;
    public function updateUser(int $id, array $newDetails): User;
    public function updateUserWithRememberToken(int $id, array $newDetails): User;
    public function updateRoles(int $id, array $newRoles): User;
    public function delete(int $id);
}