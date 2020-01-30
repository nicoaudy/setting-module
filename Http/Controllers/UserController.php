<?php

namespace Modules\Setting\Http\Controllers;

use App\User;
use App\Models\Profile;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Modules\Setting\Entities\UserType;
use Modules\Setting\Datatables\UsersDatatable;
use Modules\Setting\Http\Requests\User\CreateRequest;
use Modules\Setting\Http\Requests\User\UpdateRequest;

class UserController extends Controller
{
    public function index(UsersDatatable $datatable)
    {
        $this->hasPermissionTo('view user');
        return $datatable->render('setting::user.index');
    }

    public function create()
    {
        $this->hasPermissionTo('add user');
        return view('setting::user.create', [
            'roles' => Role::get(),
            'types' => UserType::all()
        ]);
    }

    public function store(CreateRequest $request)
    {
        $this->hasPermissionTo('add user');
        $user = User::create([
            'email' => $request->email,
            'username' => $request->username,
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'user_type_id' => $request->user_type_id
        ]);

        Profile::create([
            'user_id' => $user->id,
            'gender' => $request->gender
        ]);

        $roles = $request['roles'];
        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::find($role);
                $user->assignRole($role_r);
            }
        }

        flash('Your data has been created')->success();
        return redirect()->route('setting.users.index');
    }

    public function show($id)
    {
        return view('setting::user.show');
    }

    public function edit($id)
    {
        $this->hasPermissionTo('edit user');
        return view('setting::user.edit', [
            'row' => User::find($id),
            'roles' => Role::get(),
            'types' => UserType::all()
        ]);
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->hasPermissionTo('edit user');
        $user = User::find($id);
        $user->fill([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'user_type_id' => $request->user_type_id
        ]);

        $roles = $request['roles'];
        if (isset($roles)) {
            $user->roles()->sync($roles);
        } else {
            $user->roles()->detach();
        }

        flash('Your data has been updated')->success();
        return redirect()->route('setting.users.index');
    }

    public function destroy($id)
    {
        $this->hasPermissionTo('delete user');
        Profile::whereUserId($id)->delete();
        User::find($id)->delete();

        flash('Your data has been deleted')->error();
        return redirect()->route('setting.users.index');
    }
}
