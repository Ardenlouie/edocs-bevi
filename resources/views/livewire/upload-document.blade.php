<div>
    <form action="{{ route('bevi.store') }}" method="POST" id="add_edocs" enctype="multipart/form-data">
        @csrf                          
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">UPLOAD DOCUMENT</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>CONTROL NO.:</label>
                            <input type="text" class="form-control" value={{$control_number}} disabled>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>REVISION NO.:</label>
                            <input type="text" name="revision_number" value="{{$revision_number}}" form="add_edocs" class="form-control" disabled>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>COMPANY: <small class="text-danger font-italic text-bold">(required)</small></label>
                            <select name="company_id"
                                id="company_id"
                                class="form-control{{ $errors->has('company_id') ? ' is-invalid' : '' }}"
                                form="add_edocs"
                                wire:model.lazy="company_id"
                            >
                                @foreach ($companies as $key => $value)
                                    <option value="{{ $key }}" {{ old('company_id') == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>DEPARTMENT OWNER:</label>
                            <select name="department_id"
                                id="department_id"
                                class="form-control{{ $errors->has('department_id') ? ' is-invalid' : '' }}"
                                form="add_edocs"
                                wire:model.lazy="department_id"
                                disabled
                            >
                                @foreach ($departments as $key => $value)
                                    <option value="{{ $key }}" {{ old('department_id') == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="reference_number">REFERENCE NO.: <small class=" font-italic text-bold">(optional)</small></label>
                            <input type="text" name="reference_number" form="add_edocs" class="form-control">

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>TYPES:</label>
                            <select name="type_id"
                                id="type_id"
                                class="form-control{{ $errors->has('type_id') ? ' is-invalid' : '' }}"
                                form="add_edocs"
                                wire:model.lazy="type_id"
                                disabled
                            >
                                <option value="" disabled>-- Select Type --</option>

                                @foreach ($types as $key => $value)
                                    <option value="{{ $key }}" {{ old('type_id') == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>FILE: <small class="text-danger font-italic text-bold">(required)</small></label>
                                <input
                                    form="add_edocs"
                                    type="file"
                                    id="file_name"
                                    name="file_name"
                                    accept="application/pdf"
                                    class="form-control {{ $errors->has('file_name') ? 'is-invalid' : '' }}"
                                >
                                @error('file_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        
                        @error('file_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>DATE OF EFFECTIVITY: <small class="text-danger font-italic text-bold">(required)</small></label>
                            <input
                                type="date"
                                form="add_edocs"
                                name="date_effectivity"
                                value="{{ session('date_effectivity') ?? now()->format('Y-m-d') }}"
                                class="form-control {{ $errors->has('date_effectivity') ? ' is-invalid' : '' }}"
                            >
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>TITLE: <small class="text-danger font-italic text-bold">(required)</small></label>
                            <input
                                type="text"
                                form="add_edocs"
                                name="title"
                                class="form-control"
                                wire:model.live="title"
                            >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="font-weight-bold d-block">{{ __('PRIVACY SETTING: ') }} <small class="text-danger font-italic text-bold">(required)</small></label>
                            
                            <div class="custom-control custom-switch custom-switch-purple">
                                <input 
                                    type="checkbox" 
                                    wire:model.lazy="confidential" 
                                    class="custom-control-input" 
                                    id="newDocConfidential"
                                >
                                <label class="custom-control-label" for="newDocConfidential">
                                    @if($confidential)
                                        <span class="text-red font-weight-bold"><i class="fas fa-lock"></i> {{ __('CONFIDENTIAL') }}</span>
                                    @else
                                        <span class="text-muted">{{ __('Public (Visible to all)') }}</span>
                                    @endif
                                </label>
                            </div>
                            
                            <small class="form-text text-muted">
                                {{ $confidential 
                                    ? 'Only users with '.$department_prefix.' Access will be able to view this file.' 
                                    : 'This document will be viewable and searchable by all edocs users.' }}
                            </small>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>REMARKS: <small class=" font-italic text-bold">(optional)</small></label>
                            <input type="text" name="remarks" form="add_edocs" class="form-control">

                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-sm-12" wire:loading><i class="spinner-border"></i></div>
            

            <!-- PDF Preview -->
            <div class="mt-3" wire:ignore>
                <b>DOCUMENT PREVIEW:</b>
                <iframe
                    id="pdfPreview"
                    width="100%"
                    height="400"
                    style="border:1px solid #ccc;"
                ></iframe>
            </div>

            @if (session()->has('success'))
                <div class="alert alert-success mt-2">
                    {{ session('success') }}
                </div>
            @endif
            <input type="hidden" name="company_id" form="add_edocs" value="{{$company_id}}"> 
            <input type="hidden" name="confidential" form="add_edocs" value="{{$confidential}}"> 
            <input type="hidden" name="status" form="add_edocs" value="active"> 
            <input type="hidden" name="control_number" form="add_edocs" value="{{$control_number}}"> 
            <input type="hidden" name="department_id" form="add_edocs" value="{{$department_id}}"> 
            <input type="hidden" name="type_id" form="add_edocs" value="{{$type_id}}"> 
            <input type="hidden" name="revision_number" form="add_edocs" value="{{$revision_number}}"> 

            <div class="modal-footer text-right">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" {{ empty($title)  ? 'disabled' : '' }} >Upload</button>
            </div>
        </div>
    </form>
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
</div>
