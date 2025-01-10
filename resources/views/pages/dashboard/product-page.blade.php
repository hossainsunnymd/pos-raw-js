@extends('layout.sideNav')

@section('contents')
@include('componenets.product.listProduct');
@include('componenets.product.createProduct');
@include('componenets.product.deleteProduct');
@include('componenets.product.updateProduct');
@endsection
