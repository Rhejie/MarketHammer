@extends('layouts.backoffice')

@section('content')
    <theme-index :themes=" {{ json_encode($themes) }} "></theme-index>
@endsection