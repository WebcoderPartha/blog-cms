<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use foo\bar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin/users/view-all', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show(User $user)
    {
        return view('admin.users.profile', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.profile', ['user' => $user, 'roles' => Role::all()]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $input = $request->validate([
            'username' => ['required', 'string', 'max:255', 'alpha_dash'],
            'avatar' => ['file'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255']
        ]);

        if ($request->file('avatar')){
            $input['avatar'] = $request->file('avatar')->store('profile/avatar');
        }

        Auth::user()->where('id',$user->id)->update($input);
        session()->flash('alert', 'Profile has been updated.');
        return redirect()->back();

    }

    public function attach(Request $request, User $user){

        $user->roles()->attach($request->role);
        return redirect()->back();

    }

    public function detach(Request $request, User $user){

        $user->roles()->detach($request->role);
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        $username = $user->username;

        User::whereId($user->id)->delete();
        session()->flash('user-deleted', $username.' as been deleted');

        return redirect()->back();

    }





}
