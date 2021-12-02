@extends('layouts.backoffice')

@section('header')
	<x-header />
@endsection

@section('sidebar')
	<x-sidebar />
@endsection

@section('content')
    <certification-holder-index :certification-holder=" {{ json_encode($certificationHolder) }} "></certification-holder-index>
@endsection

@section('footer')
	<x-footer />
@endsection
