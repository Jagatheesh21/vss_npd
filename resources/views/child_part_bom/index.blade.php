@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
@endpush

@section('content')
<div class="card">
    <div class="card-header">
                 <strong>Child Part BOM - List</strong><a href="{{route('child_part_bom.create')}}" class="btn btn-primary btn-sm float-end">Add New</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="operation_table">
                <thead class="bg-secondary">
                    <tr>
                        <th>SNo</th>
                        <th>BOM</th>
                        <th>Type</th>
                        <th>Raw Material</th>
                        <th>Nesting</th>
                        <th>Nesting Type</th>
                        <th>ChildPartNumber</th>
                        <th>Quantity</th>
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
<script>
        var table = $('#operation_table').DataTable({
            buttons: [
        'copy', 'excel', 'pdf'
    ],
        processing: true,
        serverSide: true,
        ajax: "{{ route('child_part_bom.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'bom_id', name: 'bom'},
            {data: 'type.name', name: 'type'},
            {data: 'raw_material.part_description', name: 'raw_material'},
            {data: 'nesting.name', name: 'nesting'},
            {data: 'nesting_type.name', name: 'nesting_type'},
            {data: 'child_part_number.name', name: 'child_part_number'},
            {data: 'quantity', name: 'quantity'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
</script>
@endpush
