@extends('layouts.app')
@push('styles')

@endpush
{{-- @livewireStyles --}}
@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> {{session('success')}}.
  <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> {{session('error')}}.
  <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
</div>
@endif
  
    <div class="card">
        <div class="card-header">
            <strong>Store - Raw Material Issue Entry</strong>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="operation_save" method="POST" action="{{route('store_issue.store')}}">
                  @csrf
                  @method('POST')
                    {{-- @livewire('store-route-card-issue') --}}

                    <input type="hidden" name="route_card_type_id" value="1">
                    <div class="row mb-3">
                      <div class="col-md-4 ">
                        <div class="form-group">
                          <label for="" class="col-sm-4 col-form-label">Route Card #</label>
                          <input type="text" name="route_card_number" class="form-control bg-success" value="{{$route_card_number}}">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="col-sm-4 col-form-label" for="">Category * </label>
                          <select name="category_id" id="category_id" class="form-control">
                            <option value="">Select Category</option>
                            <option value="{{$category->id}}">{{$category->name}}</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="col-sm-4 col-form-label" for="">Type * </label>
                          <select name="type_id" id="type_id" class="form-control">
                            <option value="">Select Type First</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="col-sm-4 col-form-label" for="">Part Description * </label>
                          <select name="raw_material_id" id="raw_material_id" class="form-control">
                            <option value="">Select Type First</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="col-sm-6 col-form-label" for="">Purchase Order Number * </label>
                          <select name="purchase_order_id" id="purchase_order_id" class="form-control">
                            <option value="">Select Purchase Order</option>
                            @foreach ($purchase_orders as $purchase_order)
                                <option value="{{$purchase_order->id}}">{{$purchase_order->purchase_order_number}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="col-sm-6 col-form-label" for="">Supplier * </label>
                          <select name="supplier_id" id="supplier_id" class="form-control">
                            <option value="">Select Purchase Order First</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="" class="col-sm-6 col-form-label">Available Quantity *</label>
                          <input type="text" name="available_quantity" class="form-control" id="avaialble_quantity">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="" class="col-sm-6 col-form-label">Issue Quantity *</label>
                          <input type="text" name="issue_quantity" class="form-control" id="issue_quantity">
                        </div>
                      </div>
                      <div class="col-md-4" id="list_view">

                      </div>

                    </div>
                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                           <button type="submit" id="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                  </form>
            </div>
        </div>
    </div>

@endsection
{{-- @livewireScripts --}}
@push('scripts')
<script src="{{asset("js/select2.min.js")}}"></script>

  <script>
  $("#category_id").select2();
  $("#purchase_order_id").select2();
  $('body').on('change','#category_id',function(){
    var category_id = $(this).val();
    $.ajax({
      url:"{{route('general.types')}}",
      type:"POST",
      data:{category_id:category_id},
      success:function(response)
      {
       
        $("#type_id").html(response.html);
        $("#type_id").select2();
      }
    });
  });
  $('body').on('change','#type_id',function(e){
    e.preventDefault();
    var type_id = $(this).val();
    
    if(type_id>1)
    {
      $("#nesting_view").html(" ");
    }
    $.ajax({
      url:"{{route('general.materials')}}",
      type:"POST",
      data:{type_id:type_id},
      success:function(response)
      {
        $("#raw_material_id").html(response.html);
        $("#raw_material_id").select2();
      }
    });

  
  });

  $('body').on('change','#purchase_order_id',function(e){
    e.preventDefault();
    var purchase_order_id = $(this).val();
    $.ajax({
      url:"{{route('general.suppliers')}}",
      type:"POST",
      data:{purchase_order_id:purchase_order_id},
      success:function(response)
      {
        $("#supplier_id").html(response.html);
        $("#supplier_id").select2();
      }
    });
  });
  $('body').on('change','#supplier_id',function(e){
    e.preventDefault();
    //alert($(this).val());
    var purchase_order_id = $("#purchase_order_id").val();
    var supplier_id = $(this).val();
    alert(purchase_order_id);
    $.ajax({
      url:"{{route('general.avaialable_quantity')}}",
      type:"POST",
      data:{purchase_order_id:purchase_order_id},
      success:function(response){
        $("#avaialble_quantity").val(response.quantity);
      }
    });
  });
  $('body').on('change','#raw_material_id',function(e){
    e.preventDefault();
    var type_id = $("#type_id").val();
    var raw_material_id = $(this).val();
    if(type_id==1)
    {
      $.ajax({
        url:"{{route('general.nestings')}}",
        type:"POST",
        data:{type_id:type_id,raw_material_id:raw_material_id},
        success:function(response)
        {
          $("#list_view").html(response.html);
          $("#nesting_id").select2();
        }
      });
    }
    if(type_id>1)
    { 
      $("#list_view").html(" ");
    }
  });
  $('body').on('change','#nesting_id',function(e){
    e.preventDefault();
    var nesting_id = $(this).val();
    var raw_material_id = $("#raw_material_id").val();
      $.ajax({
        url:"{{route('general.nesting_sequences')}}",
        type:"POST",
        data:{nesting_id:nesting_id,raw_material_id:raw_material_id},
        success:function(response)
        {
          $("#nesting_type_id").html(response.html);
          $("#nesting_type_id").select2();
        }
      });
      
  $('body').on('change','#nesting_type_id',function(e){
    e.preventDefault();
    var nesting_type_id = $(this).val();
    var nesting_id = $("#nesting_id").val();
    var raw_material_id = $("#raw_material_id").val();
    // alert(nesting_id);
    // alert(nesting_type_id);
    // alert(raw_material_id);
      $.ajax({
        url:"{{route('general.nesting_part_numbers')}}",
        type:"POST",
        data:{nesting_id:nesting_id,raw_material_id:raw_material_id,nesting_type_id:nesting_type_id},
        success:function(response)
        {
          console.log(response.html);
          $("#child_part_number_id").html(response.html);
          $("#child_part_number_id").select2();
        }
      }); 
  });
  });
  </script>
@endpush