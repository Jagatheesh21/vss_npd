@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">

@endpush

@section('content')
<div class="card">
    <div class="card-header">
         <strong>Child Part Numbers</strong>
         <a href="{{route('child_part_number.export')}}" class="bt btn-primary btn-sm">Export</a>
         <a href="{{route('child_part_number.create')}}" class="btn btn-primary btn-sm float-end">Add New</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-AuditLog" id="child_part_number_table">
                <thead class="bg-secondary">
                    <tr>
                        <th>SNo</th>
                        <th>Part Number</th>
                        <th>Part Model</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
    
                </tbody>
            </table>
        </div>
    </div>
</div>    
@endsection

@push('scripts')
<script src="{{asset('js/datatables.min.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script>
        var table = $('#child_part_number_table').DataTable({
            buttons: [
        'copy', 'excel', 'pdf'
    ],
        processing: true,
        serverSide: true,
        ajax: "{{ route('child_part_number.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
</script>
@endpush
