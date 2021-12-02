@extends('layouts.app')

@section('content')
	<my-page img="{{ asset('/image/carousel-item.jpeg') }}" :loggedinuser="{{ $loggedinuser }}" :storage-route="{{ json_encode(asset('')) }}"></my-page>
@endsection
