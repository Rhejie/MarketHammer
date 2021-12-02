@extends('layouts.app')

@section('content')
	<show-announcement img="{{ asset('/image/carousel-item.jpeg') }}" id="{{ $id }}"></show-announcement>
@endsection
