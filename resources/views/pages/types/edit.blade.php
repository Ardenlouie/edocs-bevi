@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', __('EDIT TYPE'))
@section('content_header_title', __('TYPES'))
@section('content_header_subtitle', __('Edit Type'))

{{-- Content body: main page content --}}
@section('content_body')
    {{ html()->form('POST', route('type.update', encrypt($type->id)))->open() }}

        <div class="card">
            <div class="card-header py-2">
                <div class="row">
                    <div class="col-lg-6 align-middle">
                        <strong class="text-lg">{{__('Edit Type')}}</strong>
                    </div>
                    <div class="col-lg-6 text-right">
                        <a href="{{route('type.index')}}" class="btn btn-secondary btn-xs">
                            <i class="fa fa-caret-left"></i>
                            {{__('adminlte::utilities.back')}}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            {{ html()->label(__('Prefix'), 'prefix')->class(['mb-0']) }}
                            {{ 
                                html()->text('prefix', $type->prefix)
                                ->class(['form-control', 'form-control-sm', 'is-invalid' => $errors->has('prefix')])
                                ->placeholder(__('Prefix'))
                            }}
                            <small class="text-danger">{{$errors->first('prefix')}}</small>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            {{ html()->label(__('Description'), 'description')->class(['mb-0']) }}
                            {{ 
                                html()->text('description', $type->description)
                                ->class(['form-control', 'form-control-sm', 'is-invalid' => $errors->has('description')])
                                ->placeholder(__('Description'))
                            }}
                            <small class="text-danger">{{$errors->first('description')}}</small>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            {{ html()->label(__('Sequence'), 'sequence')->class(['mb-0']) }}
                            {{ 
                                html()->number('sequence', $type->sequence)
                                ->class(['form-control', 'form-control-sm', 'is-invalid' => $errors->has('sequence')])
                                ->placeholder(__('Sequence Number'))
                            }}
                            <small class="text-danger">{{$errors->first('sequence')}}</small>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            {{ html()->label(__('Record Year'), 'record_year')->class(['mb-0']) }}
                            {{ 
                                html()->text('record_year', $type->record_year)
                                ->class(['form-control', 'form-control-sm', 'is-invalid' => $errors->has('record_year')])
                                ->placeholder(__('Record Year'))
                            }}
                            <small class="text-danger">{{$errors->first('year')}}</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                {{ html()->submit('<i class="fa fa-save"></i> '.__('Update Type'))->class(['btn', 'btn-primary', 'btn-sm']) }}
            </div>
        </div>

    {{ html()->form()->close() }}
@stop

{{-- Push extra CSS --}}
@push('css')
    {{-- Add here extra stylesheets --}}
    <style>
        .user-img {
            height: 30px;
        }
    </style>
@endpush

{{-- Push extra scripts --}}
@push('js')
    <script>

    </script>
@endpush