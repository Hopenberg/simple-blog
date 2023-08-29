<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class UserRepository implements UserRepositoryInterface
{
    public function getAllWithPagination(int $pageLength): LengthAwarePaginator
    {
        return User::paginate($pageLength);
    }

    public function findOrFail(int $id): User
    {
        return User::findOrFail($id);
    }

    public function createUser(array $details): User
    {
        return User::create($details);
    }

    public function updateUser(int $id, array $newDetails): User
    {
        $user = User::findOrFail($id);

        foreach ($newDetails as $key => $value) 
        {
            $user->{$key} = $value;
        }

        $user->save();

        return $user;
    }

    public function updateUserWithRememberToken(int $id, array $newDetails): User
    {
        $user = $this->updateUser($id, $newDetails);

        $user->setRememberToken(Str::random(60));
        
        $user->save();

        return $user;
    }

    public function updateRoles(int $id, array $newRoles): User
    {
        $user = User::findOrFail($id);

        $user->syncRoles($newRoles);

        return $user;
    }

    public function delete(int $id)
    {
        $user = User::findOrFail($id);

        $user->delete();
    }
}