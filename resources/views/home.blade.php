@extends('layouts.app')


@section('content_header')
<div class="row">
    <div class="col-md-6">
        <h1></h1>
    </div>

</div>
@endsection

@section('content_body')
<div class="row">
    <div class="col-12 col-sm-6 col-md-4 ">
        <div class="info-box bg-gradient-info">
            <span class="info-box-icon bg-gradient-info elevation-1"><i class="fas fa-pen"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">FORMS</span>
                <span class="info-box-number">{{$forms}}</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4 ">
        <div class="info-box bg-gradient-red">
            <span class="info-box-icon bg-gradient-red elevation-1"><i class="fas fa-file-contract"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">CONTRACT</span>
                <span class="info-box-number">{{$contract}}</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4 ">
        <div class="info-box bg-gradient-green">
            <span class="info-box-icon bg-gradient-green elevation-1"><i class="fas fa-briefcase"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">STANDARD OPERATING PROCEDURE</span>
                <span class="info-box-number">{{$sop}}</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4 ">
        <div class="info-box bg-gradient-navy">
            <span class="info-box-icon bg-gradient-navy elevation-1"><i class="fas fa-gavel"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">POLICY</span>
                <span class="info-box-number">{{$policy}}</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4 ">
        <div class="info-box bg-gradient-blue">
            <span class="info-box-icon bg-gradient-blue elevation-1"><i class="fas fa-laptop"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">WORK INSTRUCTIONS</span>
                <span class="info-box-number">{{$work_instructions}}</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4 ">
        <div class="info-box bg-gradient-purple">
            <span class="info-box-icon bg-gradient-purple elevation-1"><i class="fas fa-layer-group"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">OTHERS</span>
                <span class="info-box-number">{{$others}}</span>
            </div>
        </div>
    </div>
</div>

@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
@endpush
