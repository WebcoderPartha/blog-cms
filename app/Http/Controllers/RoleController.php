<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index(){


        return view('admin.role.index', ['roles' => Role::all()]);

    }

    public function store(CreateRoleRequest $request){

        Role::create([
            'name' => ucfirst($request->name),
            'slug' => Str::of(Str::lower($request->name))->slug('-')
        ]);

            session()->flash('role-message', $request->name.' role has been created');

        return redirect()->back();
    }

    public function edit(Role $role){

        return view('admin.role.edit', [
            'role' => $role,
            'permissions' => Permission::all()
        ]);
    }

    public function update(UpdateRoleRequest $request, Role $role){

        $role->name = ucfirst($request->name);
        $role->slug = Str::of(Str::lower($request->name))->slug('-');

        if ($role->isDirty('name')){
            session()->flash('update-role', $request->name.' role updated.');
            $role->save();
        }else{
            session()->flash('update-role', 'Nothing role updated');
        }
        return redirect()->back();

    }


    public function destroy(Role $role){

        $role->delete();

        session()->flash('delete-role', $role->name.' has been deleted.');

        return redirect()->back();
    }

    public function attach(Request $request,Role $role){
        $role->permissions()->attach($request->permission);
        return redirect()->back();
    }

    public function detach(Request $request, Role $role){
        $role->permissions()->detach($request->permission);
        return redirect()->back();
    }


}
