<?php

namespace Modules\Setting\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Setting\Entities\UserType;
use Modules\Setting\Datatables\UserTypeDatatable;
use Modules\Setting\Http\Requests\UserType\CreateRequest;

class UserTypeController extends Controller
{
    public function index(UserTypeDatatable $datatable)
    {
        $this->hasPermissionTo('view user type');
        return $datatable->render('setting::user-type.index');
    }

    public function create()
    {
        $this->hasPermissionTo('add user type');
        return view('setting::user-type.create');
    }

    public function store(CreateRequest $request)
    {
        $this->hasPermissionTo('add user type');
        UserType::create($request->all());

        flash('Your data has been created')->success();
        return redirect()->route('setting.user-type.index');
    }

    public function show($id)
    {
        return view('setting::user-type.show');
    }

    public function edit($id)
    {
        $this->hasPermissionTo('edit user type');
        $row = UserType::find($id);
        return view('setting::user-type.edit', [
            'row' => $row
        ]);
    }

    public function update(CreateRequest $request, $id)
    {
        $this->hasPermissionTo('edit user type');
        UserType::find($id)->update($request->all());
        flash('Your data has been updated')->success();
        return redirect()->route('setting.user-type.index');
    }

    public function destroy($id)
    {
        $this->hasPermissionTo('delete user type');
        UserType::find($id)->delete();
        flash('Your data has been deleted')->error();
        return redirect()->route('setting.user-type.index');
    }
}
