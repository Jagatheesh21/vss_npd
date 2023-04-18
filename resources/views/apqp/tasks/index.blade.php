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
                        <th>S.No</th>
                        <th>APQP Time Plan Number</th>
                        <th>Part Number</th>
                        <th>Customer</th>
                        <th>Stage</th>
                        <th>Activity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($task_lists as $task)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$task->plan->apqp_timing_plan_number}}</td>
                        <td>{{$task->plan->part_number->name}}</td>
                        <td>{{$task->plan->customer->name}}</td>
                        <td>{{$task->stage->name}}</td>
                        <td>{{$task->sub_stage->name}}</td>
                        {{-- <td>{{auth()->user()->id}}</td> --}}

                        <td>
                            @if(auth()->user()->id>7)
<<<<<<< HEAD
                            <a href="{{url($task->sub_stage->url)}}{{$task->plan->id}}" class="btn btn-info btn-sm">Update</a>
=======
                            <a href="{{url($task->sub_stage->url)}}{{$task->plan->id}}" class="btn btn-info btn-sm text-white">Update</a>
>>>>>>> 6effb6f30f1247ca2f8a711aad43bb1d1ea9ff99
                            @endif

                            @if(auth()->user()->id==7)
                            <a href="{{route('task',[$task->plan->id,$task->sub_stage_id])}}" class="btn btn-info btn-sm text-white">Verify</a>

                            {{-- <a href="{{url($task->sub_stage->model)}}/{{$task->plan->id}}/edit" class="btn btn-info btn-sm">Verification</a> --}}
                            @endif

<<<<<<< HEAD
                            @if(auth()->user()->id===3 || auth()->user()->id==5 || auth()->user()->id==6 )
=======
                            @if(auth()->user()->id==3 || auth()->user()->id==5 || auth()->user()->id==6 )
>>>>>>> 6effb6f30f1247ca2f8a711aad43bb1d1ea9ff99
                            <a href="{{route('task',[$task->plan->id,$task->sub_stage_id])}}" class="btn btn-success btn-sm text-white">Approve</a>

                            {{-- <a href="{{url($task->sub_stage->url)}}{{$task->plan->id}}" class="btn btn-info btn-sm">Approval</a> --}}
                            @endif

                        </td>
                        {{-- @if(auth()->user()->id=7)
                        <td><a href="{{route('task',[$task->plan->id,$task->sub_stage_id])}}" class="btn btn-info btn-sm">Update</a></td>
                        @endif --}}
                    </tr>
                    @empty
                    <tr>
                        <td>No Activity Found!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
{{-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
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
} --}}

    </script>
@endpush
