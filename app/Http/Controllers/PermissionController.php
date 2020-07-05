<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePermissionRequest;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{

    public function index(){

        return view('admin.permission.index', ['permissions' => Permission::all()]);

    }

    public function store(CreatePermissionRequest $request){

        Permission::create([
            'name' => Str::ucfirst($request->name),
            'slug' => Str::of(Str::lower($request->name))->slug('-')
        ]);

        session()->flash('permission-created', $request->name.' permission has been creaated');

        return redirect()->back();

    }

    public function destroy(Permission $permission){
        $permission->delete();

        session()->flash('permission-delete', $permission->name.' permission has been deleted.');
        return redirect()->back();
    }

}
