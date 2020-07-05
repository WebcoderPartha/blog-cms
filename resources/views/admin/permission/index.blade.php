<x-admin-master-layout>
    @section('content')
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    @if(session()->has('permission-created'))
                        <div class="alert alert-success">{{session('permission-created')}}</div>
                    @endif
                </div>
                <div class="card">
                    <div class="card-header">Create Permission</div>
                    <div class="card-body">
                        <form action="{{route('user.permission.store')}}" method="POST">
                            @csrf @method('POST')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter permission name">
                                @error('name')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success">Create</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="row">
                    @if(session()->has('permission-delete'))
                        <div class="alert alert-success">
                            {{session('permission-delete')}}
                        </div>
                    @endif
                </div>
                 <div class="card">
                     <div class="card-header">All permissions below</div>
                     <div class="card-body">
                         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                             <thead>
                                 <tr>
                                     <th>ID</th>
                                     <th>Name</th>
                                     <th>Slug</th>
                                     <th>Edit</th>
                                     <th>Delete</th>
                                 </tr>
                             </thead>
                             <tfoot>
                                 <tr>
                                     <th>ID</th>
                                     <th>Name</th>
                                     <th>Slug</th>
                                     <th>Edit</th>
                                     <th>Delete</th>
                                 </tr>
                             </tfoot>
                             <tbody>
                             @foreach($permissions as $permission)
                                 <tr>
                                     <td>{{$permission->id}}</td>
                                     <td>{{$permission->name}}</td>
                                     <td>{{$permission->slug}}</td>
                                     <td>
                                         <form action="">
                                             @csrf @method('PUT')
                                             <button type="submit" class="btn btn-success">Edit</button>
                                         </form>
                                     </td>
                                     <td>
                                         <form action="{{route('user.permission.destory', $permission)}}" method="POST">
                                             @csrf @method('DELETE')
                                             <button type="submit" class="btn btn-danger">Delete</button>
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
