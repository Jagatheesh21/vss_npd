@extends('layouts.app')
@livewireStyles
@push('styles')
<link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
<link rel="stylesheet" href="//cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
@endpush
@section('content')
<div class="card">
    <div class="card-header">
        Part Master <a href="{{route('part_master.create')}}" class="btn btn-primary btn-sm float-end" >Create New</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="part_master_table">
                <thead class="bg-secondary">
                    <tr>
                        <th>SNo</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Child Part Number</th>
                        <th>UOM</th>
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
@livewireScripts
@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script>
        var table = $('#part_master_table').DataTable({
            dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        processing: true,
        serverSide: true,
        ajax: "{{ route('part_master.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'category.name', name: 'category_name'},
            {data: 'type.name', name: 'type_name'},
            {data: 'child_part.name', name: 'child_part_name'},
            {data: 'uom.name', name: 'uom_name'},
            {data: 'action', name: 'action', orderable: false, searchable: false,exportable:false},
        ]
    });
    </script>
@endpush