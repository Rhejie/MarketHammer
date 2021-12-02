@extends('layouts.backoffice')

@section('header')
	<x-header />
@endsection

@section('sidebar')
	<x-sidebar.supplier />
@endsection

@section('content')
	<business-certifications
		:business=" {{ json_encode($business) }} "
		:page-data=" {{ json_encode($pageData) }} "
	>
	</business-certifications>
@endsection

@section('footer')
	<x-footer />
@endsection
