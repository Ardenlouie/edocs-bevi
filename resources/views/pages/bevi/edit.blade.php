@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', __('Edocs Edit'))
@section('content_header_title', __('EDOCS'))
@section('content_header_subtitle', __('Edit'))

{{-- Content body: main page content --}}
@section('content_body')
    {{ html()->form('POST', route('bevi.update', encrypt($edoc->id)))->open() }}
        <div class="card">
            <div class="card-header py-2">
                <div class="row">
                    <div class="col-lg-6 align-middle">
                        <strong class="text-lg">Edit</strong>
                    </div>
                    <div class="col-lg-6 text-right">
                        <a href="{{route('home')}}" class="btn btn-secondary btn-xs">
                            <i class="fa fa-caret-left"></i>
                            {{__('adminlte::utilities.back')}}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            {{ html()->label(__('Control No.'), 'control_number')->class(['mb-0']) }}
                            <h3>{{$edoc->control_number}}</h3>
                            <input type="hidden" name="control_number" form="update_edoc" value="{{$edoc->control_number}}"> 
                            <small class="text-danger">{{$errors->first('control_number')}}</small>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            {{ html()->label(__('Reference No.'), 'reference_number')->class(['mb-0']) }}
                            <input type="text" class="form-control" name="reference_number" form="update_edoc" value="{{$edoc->reference_number}}"> 
                            <small class="text-danger">{{$errors->first('reference_number')}}</small>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            {{ html()->label(__('Title'), 'title')->class(['mb-0']) }}
                            <input type="text" class="form-control" name="title" form="update_edoc" value="{{$edoc->title}}"> 
                            <small class="text-danger">{{$errors->first('title')}}</small>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            {{ html()->label(__('Remarks'), 'remarks')->class(['mb-0']) }}
                            <input type="text" class="form-control" name="remarks" form="update_edoc" value="{{$edoc->remarks}}"> 
                            <small class="text-danger">{{$errors->first('remarks')}}</small>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            {{ html()->label(__('Company'), 'company_id')->class(['mb-0']) }}
                            <select name="company_id"
                                    form="update_edoc"
                                    class="form-control{{ $errors->has('company_id') ? ' is-invalid' : '' }}">
                                @foreach($companies as $key => $value)
                                    <option value="{{ $key }}" {{ $key == $edoc->company_id ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            {{ html()->label(__('Date Effectivity'), 'remarks')->class(['mb-0']) }}
                            <input type="date" class="form-control" name="date_effectivity" form="update_edoc" value="{{$effectivityDate}}"> 
                            <small class="text-danger">{{$errors->first('date_effectivity')}}</small>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            {{ html()->label(__('Validity Date'), 'remarks')->class(['mb-0']) }}
                            <input type="date" class="form-control" name="validity_date" form="update_edoc" value="{{$edoc->validity_date}}"> 
                            <small class="text-danger">{{$errors->first('validity_date')}}</small>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            {{ html()->label(__('Status'), 'status')->class(['mb-0']) }}
                            <select name="status"
                                    form="update_edoc"
                                    class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}">
                                @foreach($status_arr as $key => $value)
                                    <option value="{{ $key }}" {{ $key == $edoc->status ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


        


                </div>


            </div>
            <div class="card-footer text-right">
                {{ html()->submit('<i class="fa fa-save"></i> '.__('Save Edoc'))->class(['btn', 'btn-primary', 'btn-sm']) }}
            </div>
        </div>
    {{ html()->form()->close() }}
@stop

{{-- Push extra CSS --}}
@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}
@push('js')

@endpush
