@extends('admin.layouts.app')

@section('title', 'Cadastro de Posts')

@section('content')

<h1>Cadastrar Novo Posts</h1>

<!-- enctype="multipart/form-data" se não colocar não habilita o upload -->
<form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
    @include('admin.posts.partials.form')
</form>

@endsection