@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
@endpush

@section('content')
<div class="card">
    <div class="card-header">
                 <strong>Raw Material List</strong><a href="{{route('raw_material.create')}}" class="btn btn-primary float-end">Add New</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="raw_material_table">
                <thead class="bg-secondary">
                    <tr>
                        <th>SNo</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Part Description</th>
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
        var table = $('#raw_material_table').DataTable({
            buttons: [
        'copy', 'excel', 'pdf'
    ],
        processing: true,
        serverSide: true,
        ajax: "{{ route('raw_material.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'category.name', name: 'category'},
            {data: 'type.name', name: 'type'},
            {data: 'name', name: 'name'},
            {data: 'part_description', name: 'part_description'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

</script>
@endpush
