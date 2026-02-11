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
        <div class="info-box">
            <span class="info-box-icon bg-gradient-dark elevation-1"><i class="fas fa-pen"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">FORMS</span>
                <span class="info-box-number">{{$forms}}</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4 ">
        <div class="info-box">
            <span class="info-box-icon bg-gradient-dark elevation-1"><i class="fas fa-file-contract"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">CONTRACT</span>
                <span class="info-box-number">{{$contract}}</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4 ">
        <div class="info-box">
            <span class="info-box-icon bg-gradient-dark elevation-1"><i class="fas fa-briefcase"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">STANDARD OPERATING PROCEDURE</span>
                <span class="info-box-number">{{$sop}}</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4 ">
        <div class="info-box">
            <span class="info-box-icon bg-gradient-dark elevation-1"><i class="fas fa-gavel"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">POLICY</span>
                <span class="info-box-number">{{$policy}}</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4 ">
        <div class="info-box">
            <span class="info-box-icon bg-gradient-dark elevation-1"><i class="fas fa-laptop"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">WORK INSTRUCTIONS</span>
                <span class="info-box-number">{{$work_instructions}}</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4 ">
        <div class="info-box">
            <span class="info-box-icon bg-gradient-dark elevation-1"><i class="fas fa-layer-group"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">OTHERS</span>
                <span class="info-box-number">{{$others}}</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-12">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Recent Uploads</h3>
                <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                </a>
                <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th>Company</th>
                            <th>Control No.</th>
                            <th>Title</th>
                            <th>Document Type</th>
                            <th>Department</th>
                            <th>Uploaded By</th>
                            <th>Upload Date</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($active_edocs as $edoc)
                        <tr>
                            <td>{{($edoc->company->name ?? '')}}</td>
                            <td>{{($edoc->control_number ?? '')}}</td>
                            <td>{{($edoc->title ?? '')}}</td>
                            <td>{{($edoc->type->description ?? '')}}</td>
                            <td>{{$edoc->department->name}}</td>
                            <td>{{($edoc->user->name ?? '')}}</td>
                            <td>{{\Carbon\Carbon::parse($edoc->created_at)->format('M d, Y')}}</td>
                            <td>
                                @if($edoc->status == null)
                                    <span class="badge badge-danger">PENDING</span>
                                @elseif($edoc->status == 'active')
                                    <span class="badge badge-success">ACTIVE</span>
                                @elseif($edoc->status == 'revised')
                                    <span class="badge badge-danger">REVISED</span>
                                @else
                                @endif
                            </td>
                            <td>
                                @can('edoc access')
                                    <a href="#" title="view" data-id="{{$edoc->id}}" class="btn-view btn ">
                                        <i class="fa fa-eye text-success"></i>
                                    </a>
                                @endcan
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="modal fade" id="modal-view">
                    <div class="modal-dialog modal-xl">
                        <livewire:view-document />
                    </div>
                </div>
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
<script>
    $(function() {
        $('body').on('click', '.btn-view', function(e) {
            e.preventDefault();
            let data = {
                id: $(this).data('id'),
            };
            Livewire.dispatch('setViewEdocs', {data});
            $('#modal-view').modal('show');
        });
    });
</script>
@endpush
