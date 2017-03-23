@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Post
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->

                    <!-- New post Form -->
                    <form action="{{ url('post')}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- post Name -->
                        <div class="form-group">
                            <label for="post-name" class="col-sm-3 control-label">Post</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="post-name" class="form-control" value="{{ old('post') }}">
                            </div>


                        </div>

                        <!-- Add post Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Posts -->
            @if (count($posts) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Posts
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped post-table">
                            <thead>
                                <th>Post</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td class="table-text"><div>{{ $post->title }}</div></td>

                                        <!-- post Delete Button -->
                                        <td>
                                            <form action="{{ url('post/'.$post->title) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
