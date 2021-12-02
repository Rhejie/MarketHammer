
@extends('layouts.backoffice')

@section('header')
	<x-header />
@endsection

@section('sidebar')
	<x-sidebar />
@endsection

@section('content')

    <!-- <product-list 
    	:page-data="{{ json_encode($pageData) }}">
	</product-list> -->
	<product-list-main-component 
    	:page-data="{{ json_encode($pageData) }}">
	</product-list-main-component>
@endsection

@section('footer')
	<x-footer />
@endsection

