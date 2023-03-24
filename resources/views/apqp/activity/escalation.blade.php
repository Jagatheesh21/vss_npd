@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
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
        <strong> Escaltion - Task List </strong>
        <a class="btn btn-primary" style="float:right" href="{{route('escalation_export')}}">Export</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped py-2" id="escalation_table">
                <thead class="bg-secondary">
                    <tr>
                        <th>SNo</th>
                        <th>APQP Time Plan Number</th>
                        <th>Part Number</th>
                        <th>Part Description</th>
                        <th>Customer</th>
                        <th>Activity</th>
                        <th>Status</th>
                        <th>Plan Start Date</th>
                        <th>Plan End Date</th>
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
        var table = $('#escalation_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('escalation_activity') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'plan.apqp_timing_plan_number', name: 'apqp_timing_plan_number'},
            {data: 'plan.part_number.name', name: 'part_number'},
            {data: 'plan.part_number.description', name: 'part_description'},
            {data: 'plan.customer.name', name: 'customer'},
            {data: 'sub_stage.name', name: 'activity'},
            {data: 'plan.status.name', name: 'status'},
            {data: 'plan_start_date', name: 'Plan Start Date'},
            {data: 'plan_end_date', name: 'Plan End Date'},
        ]
    });
</script>
@endpush
