@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">

@endpush

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong >APQP- Timing Plan </strong>
        <a href="{{route('apqp_timing_plan.create')}}" class="btn btn-primary float-end">Add New</a>
    </div>
    <div class="card-body">
        <a href="{{ route('timing_plan.export') }}" class="btn btn-primary btn-sm">Export</a>

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" id="category_table">
                <thead class="bg-secondary">
                    <tr>
                        <th>SNo</th>
                        <th>APQP Time Plan Number</th>
                        <th>Part Number</th>
                        <th>Part Description</th>
                        <th>Customer</th>
                        <th>Current Stage</th>
                        <th>Current Sub Stage</th>
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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
{{-- <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script> --}}
<script>
        var table = $('#category_table').DataTable({
            dom: 'Bfrtip',
        buttons: [
             'excel', 'print'
        ],
        processing: true,
        serverSide: true,
        ajax: "{{ route('apqp_timing_plan.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'apqp_timing_plan_number', name: 'apqp_timing_plan_number'},
            {data: 'part_number.name', name: 'part_number'},
            {data: 'part_number.description', name: 'part_description'},
            {data: 'customer.name', name: 'customer'},
            {data: 'stage.name', name: 'current_stage'},
            {data: 'sub_stage.name', name: 'currentsub_stage'},
            {data: 'action', name: 'action', orderable: false, searchable: false,exportable:false},
        ]
    });
</script>
@endpush
