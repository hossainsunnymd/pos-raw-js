@extends('layout.sideNav')

@section('contents')
    @include('componenets.invoice.list-Invoice')
    @include('componenets.invoice.invoice-details')
    @include('componenets.invoice.delete-invoice')
@endsection
