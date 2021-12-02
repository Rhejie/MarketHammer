@extends('layouts.backoffice')

@section('content')

<business-view :business-data="{{ json_encode($businessData) }}" :page-data="{{ json_encode($pageData) }}"></business-view>

@endsection
