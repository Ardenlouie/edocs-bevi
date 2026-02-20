@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', __('EDOCS List'))
@section('content_header_title', __('SCM'))
@section('content_header_subtitle', __('EDOCS List'))

{{-- Content body: main page content --}}
@section('content_body')

    <livewire:departments.scm />



<div class="modal fade" id="modal-upload">
    <div class="modal-dialog modal-lg">
        <livewire:upload-document />
    </div>
</div>


@endsection   


@section('js')

<script>
    $(function() {
        $('body').on('click', '.btn-upload', function(e) {
            e.preventDefault();
            let data = {
                id: $(this).data('id'),
                department: $(this).data('department'),
            };
            Livewire.dispatch('setUploadEdocs', { data });
            $('#modal-upload').modal('show');
        });
    });
</script>

<script>
    $(function() {
        $('body').on('click', '.btn-revise', function(e) {
            e.preventDefault();
            let data = {
                id: $(this).data('id'),
                department: $(this).data('department'),
                type: $(this).data('type'),
            };
            Livewire.dispatch('setReviseEdocs', { data });
            $('#modal-revise').modal('show');
        });
    });
</script>

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

<script>
    $(function() {
        $('body').on('click', '.btn-delete', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            Livewire.dispatch('setDeleteModel', {type: 'Edoc', model_id: id});
            $('#modal-delete').modal('show');
        });
    });
</script>

@endsection