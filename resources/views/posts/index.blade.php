@extends('layout')
@section('title', 'Posts')
@section('content')
    <a href="{{route('admin.posts.create')}}" class="btn btn-primary">New Post</a>
    {{$posts->links()}}
        <table class="table table-striped">
            <thead>
                <th>ID</th>
                <th>Title</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td>{{ $post->updated_at }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{route('admin.posts.view', ['post'=> $post->id])}}">View</a>
                            <a class="btn btn-warning" href="{{route('admin.posts.edit', ['post'=> $post->id])}}">Edit</a>
                            <a class="btn btn-danger" href="{{route('admin.posts.destroy', ['post'=> $post->id])}}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    {{$posts->links()}}
@endsection
