<div>
    <div class="modal-content">
        <div class="modal-header bg-success">
            <h4 class="modal-title">VIEW DOCUMENT</h4>
        </div>
        @if(!empty($edocs))
        <div class="modal-body">
            <div class="row">
        
                <div class="col-6">
                    <div class="form-group">
                        <h3> {{$edocs->control_number}}</h3>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <h3> {{$edocs->reference_number}}</h3>
                    </div>
                </div>


                <iframe
                    src="{{ asset('/'.$edocs->path) }}"
                    width="100%"
                    height="600px"
                    style="border: none;">
                </iframe>

  
            </div>
        </div>
        @endif
        <div class="modal-footer text-right">
            <button type="button" class="btn btn-default" data-dismiss="modal">Exit</button>
 
        </div>
    </div>
</div>
