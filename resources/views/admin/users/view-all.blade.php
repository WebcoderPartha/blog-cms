<x-admin-master-layout>


    @section('content')
        <h2>Users</h2>
        @if(session('user-deleted'))

            <div class="alert alert-success">
                {{session('user-deleted')}}
            </div>

        @endif

        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Name</th>
                <th>Email</th>
                <th>Avatar</th>
                <th>Register At</th>
                <th>Update At</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>

            @foreach($users as $user)

            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td><img src="{{asset($user->avatar)}}" alt="" height="60px"></td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->updated_at->diffForHumans()}}</td>
                <td>
                    <form action="{{route('users.delete',$user)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

            @endforeach
            </tbody>


        </table>

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
