@extends('layouts.backoffice')

@section('header')
	<x-header />
@endsection

@section('sidebar')
	<x-sidebar.supplier />
@endsection

@section('content')
	<business-machine
		:business=" {{ json_encode($business) }} "
		:page-data=" {{ json_encode($pageData) }} ">
	</business-machine>
@endsection

@section('footer')
	<x-footer />
@endsection
