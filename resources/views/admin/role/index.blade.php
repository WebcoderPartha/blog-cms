<x-admin-master-layout>


    @section('content')
        <div class="row">
            @if(Session::has('role-message'))
                <div class="alert alert-info">
                    {{session('role-message')}}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-4">
              <div class="card">
                  <div class="card-header">Create Role</div>
                  <div class="card-body">
                      <form method="POST" action="{{route('user.store')}}">
                          @csrf @method('POST')
                          <div class="form-group">
                              <label class="col-form-label" for="name">Name</label>
                              <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Enter role">
                              @error('name')
                              <span class="invalid-feedback">{{$message}}</span>
                              @enderror
                          </div>
                          <button type="submit" class="btn btn-primary">Create</button>
                      </form>
                  </div>
              </div>
            </div>
            <div class="col-md-8">
                @if(Session::has('delete-role'))
                    <div class="alert alert-success">
                        {{session('delete-role')}}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">All roles below</div>
                    <div class="card-body">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{$role->id}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->slug}}</td>
                                    <td>{{$role->created_at}}</td>
                                    <td>{{$role->updated_at}}</td>
                                    <td>
                                        <form method="POST" action="">
                                            @csrf @method('PUT')
                                            <a href="{{route('user.role.edit', $role)}}" class="btn btn-primary">EDIT</a>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{route('user.role.destroy', $role)}}">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger">DELETE</button>
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
