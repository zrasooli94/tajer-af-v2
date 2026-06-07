@extends('admin.layout')

@section('title', 'Add Product')
@section('page-title', 'Add New Product')

@section('content')

<form action="{{ route('admin.products.store') }}" method="POST">
    @include('admin.products._form')
</form>

@endsection