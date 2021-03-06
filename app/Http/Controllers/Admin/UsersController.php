<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserRequest;
use CMS\User\Models\User;
use CMS\Role\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class UsersController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = (new User())->paginate(10);
        return view('user.admin.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        if(!$user){
            abort(404);
        }

        $roles = Role::get();
        $userRoles = $user->roles()->pluck('role_id')->all();

        return view('user.admin.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UserRequest  $request
     * @param  \CMS\User\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->only('name', 'email');

        if($password = $request->get('password')){
            $data['password'] = bcrypt($password);
        }

        if($user->update($data)) {
            $user->saveRoles($request->get('roles'));

            flashMessage(__('common.Record has been saved'));
        } else {
            flashMessage(__('common.Save error'), 'danger');
        }

        return redirect()->route('admin.users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if(!$user){
            abort(404);
        }

        $user->delete();

        return redirect()->route('admin.users');
    }
}
