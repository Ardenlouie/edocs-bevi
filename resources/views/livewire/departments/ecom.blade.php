<div>
    <div class="card">
        <div class="card-header py-2">
            <div class="row ">
                <div class="col-lg-12 ">
                    <ul class="nav nav-tabs ">
                        @foreach($types as $key => $type)
                        <li class="nav-item text-center">
                            <a class="btn nav-link {{ $activeTab === 'tab'.$key ? 'active' : '' }}" wire:click="changeTab('tab{{$key}}','{{$key}}')"><b>{{$type->description}}</b></a>
                        </li>
                        @endforeach

                        <li class="nav-item">
                            <div wire:loading><i class="fa fa-spinner fa-spin"></i> Loading</div>
                        </li>
                        <!-- Add more tabs as needed -->
                    </ul>
                </div>
                
            </div>
        </div>
        <div class="card-body">
            <div class="tab-content">
                @foreach($types as $key => $type)
                <div class="tab-pane {{ $activeTab === 'tab'.$key ? 'active' : '' }}" id="tab{{$key}}">
                    <div class="row">
                        @can('ecom access')
                        <div class="col-lg-12 col-md-6 col-sm-12 text-right">
                            <a href="#" title="upload" data-id="{{$key}}" data-department="10" class="btn-upload btn btn-primary"><i class="fas fa-plus mr-1"></i>UPLOAD</a>
                        </div>
                        @endcan
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <input type="text" placeholder="Search" class="form-control form-control-md" wire:model.live ="search">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-6 col-sm-12">
                            <div class="form-group">
                                <select class="form-control form-control-md" wire:model.lazy="item_per_page">
                                    <option value="all">All</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group">
                        @foreach($edocs as $key => $edoc)
                        <li class="list-group-item pb-0 mb-1 border border-primary text-center ">
                            <div class="row ">
                                <div class="col-lg-2 text-center border-bottom pb-1"> 
                                    @if($edoc->company_id == 1)
                                    <img src="{{asset('/images/bevinobg.png')}}" alt="product photo" class="product-img" height="50" width="100">
                                    @elseif($edoc->company_id == 2)
                                    <img src="{{asset('/images/bevanobg.png')}}" alt="product photo" class="product-img" height="50" width="80">
                                    @elseif($edoc->company_id == 3)
                                    <img src="{{asset('/images/biginobg.png')}}" alt="product photo" class="product-img" height="50" width="100">
                                    @else
                                    @endif
                                    <br>
                                    <b>{{$edoc->control_number}}</b><br>
                                </div>

                                 <div class="col-lg-2 text-center border-bottom pb-1">
                                    <b>TITLE</b><br> 
                                    <b>{{$edoc->title}}</b><br> 

                                </div>
                               
                                 <div class="col-lg-2 text-center border-bottom pb-1">
                                    <b>REFERENCE NO.</b><br> 
                                    <b>{{$edoc->reference_number}}</b><br> 

                                </div>
                            
                                <div class="col-lg-2 text-center border-bottom pb-1">
                                    <b>DATE EFFECTIVITY</b><br> 
                                    <b>{{date('m-d-Y', strtotime($edoc->date_effectivity))}}</b><br> 

                                </div>

                                <div class="col-lg-2 text-center border-bottom pb-1">
                                    <b>TYPE</b><br> 
                                    <span class="badge bg-yellow">{{$edoc->type->description}}</span><br> 

                                </div>
                                <div class="col-lg-1 text-center border-bottom pb-1">
                                    <b>STATUS</b><br> 
                                    <b>
                                        @if($edoc->status == null)
                                            <span class="badge badge-danger">PENDING</span>
                                        @elseif($edoc->status == 'active')
                                            <span class="badge badge-success">ACTIVE</span>
                                        @elseif($edoc->status == 'revised')
                                            <span class="badge badge-danger">REVISED</span>
                                        @else
                                        @endif
                                    </b><br>

                                </div>
                               
                                <div class="col-lg-1 text-center border-bottom pb-1">
                                    <b></b><br> 
                                    <b>  
                                    @can('edoc access')
                                        <a href="#" title="view" data-id="{{$edoc->id}}" class="btn-view btn ">
                                            <i class="fa fa-eye text-success"></i>
                                        </a>
                                    @endcan
                                    @can('ecom access')
                                        <a href="{{route('bevi.edit',encrypt($edoc->id))}}" title="edit">
                                            <i class="fa fa-pen-alt text-warning"></i>
                                        </a>
                                    @endcan
                                    @can('edoc delete')
                                        <a href="#" title="delete" data-id="{{encrypt($edoc->id)}}" class="btn-delete btn ">
                                            <i class="fa fa-trash-alt text-danger"></i>
                                        </a>
                                    @endcan
                                        </b><br> 
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul> 
                </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer">
            @if($item_per_page != 'all')
            <div class="row">
                <div class="col-12">
                    {{$edocs->links()}}
                </div>
            </div>
            @endif
           <div class="modal fade" id="modal-view">
                <div class="modal-dialog modal-xl">
                    <livewire:view-document />
                </div>
            </div>
            <div class="modal fade" id="modal-delete">
                <div class="modal-dialog">
                    <livewire:delete-model />
                </div>
            </div>

        </div>
        </div>
    </div>
    
</div>
