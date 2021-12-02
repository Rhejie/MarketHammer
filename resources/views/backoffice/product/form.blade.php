@extends('layouts.backoffice')

@section('header')
	<x-header />
@endsection

@section('sidebar')
	<x-sidebar />
@endsection

@section('content')

    <product-form 
    	:page-data="{{ json_encode($pageData) }}">
	</product-form>
@endsection

@section('footer')
	<x-footer />
@endsection

