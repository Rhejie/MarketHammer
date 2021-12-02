@extends('layouts.backoffice')

@section('header')
	<x-header />
@endsection

@section('sidebar')
	<x-sidebar />
@endsection

@section('content')
    <employee-count-index></employee-count-index>
@endsection

@section('footer')
	<x-footer />
@endsection
