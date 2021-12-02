@extends('layouts.backoffice')

@section('header')
	<x-header />
@endsection

@section('sidebar')
	<x-sidebar />
@endsection

@section('content')

    <business-contact-list
    	:page-data="{{ json_encode($pageData) }}">
	</business-contact-list>
@endsection

@section('footer')
	<x-footer />
@endsection

