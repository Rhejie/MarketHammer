@extends('layouts.backoffice')

@section('content')


<business-claim-index
	:business-claims="{{ json_encode($businessClaims) }}">
</business-claim-index>

@endsection