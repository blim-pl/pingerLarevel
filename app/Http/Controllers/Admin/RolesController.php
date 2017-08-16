<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use CMS\User\Role\Requests\RoleRequest;
use CMS\User\Role\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = (new Role)->orderBy('title', 'asc')->get();

        return view('user.role.admin.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.role.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \CMS\User\Role\Requests\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $roles = new Role($request->only(['title']));
        $roles->save();

        session()->flash('message', ['content' => __('common.Record has benn saved'), 'type' => 'success']);

        return redirect()->route('admin.roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CMS\User\Role\Models\Role $roles
     * @return \Illuminate\Http\Response
     */
    public function show(Role $roles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CMS\User\Role\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('user.role.admin.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \CMS\User\Role\Requests\RoleRequest  $request
     * @param  \CMS\User\Role\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        dd($role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CMS\User\Role\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
