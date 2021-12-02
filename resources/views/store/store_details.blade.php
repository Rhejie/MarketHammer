@extends('layouts.app')

@section('content')
	<store-details img="{{ asset('/image/carousel-item.jpeg') }}" :business-data="{{ json_encode($businessData) }}" :storage-route="{{ json_encode(asset('/')) }}"></store-details>
@endsection
