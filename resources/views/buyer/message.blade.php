@extends('layouts.buyer')

@section('header')
	<x-header />
@endsection

@section('sidebar')
	<?php
	if(isset($page) && $page == 'supplier') {
		?>
			<x-sidebar.supplier/>
		<?php
	} else {
		?>
			<x-sidebar_buyer/>
		<?php
	}
	?>
@endsection

@section('content')
    <Message-Buyer :user="{{ Auth::user() }}" :page-data="{{ json_encode($pageData) }}"></Message-Buyer>
@endsection

@section('footer')
	<x-footer />
@endsection
