@extends('admin.layouts.app')

@section('title', "Edição de Post: {$post->title}")

@section('content')

<h1 class="text-center text-3x1 uppercase font-black my-4">Editar o Posts <strong>{{ $post->title }}</strong></h1>

@if (session('message'))
    <div>
        {{ session('message') }}
    </div>
@endif

<div class="w-11/12 p-12 bg-white sm:w-8/12 md:w-1/2 lg:w-5/12 mx-auto">
    <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('admin.posts.partials.form')
    </form>
</div>

@endsection