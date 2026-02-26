@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', __('Edocs Edit'))
@section('content_header_title', __('EDOCS'))
@section('content_header_subtitle', __('Edit'))

{{-- Content body: main page content --}}
@section('content_body')
   <form action="{{ route('bevi.update', encrypt($edoc->id)) }}" method="POST" id="update_edoc" enctype="multipart/form-data">
    @csrf                           

        <div class="card">
            <div class="card-header py-2">
                <div class="row">
                    <div class="col-lg-6 align-middle">
                        <strong class="text-lg">Edit</strong>
                    </div>
                    <div class="col-lg-6 text-right">
                        <a href="{{route('bevi.'.$route)}}" class="btn btn-secondary btn-xs">
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
                    <!-- <div class="col-lg-3">
                        <div class="form-group">
                            {{ html()->label(__('Validity Date'), 'remarks')->class(['mb-0']) }}
                            <input type="date" class="form-control" name="validity_date" form="update_edoc" value="{{$edoc->validity_date}}"> 
                            <small class="text-danger">{{$errors->first('validity_date')}}</small>
                        </div>
                    </div> -->
                    <!-- <div class="col-lg-3">
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
                    </div> -->
                    <div class="col-lg-6">
                        <div class="form-group">
                            {{ html()->label(__('Privacy Setting'), 'confidential')->class(['mb-2 d-block font-weight-bold']) }}

                            <div class="custom-control custom-switch custom-switch-purple">
                                <input type="hidden" name="confidential" value="0">
                                
                                <input 
                                    form="update_edoc"
                                    type="checkbox" 
                                    name="confidential" 
                                    class="custom-control-input {{ $errors->has('confidential') ? 'is-invalid' : '' }}" 
                                    id="confidentialSwitch" 
                                    value="1"
                                    {{ old('confidential', $edoc->confidential) == 1 ? 'checked' : '' }}
                                >
                                
                                <label class="custom-control-label" for="confidentialSwitch">
                                    <span id="switch-text">
                                        {{ old('confidential', $edoc->confidential) == 1 ? __('Yes (Confidential)') : __('No (Public)') }}
                                    </span>
                                </label>
                            </div>

                            @if($errors->has('confidential'))
                                <small class="text-danger d-block mt-2">{{ $errors->first('confidential') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            {{ html()->label(__('File'), 'file_name')->class(['mb-0']) }}
                            <h6>{{$edoc->file_name}}</h6>
                            <!-- <input type="file" class="form-control" name="file_name" form="update_edoc" value="{{$edoc->file_name}}" accept="application/pdf"> -->
                            <input
                                    form="update_edoc"
                                    type="file"
                                    id="file_name"
                                    name="file_name"
                                    accept="application/pdf"
                                    class="form-control {{ $errors->has('file_name') ? 'is-invalid' : '' }}"
                                > 
                            <small class="text-danger">{{$errors->first('file_name')}}</small>
                        </div>
                    </div>
                </div>
                <div class="mt-3" wire:ignore>
                    <b>DOCUMENT PREVIEW:</b>
                    <iframe
                        src="{{ asset('/'.$edoc->path) }}"
                        id="pdfPreview"
                        width="100%"
                        height="400"
                        style="border:1px solid #ccc;"
                    ></iframe>
                </div>

            </div>
            <div class="card-footer text-right">
                {{ html()->submit('<i class="fa fa-save"></i> '.__('Save Edoc'))->class(['btn', 'btn-primary', 'btn-sm']) }}
            </div>
        </div>
    </form>
@stop

{{-- Push extra CSS --}}
@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}

<style>
    /* Change the 'On' color to Purple */
    .custom-switch-purple .custom-control-input:checked ~ .custom-control-label::before {
        background-color: #6f42c1; /* Purple */
        border-color: #6439ac;
    }

    /* Optional: Make the switch larger for better UX */
    .custom-switch {
        padding-left: 2.5rem;
    }

    .custom-switch .custom-control-label::before {
        left: -2.25rem;
        width: 2rem;
        pointer-events: all;
        border-radius: 0.5rem;
    }

    .custom-switch .custom-control-label::after {
        top: calc(0.25rem + 2px);
        left: calc(-2.25rem + 2px);
        width: calc(1rem - 4px);
        height: calc(1rem - 4px);
        background-color: #adb5bd;
        border-radius: 0.5rem;
    }

    .custom-switch .custom-control-input:checked ~ .custom-control-label::after {
        background-color: #fff;
        transform: translateX(1rem);
    }
</style>

@endpush

{{-- Push extra scripts --}}
@push('js')
<script>

    document.getElementById('file_name').addEventListener('change', function () {
        const file = this.files[0];
        const iframe = document.getElementById('pdfPreview');

        if (file && file.type === 'application/pdf') {
            iframe.src = URL.createObjectURL(file);
        } else {
            iframe.src = '';
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('#confidentialSwitch').on('change', function() {
            if ($(this).is(':checked')) {
                $('#switch-text').text('Yes (Confidential)');
            } else {
                $('#switch-text').text('No (Public)');
            }
        });
    });
</script>

@endpush
