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
		$pageData->countries = $countries;
		$pageData->addressTypes = $addressTypes;
		$pageData->factoryTypes = $factoryTypes;
		$pageData->industryTypes = $industryTypes;
		$pageData->businessCategories = $businessCategories;
		$pageData->employeeCounts = $employeeCounts;
		$pageData->snsList = $snsList;
		$pageData->certifications = $certifications;
        $pageData->complexLocation = $complexLocation;
        $pageData->complexType = $complexType;
        $pageData->usage_area = $usage_area;
		$pageData = json_encode($pageData);
	?>

	<!-- <business-list-main-component
		:page-data="{{ $pageData }}">
	</business-list-main-component> -->

	<app
		:page-data="{{ $pageData }} ">
	</app>
@endsection

@section('footer')
	<x-footer />
@endsection
