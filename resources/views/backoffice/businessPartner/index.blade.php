@extends('layouts.backoffice')

@section('header')
	<x-header />
@endsection

@section('sidebar')
	<x-sidebar />
@endsection

@section('content')

    <business-partner-list 
    	:page-data="{{ json_encode($pageData) }}">
	</business-partner-list>
@endsection

@section('footer')
	<x-footer />
@endsection

