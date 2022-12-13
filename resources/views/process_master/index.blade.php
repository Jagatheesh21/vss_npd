@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
@endpush

@section('content')
<div class="card">
    <div class="card-header">
        <strong>Process Master List</strong><a href="{{route('process_master.create')}}" class="btn btn-primary float-end">Add New</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="process_master_table">
                <thead class="bg-secondary">
                    <tr>
                        <th>SNo</th>
                        <th>Child Part Number</th>
                        <th>Process</th>
                        {{-- <th>Action</th> --}}
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
        var table = $('#process_master_table').DataTable({
            buttons: [
        'copy', 'excel', 'pdf'
    ],
        processing: true,
        serverSide: true,
        ajax: "{{ route('process_master.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'child_part_number.name', name: 'child_part_number'},
            {data: 'operation.name', name: 'operation_name'},
            // {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
   
</script>
@endpush
