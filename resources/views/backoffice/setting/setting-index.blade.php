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
		$pageData->certificationTypes = $certificationTypes;
		$pageData->certificationHolders = $certificationHolders;

		$pageData = json_encode($pageData);
	?>

	<app
		:page-data="{{ $pageData }}">
	</app>
@endsection

@section('footer')
	<x-footer />
@endsection

