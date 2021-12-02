@extends('layouts.backoffice')

@section('content')

<?php
	$pageData = new \stdClass();
	$pageData->businessList = $businessList;

	$pageData = json_encode($pageData);
?>

<event-index
	:page-data="{{ $pageData }}">
</event-index>

@endsection