@extends('layouts.backoffice')

@section('header')
	<x-header />
@endsection

@section('sidebar')
	<x-sidebar />
@endsection

@section('content')
	<?php
		$pageData = new \stdClass();
		$pageData->passwordClient = $passwordClient;

		$pageData = json_encode($pageData);
	?>

	<access-token-list
		:page-data="{{ $pageData }}">
	</access-token-list>
@endsection

@section('footer')
	<x-footer />
@endsection

