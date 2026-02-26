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
                    
                </div>
            </div>
            
            
            <div class="card-body ">
                <div class="col-lg-4">
                    <div class="form-group">
                        <input type="text" id="search_edocs" class="form-control form-control-xl" placeholder="Search">
                    </div>
                </div>
                <div id="edocs_table_container" class="table-responsive p-0">
                    @include('pages.bigi.partials') 
                </div>
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
<script>
    let debounceTimer;

    document.getElementById('search_edocs').addEventListener('input', function() {
        let searchTerm = this.value;

        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            fetchSearch(searchTerm);
        }, 300); // 300ms delay
    });

    function fetchSearch(query) {
        // Show a loading state if you want
        document.getElementById('edocs_table_container').style.opacity = '0.5';

        fetch(`/home/?search=${query}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById('edocs_table_container').innerHTML = html;
            document.getElementById('edocs_table_container').style.opacity = '1';
        })
        .catch(error => console.warn('Error fetching search:', error));
    }
</script>

@endpush
