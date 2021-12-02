@extends('layouts.backoffice')

@section('header')
	<x-header />
@endsection

@section('sidebar')
	<x-sidebar.supplier />
@endsection

@section('content')
	<app
		:page-data="{{ json_encode($pageData) }} ">
	</app>
@endsection

@section('footer')
	<x-footer />
@endsection
