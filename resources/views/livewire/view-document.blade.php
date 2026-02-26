<div>
    <div class="modal-content">
        <div class="modal-header bg-success">
            <h4 class="modal-title">VIEW DOCUMENT</h4>
        </div>
        @if(!empty($edocs))
        <div class="modal-body">
            <div class="row">
        
                <div class="col-4">
                    <div class="form-group">
                        <h3> {{($edocs->control_number ?? '')}}</h3>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <h3> {{($edocs->title ?? '')}}</h3>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>
                            @if($edocs->confidential)
                                <span class="text-red font-weight-bold"><i class="fas fa-lock"></i> {{ __('CONFIDENTIAL') }}</span>
                            @else
                                <span class="text-muted">{{ __('Public (Visible to all)') }}</span>
                            @endif
                        </label>
                        <small class="form-text text-muted">
                            {{ $edocs->confidential 
                                ? 'Only users with '.$department_prefix.' Access will be able to view this file.' 
                                : 'This document will be viewable and searchable by all edocs users.' }}
                        </small>
                    </div>
                   
                </div>
                


                <iframe
                    src="{{ asset('/'.$edocs->path) }}"
                    width="100%"
                    height="600px"
                    style="border: none;">
                </iframe>

                <div class="col-6">
                    <div class="form-group">
                        <h3>Department Owner:</h3>
                        <h3>{{($edocs->department->name ?? '')}}</h3>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group float-right">
                        <h3>Created By:</h3>
                        <h3>{{($edocs->user->name ?? '')}}</h3>
                    </div>
                </div>

  
            </div>
        </div>
        @endif
        <div class="modal-footer text-right">
            <button type="button" class="btn btn-default" data-dismiss="modal">Exit</button>
 
        </div>
    </div>
</div>
