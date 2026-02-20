<div>
    <form action="{{ route('bevi.revise') }}" method="POST" id="revise_edocs" enctype="multipart/form-data">
        @csrf                          
        <div class="modal-content">
            <div class="modal-header bg-purple">
                <h4 class="modal-title">REVISE DOCUMENT</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="control_number">CONTROL NO.:</label>
                            <input type="text" class="form-control" value={{$control_number}} disabled>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="revision_number">REVISION NO.:</label>
                            <input type="text" name="revision_number" value="{{$revision_number}}" form="revise_edocs" class="form-control" disabled>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="company_id">COMPANY:</label>
                            <select name="company_id"
                                id="company_id"
                                class="form-control{{ $errors->has('company_id') ? ' is-invalid' : '' }}"
                                form="revise_edocs"
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
                            <label for="department_id">DEPARTMENT OWNER:</label>
                            <select name="department_id"
                                id="department_id"
                                class="form-control{{ $errors->has('department_id') ? ' is-invalid' : '' }}"
                                form="revise_edocs"
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
                            <label for="reference_number">REFERENCE NO.:</label>
                            <input type="text" name="reference_number" form="revise_edocs" class="form-control">

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="type_id">TYPES:</label>
                            <select name="type_id"
                                id="type_id"
                                class="form-control{{ $errors->has('type_id') ? ' is-invalid' : '' }}"
                                form="revise_edocs"
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
                            <label for="">FILE:</label>
                                <input
                                    form="revise_edocs"
                                    type="file"
                                    id="file_name_revise"
                     
                                    name="file_name"
                                    accept="application/pdf"
                                    class="form-control {{ $errors->has('pdf') ? 'is-invalid' : '' }}"
                                >
                                @error('pdf')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        
                        @error('pdf')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">DATE OF EFFECTIVITY:</label>
                            <input
                                type="date"
                                form="revise_edocs"
                                name="date_effectivity"
                                value="{{ session('date_effectivity') ?? now()->format('Y-m-d') }}"
                                class="form-control {{ $errors->has('date_effectivity') ? ' is-invalid' : '' }}"
                            >
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">TITLE:</label>
                            <input
                                type="text"
                                form="revise_edocs"
                                name="title"
                                class="form-control"
                            >
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="remarks">REMARKS:</label>
                            <input type="text" name="remarks" form="revise_edocs" class="form-control">

                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-sm-12" wire:loading><i class="spinner-border"></i></div>
            

                <!-- PDF Preview -->
                <div class="mt-3" wire:ignore>
                    <b>DOCUMENT PREVIEW:</b>
                    <iframe
                        id="pdfPreviewRevise"
                        width="100%"
                        height="400"
                        style="border:1px solid #ccc;"
                    ></iframe>
                </div>
            </div>

            <input type="hidden" name="company_id" form="revise_edocs" value="{{$company_id}}"> 
            <input type="hidden" name="status" form="revise_edocs" value="active"> 
            <input type="hidden" name="control_number" form="revise_edocs" value="{{$control_number}}"> 
            <input type="hidden" name="department_id" form="revise_edocs" value="{{$department_id}}"> 
            <input type="hidden" name="type_id" form="revise_edocs" value="{{$type_id}}"> 
            <input type="hidden" name="revision_number" form="revise_edocs" value="{{$revision_number}}"> 

            <div class="modal-footer text-right">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn bg-purple" wire:loading.attr="disabled">Upload</button>
            </div>
        </div>
    </form>
    <script>
        document.getElementById('file_name_revise').addEventListener('change', function () {
            const revise_file = this.files[0];
            const revise_iframe = document.getElementById('pdfPreviewRevise');

            if (revise_file && revise_file.type === 'application/pdf') {
                revise_iframe.src = URL.createObjectURL(revise_file);
            } else {
                revise_iframe.src = '';
            }
        });
    </script>
</div>

