@extends('layouts.backoffice')

@section('header')
	<x-header />
@endsection

@section('sidebar')
	<x-sidebar.supplier />
@endsection

@section('content')
    <supplier-main-component
    	:business=" {{ json_encode($business) }} "
    	:page-data=" {{ json_encode($pageData) }} ">

    </supplier-main-component>
@endsection

@section('footer')
	<x-footer />
@endsection
