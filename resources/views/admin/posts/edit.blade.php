<x-admin-master-layout>
    @section('content')
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                @if(session('alert'))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success">
                                {{session('alert')}}
                            </div>
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header text-center"><h4>Update a post</h4></div>
                    <div class="card-body">

                        {!! Form::model($post,['method' => 'PATCH', 'action' => ['PostController@update',$post->id], 'files' => true]) !!}
                            {!! Form::label('title', 'Title:', ['class' => 'col-md-3']) !!}
                            {!! Form::text('title', null, ['class' => 'form-control col-md-8', 'placeholder' => 'Enter title']) !!}
                        </div>
                        <div class="form-group row">
                            {!! Form::label('post_image', 'Upload feature photo:', ['class' => 'col-md-3']) !!}
                            {!! Form::file('post_image', ['class' => 'form-control-file col-md-8']) !!}
                        </div>
                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <div class="col-md-8">
                            <img src="{{asset($post->post_image)}}" height="50" alt="">
                        </div>
                    </div>
                        <div class="form-group row">
                            {!! Form::label('content', 'Content:', ['class' => 'col-md-3']) !!}
                            {!! Form::textarea('content', null, ['class' => 'form-control col-md-8', 'placeholder' => 'Enter content']) !!}
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <a href="{{route('post.index')}}" class="btn btn-info">Back</a>
                            </div>
                            <div class="col-md-6">
                                {!! Form::submit('Update',['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    @endsection
</x-admin-master-layout>
