@extends('layouts.backoffice')
@section('content')
    <business-type-index :business-type=" {{ json_encode($businessTypes) }} "></business-type-index>
@endsection