<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\UpdateUserRolesRequest;
use App\Repositories\RoleRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Session;

class AdminPanelUserController extends Controller
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private RoleRepositoryInterface $roleRepository
    )
    {
    }

    public function index()
    {
        return view('admin-panel.users.index', [
            'users' => $this->userRepository->getAllWithPagination(10),
            'status' => Session::get('status')
        ]);
    }

    public function create()
    {
        return view('admin-panel.users.createOrEdit', [
            'user' => new User()
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $this->userRepository->createUser($request->validated());

        return redirect('/admin-panel/users')->with('status', 'User has been created.');
    }

    public function edit(int $id)
    {
        return view('admin-panel.users.createOrEdit', [
            'user' => $this->userRepository->findOrFail($id)
        ]);
    }

    public function editPassword(int $id)
    {
        return view('admin-panel.users.editPassword', [
            'user' => $this->userRepository->findOrFail($id)
        ]);
    }

    public function editRoles(int $id)
    {
        return view('admin-panel.users.editRoles', [
            'user' => $this->userRepository->findOrFail($id),
            'roles' => $this->roleRepository->getAll()
        ]);
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        dd('test');
        $this->userRepository->updateUser($id, $request->safe()->only('name'));

        return redirect('/admin-panel/users')->with('status', 'User was updated.');
    }

    public function updatePassword(UpdateUserPasswordRequest $request, int $id)
    {
        $this->userRepository->updateUser($id, $request->safe()->only('password'));

        return redirect('/admin-panel/users')->with('status', 'Password was updated.');
    }

    public function updateRoles(UpdateUserRolesRequest $request, int $id)
    {
        $this->userRepository->updateRoles($id, $request->validated()['roles'] ?? []);

        return redirect('/admin-panel/users')->with('status', 'Roles were updated.');
    }

    public function destroy(int $id)
    {
        $this->userRepository->delete($id);

        return redirect('/admin-panel/users')->with('status', 'User was deleted.');
    }
}
