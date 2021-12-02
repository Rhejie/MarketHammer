@extends('layouts.app')

@section('content')
	<home img="{{ asset('/image/carousel-item.jpeg') }}" :search-tags=" {{ json_encode($searchTags) }} " ></home>
@endsection
