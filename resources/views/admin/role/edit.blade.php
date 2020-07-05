<x-admin-master-layout>

    @section('content')
        <div class="row">
            <div class="col-sm-6 mx-auto">
                @if(session()->has('update-role'))
                    <div class="alert alert-info">
                        {{session('update-role')}}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        Edit Role: {{$role->name}}
                    </div>
                    <div class="card-body">
                        <form action="{{route('user.role.update', $role)}}" method="POST">
                            @csrf @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="{{$role->name}}" id="name" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if($permissions->isNotEmpty())
        <div class="row mt-3">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">Permissions</div>
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
                            <tfoot>
                                <tr>
                                    <th>Options</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <td><input
                                            type="checkbox"
                                            @foreach($role->permissions as $role_permission)
                                                @if($role_permission->slug == $permission->slug)
                                                    checked
                                                @endif
                                            @endforeach
                                        >
                                    </td>
                                    <td>{{$permission->id}}</td>
                                    <td>{{$permission->name}}</td>
                                    <td>{{$permission->slug}}</td>
                                    <td>
                                        <form method="POST" action="{{route('role.permission.attach', $role->id)}}">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="permission" value="{{$permission->id}}">
                                            <button type="submit" class="btn btn-success" @if($role->permissions->contains($permission)) disabled @endif>Attach</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{route('role.permission.detach',$role->id)}}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="permission" value="{{$permission->id}}">
                                            <button type="submit" class="btn btn-danger"  @if(!$role->permissions->contains($permission)) disabled @endif>Detach</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                    </div>
                </div>
        </div>
        @endif
    @endsection


</x-admin-master-layout>
