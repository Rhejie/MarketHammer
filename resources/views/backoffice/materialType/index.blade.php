@extends('layouts.backoffice')

@section('header')
	<x-header />
@endsection

@section('sidebar')
	<x-sidebar />
@endsection

@section('content')
    <material-type-index :page-data=" {{ json_encode($pageData) }} "></material-type-index>
@endsection

@section('footer')
	<x-footer />
@endsection
