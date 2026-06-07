@extends('admin.layout')

@section('title', 'Edit Product')
@section('page-title', 'Edit: ' . $product->name)

@section('content')

<form action="{{ route('admin.products.update', $product) }}" method="POST">
    @method('PATCH')
    @include('admin.products._form')
</form>

@endsection