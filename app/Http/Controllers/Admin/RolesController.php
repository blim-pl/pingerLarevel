<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use CMS\Role\Requests\RoleRequest;
use CMS\Role\Models\Role;

class RolesController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = (new Role)->orderBy('title', 'asc')->get();

        return view('role.admin.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \CMS\Role\Requests\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $roles = new Role($request->only(['title', 'access']));
        $roles->save();

        flashMessage(__('common.Record has been saved'));

        return redirect()->route('admin.roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CMS\Role\Models\Role $roles
     * @return \Illuminate\Http\Response
     */
    public function show(Role $roles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CMS\Role\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('role.admin.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \CMS\Role\Requests\RoleRequest  $request
     * @param  \CMS\Role\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->only('title', 'access'));

        flashMessage(__('common.Record has been saved'));

        return redirect()->route('admin.roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CMS\Role\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        flashMessage( __('common.Item has been deleted'));

        return redirect()->route('admin.roles');
    }
}
