@extends('layouts.backoffice')
@section('content')
    <cluster-index :clusters="{{ json_encode($clusters) }}" image-route=" {{ route('category.image-upload') }} "></cluster-index>
@endsection