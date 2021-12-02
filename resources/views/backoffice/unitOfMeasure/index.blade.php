@extends('layouts.backoffice')

@section('header')
	<x-header />
@endsection

@section('sidebar')
	<x-sidebar />
@endsection

@section('content')
    <unit-of-measure-list></unit-of-measure-list>
@endsection

@section('footer')
	<x-footer />
@endsection

