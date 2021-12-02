@extends('layouts.backoffice')

@section('header')
	<x-header />
@endsection

@section('sidebar')

    <?php
	if(isset($page) && $page == 'buyer') {
		?>
			<x-sidebar_buyer/>
		<?php
	} else {
		?>
			<x-sidebar />
		<?php
	}
	?>
@endsection

@section('content')
    <?php
	if(isset($page) && $page === 'buyer') {
		?>
			<Home-Buyer :page-data="{{json_encode($user_info)}}"></Home-Buyer>
		<?php
	} else {
		?>
			<div style="background: #fff; height: 700px; display: flex; justify-content: center; align-items: center;">
                <img style="margin: 0 auto;" src="/image/homepage_section_images/coming_soon_img.png"></img>
            </div>
		<?php
	}
	?>
@endsection

@section('footer')
	<x-footer />
@endsection
