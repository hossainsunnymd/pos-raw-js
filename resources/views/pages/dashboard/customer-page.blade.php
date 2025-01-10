@extends('layout.sideNav')

@section('contents')
@include('componenets.customer.listCustomer')
@include('componenets.customer.deleteCustomer')
@include('componenets.customer.createCustomer')
@include('componenets.customer.updateCustomer')
@endsection
