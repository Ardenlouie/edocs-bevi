<table class="table table-striped table-valign-middle">
    <thead>
        <tr>
            <th>Company</th>
            <th>Control No.</th>
            <th>Title</th>
            <th>Revision No.</th>
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
            <td><span class="badge bg-purple">{{($edoc->revision_number ?? '')}}</span></td>
            <td>{{$edoc->department->name}}</td>
            <td>{{($edoc->user->name ?? '')}}</td>
            <td>{{\Carbon\Carbon::parse($edoc->created_at)->format('M d, Y')}}</td>
            <td>
                @if($edoc->status == null)
                    <span class="badge badge-danger">PENDING</span>
                @elseif($edoc->status == 'active')
                    <span class="badge badge-success">ACTIVE</span>
                @elseif($edoc->status == 'inactive')
                    <span class="badge badge-danger">INACTIVE</span>
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

{{ $active_edocs->links() }}