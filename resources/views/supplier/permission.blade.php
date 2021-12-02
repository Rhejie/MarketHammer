@extends('layouts.backoffice')

@section('header')
	<x-header />
@endsection

@section('sidebar')
	<x-sidebar.supplier />
@endsection

@section('content')
	<supplier-permission
		:page-data=" {{ json_encode($pageData) }} ">
	</supplier-permission>
@endsection

@section('footer')
	<x-footer />
@endsection
