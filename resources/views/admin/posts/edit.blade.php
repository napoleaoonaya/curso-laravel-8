@extends('admin.layouts.app')

@section('title', "Edição de Post: {$post->title}")

@section('content')

<h1>Editar o Posts <strong>{{ $post->title }}</strong></h1>

@if (session('message'))
    <div>
        {{ session('message') }}
    </div>
@endif

<form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    @include('admin.posts.partials.form')
</form>


@endsection