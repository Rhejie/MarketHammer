@extends('layouts.backoffice')

@section('header')
	<x-header />
@endsection

@section('sidebar')
	<x-sidebar />
@endsection

@section('content')
    <role-permission-main-component
    	:page-data="{{ json_encode($pageData) }}"> 
	</role-permission-main-component>
@endsection

@section('footer')
	<x-footer />
@endsection

