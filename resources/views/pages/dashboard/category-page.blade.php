@extends('layout.sideNav')

@section('contents')
    @include('componenets.category.listCategory')
    @include('componenets.category.deleteCategory')
    @include('componenets.category.createCategory')
    @include('componenets.category.updateCategory')

@endsection
