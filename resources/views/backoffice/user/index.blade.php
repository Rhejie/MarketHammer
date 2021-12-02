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
		$pageData->userTypes = $userTypes;
        // $pageData->suppliers = $suppliers;
		$pageData = json_encode($pageData);
	?>

	<users-list
		:page-data="{{ $pageData }}">
	</users-list>
@endsection

@section('footer')
	<x-footer />
@endsection
