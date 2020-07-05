<x-admin-master-layout>

    @section('content')
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                @if(session('alert'))
                    <div class="alert alert-success">
                        {{session('alert')}}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Owner</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Create At</th>
                            <th>Update At</th>
                            <th>Edit</th>
                            <th>View</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Owner</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Create At</th>
                            <th>Update At</th>
                            <th>Edit</th>
                            <th>View</th>
                            <th>Delete</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->user->name}}</td>
                            <td>{{$post->title}}</td>
                            <td><img src="{{asset($post->post_image)}}" alt="" height="50"></td>
                            <td>{{$post->created_at->diffForHumans()}}</td>
                            <td>{{$post->updated_at->diffForHumans()}}</td>
                            <td>
                                @can('view', $post)
                                <a href="{{route('post.edit', $post->id)}}" class="btn btn-success">Edit</a>
                                @endcan
                            </td>
                            <td><a href="{{route('post.show',$post->id)}}" class="btn btn-primary">View</a></td>
                            <td>
                                @can('delete', $post)
                                <form method="POST" action="{{route('post.delete', $post->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger text-white">Delete</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                   <div class="d-flex">
                       <div class="mx-auto">
                           {{$posts->links()}}
                       </div>
                   </div>
                </div>
            </div>
        </div>


    @endsection

    @section('scripts')
            <!-- Core plugin JavaScript-->
            <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
            <!-- Custom scripts for all pages-->
            <script src="{{asset('js/sb-admin-2.js')}}"></script>
            <!-- Page level custom scripts -->
            <script src="{{asset('js/datatables-demo.js')}}"></script>
        @endsection
</x-admin-master-layout>
