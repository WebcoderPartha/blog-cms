<x-admin-master-layout>

    @section('content')
        <div class="row">

            <div class="col-md-8 mx-auto">
                @if(session('alert'))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success">
                                {{session('alert')}}
                            </div>
                        </div>
                    </div>
                @endif
                <h4>User Profile: </h4>
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Profile information - {{$user->username}}</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('user.profile.update', $user)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <p class="mx-auto">Avatar:</p>
                                @if(!file_exists(asset($user->avatar)))
                                    <img class="img-profile rounded-circle mx-auto" height="100" src="{{asset($user->avatar)}}">
                                @else
                                    <img class="img-profile rounded-circle mx-auto" height="100" src="https://cdn.business2community.com/wp-content/uploads/2017/08/blank-profile-picture-973460_640.png">
                                @endif
                            </div>
                            <div class="form-group row">
                                <label for="avatar" class="col-md-2 mx-auto">Username:</label>
                                <input type="file" name="avatar" id="avatar" class="form-control-file col-md-4 mx-auto @error('avatar') is-invalid @enderror">
                                @error('avatar')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-md-2 mx-auto">Username:</label>
                                <input type="text" name="username" id="username" value="{{$user->username}}" class="form-control col-md-4 mx-auto @error('username') is-invalid @enderror">
                                @error('username')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-2 mx-auto">Name:</label>
                                <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control col-md-4 mx-auto @error('name') is-invalid @enderror">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-2 mx-auto">Email:</label>
                                <input type="email" name="email" id="email" value="{{$user->email}}" class="form-control col-md-4 mx-auto @error('email') is-invalid @enderror">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-2 mx-auto">Password:</label>
                                <input type="password" name="password" id="email" value="" class="form-control col-md-4 mx-auto @error('password') is-invalid @enderror">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="password_confirmation" class="col-md-2 mx-auto">Confirm Password:</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" value="" class="form-control col-md-4 mx-auto @error('password_confirmation') is-invalid @enderror">
                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="text-center"><button class="btn btn-success">Update</button></div>
{{--                            @foreach(count($errors) > 0)--}}
{{--                                @if($errors->all() as $error)--}}
{{--                                    {{$error}}--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-8 mx-auto mt-2">
                <div class="card">
                    <div class="card-header">Roles</div>
                    <div class="card-body">
                         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                              <thead>
                                 <tr>
                                     <th>Options</th>
                                     <th>ID</th>
                                     <th>Name</th>
                                     <th>Slug</th>
                                     <th>Attach</th>
                                     <th>Detach</th>
                                 </tr>
                              </thead>
                              <tfooter>
                                 <tr>
                                     <th>Options</th>
                                     <th>ID</th>
                                     <th>Name</th>
                                     <th>Slug</th>
                                     <th>Attach</th>
                                     <th>Detach</th>
                                 </tr>
                              </tfooter>
                              <tbody>
                              @foreach($roles as $role)
                                 <tr>
                                     <td>
                                         <input
                                             type="checkbox"
                                             @foreach($user->roles as $user_role)
                                                 @if($user_role->slug == $role->slug)
                                                    checked
                                                 @endif
                                             @endforeach
                                         >
                                     </td>
                                     <td>{{$role->id}}</td>
                                     <td>{{$role->name}}</td>
                                     <td>{{$role->slug}}</td>
                                     <td>
                                         <form action="{{route('user.role.attach', $user)}}" method="POST">
                                             @csrf @method('PUT')
                                             <input type="hidden" name="role" value="{{$role->id}}">
                                             <button
                                                 class="btn btn-success"
                                                 @if($user->roles->contains($role))
                                                     disabled
                                                 @endif
                                             >
                                                 Attach
                                             </button>
                                         </form>
                                     </td>
                                     <td>
                                         <form action="{{route('user.role.detach', $user)}}" method="POST">
                                             @csrf @method('PUT')
                                             <input type="hidden" name="role" value="{{$role->id}}">
                                             <button class="btn btn-danger" @if(!$user->roles->contains($role)) disabled @endif>Detach</button>
                                         </form>
                                     </td>
                                 </tr>
                              @endforeach
                              </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>

    @endsection

</x-admin-master-layout>
