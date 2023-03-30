@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
<link rel="stylesheet" href="//cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

@endpush

@section('content')
<div class="card">
    <div class="card-header">
        <strong>Part Number List</strong>  <a href="{{route('part_number.create')}}" class="btn btn-sm btn-primary float-end">Add New</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" id="category_table">
                <thead class="bg-secondary">
                    <tr>
                        <th>SNo</th>
                        <th>Part Number</th>
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
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script>

<script>
        var table = $('#category_table').DataTable({
            dom: 'Bfrtip',
            buttons: [
        'copy', 'excel', 'pdf'
    ],
        processing: true,
        serverSide: true,
        ajax: "{{ route('part_number.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'partnumber'},
            {data: 'description', name: 'partdescription'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
</script>
@endpush
