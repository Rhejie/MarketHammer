@extends('layouts.buyer')

@section('header')
	<x-header />
@endsection

@section('sidebar')
	<x-sidebar_buyer/>
@endsection

@section('content')

    <Home-Buyer :page-data="{{json_encode($user_info)}}"></Home-Buyer>
@endsection

@section('footer')
	<x-footer />
@endsection
