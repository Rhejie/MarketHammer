@extends('layouts.buyer')

@section('header')
	<x-header />
@endsection

@section('sidebar')
	<x-sidebar_buyer />
@endsection

@section('content')
  	<?php
		$pageData = new \stdClass();
		$pageData->formTemplateStatusList = $formTemplateStatusList;
		$pageData->formFieldGroups = $formFieldGroups;
		$pageData->fieldTypeList = $fieldTypeList;

		$pageData = json_encode($pageData);
	?>

	<app
		:page-data="{{ $pageData }}">
	</app>
@endsection

@section('footer')
	<x-footer />
@endsection
