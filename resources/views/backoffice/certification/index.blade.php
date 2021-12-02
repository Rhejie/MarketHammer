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
		$pageData->certifications = $certifications;
		$pageData->certificationTypes = $certificationTypes;
		$pageData->certificationHolders = $certificationHolders;
		$pageData = json_encode($pageData);
	?>
    <certification-index :page-data=" {{ $pageData }} ">
    </certification-index>
@endsection

@section('footer')
	<x-footer />
@endsection
