@extends('layouts.buyer')

@section('header')
	<x-header />
@endsection

@section('sidebar')
	<x-sidebar_buyer/>
@endsection

@section('content')
    <?php
        $pageData = new \stdClass();
        $pageData->form_types = $form_types;
        $pageData->form_status = $form_status;
        $pageData->form_field_groups = $form_field_groups;
        $pageData->formTemplateStatusList = $formTemplateStatusList;
        $pageData->fieldTypeList = $fieldTypeList;
        $pageData->optionReferenceList = $optionReferenceList;
        $pageData = json_encode($pageData);
    ?>
    <List-Index :pagedata="{{ $pageData }}"></List-Index>
@endsection

@section('footer')
	<x-footer />
@endsection
