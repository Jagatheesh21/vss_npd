@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
@endpush

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> {{session('success')}}.
  <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger" role="alert">
  <strong>Error!</strong>{{session('error')}}
  <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card">
    <div class="card-header">
        <strong> Task List </strong>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" id="enquiry_table">
                <thead class="bg-secondary">
                    <tr>
                        <th>SNo</th>
                        <th>APQP Time Plan Number</th>
                        <th>Part Number</th>
                        <th>Part Description</th>
                        <th>Customer</th>
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
    <script>
        load_data();
        function load_data(from_date = '', to_date = ''){
        $('#enquiry_table').DataTable({
            dom: 'Bfrtip',
        buttons: [
             'excel', 'print'
        ],
        processing: true,
        serverSide: true,
        ajax: "{{ route('activity.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'plan.apqp_timing_plan_number', name: 'apqp_timing_plan_number'},
            {data: 'plan.part_number.name', name: 'part_number'},
            {data: 'plan.part_number.description', name: 'part_description'},
            {data: 'plan.customer.name', name: 'customer'},
            {data: 'action', name: 'action', orderable: false, searchable: false,exportable:false},
        ]
    });
}

    </script>
@endpush
