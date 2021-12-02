@extends('layouts.buyer')

@section('header')
	<x-header />
@endsection

@section('sidebar')
	<x-sidebar_buyer />
@endsection

@section('content')
	<!-- <buyer-contact-main
		:page-data=" {{ json_encode($pageData) }} ">
	</buyer-contact-main> -->

	<app
		:page-data="{{ json_encode($pageData) }} ">
	</app>
@endsection

@section('footer')
	<x-footer />
@endsection
