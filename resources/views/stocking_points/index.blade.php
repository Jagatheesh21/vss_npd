@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">

@endpush

@section('content')
<div class="card">
    <div class="card-header">
         <h3 class="title">Stocking Points</h3>
         <a href="{{route('stocking_points.create')}}" class="btn btn-primary float-end">Add New</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="stocking_points_table">
                <thead class="bg-secondary">
                    <tr>
                        <th>SNo</th>
                        <th>Name</th>
                        <th>Description</th>
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
        var table = $('#stocking_points_table').DataTable({
            buttons: [
        'copy', 'excel', 'pdf'
    ],
        processing: true,
        serverSide: true,
        ajax: "{{ route('stocking_points.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('body').on('click','.deleteProduct',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var url = "{{route('operation.destroy',':id')}}";
        url.replace(":id",id);
        
        $.ajax({
            url:url,
            type:'DELETE',
            data:{id:id},
            success:function(response){
                alert(response);
            }
        });
    });
</script>
@endpush
