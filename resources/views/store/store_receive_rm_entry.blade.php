@extends('layouts.app')
@push('styles')

@endpush

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
            <strong>Store - Raw Material Receive Entry</strong>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="operation_save" method="POST" action="{{route('store_receive.store')}}">
                  @csrf
                  @method('POST')
                  <div class="row mb-3">
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-4 col-form-label required">Category*</label>
                      <div class="form-group">
                          <select name="category_id" id="category_id" class="form-control select2">
                              @foreach ($categories as $category)
                                  @if($category->id==1)
                                  <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                  @endif
                              @endforeach
                          </select>
                        @error('category_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-2 col-form-label required">Type*</label>
                      <div class="form-group">
                        <select name="type_id" id="type_id" class="form-control select2">
                            <option value="">Select Type</option>
                            @foreach ($types as $type)
                            <option value="{{$type->id}}" {{ old("type_id") == $type->id ? "selected" : "" }}>{{$type->name}}</option>                                
                            @endforeach
                        </select>
                        @error('type_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-4 col-form-label required">Part Description*</label>
                      <div class="form-group">
                        <select name="raw_material_id" id="raw_material_id" class="form-control select2">
                          <option value="">Select Type First..</option>
                        </select>
                        @error('raw_material_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-4 col-form-label required">Purchase Order*</label>
                      <div class="form-group">
                        <select name="purchase_order_id" id="purchase_order_id" class="form-control select2">
                          <option value="">Select Purchase Order</option>
                          @foreach($purchase_orders as $purchase_order)
                          <option value="{{$purchase_order->id}}" {{ old("purchase_order") == $purchase_order->id ? "selected" : "" }} >{{$purchase_order->purchase_order_number}}</option>
                          @endforeach
                        </select>
                        @error('purchase_order_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4 supplier_div">
                      <label for="name" class="col-sm-4 col-form-label required">Supplier*</label>
                      <div class="form-group">
                        <select name="supplier_id" id="supplier_id" class="form-control select2">
                          <option value="">Select Supplier</option>
                        </select>
                        @error('supplier_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-4 col-form-label required">Invoice Number*</label>
                      <div class="form-group">
                       <input type="text" name="invoice_number" id="invoice_number" class="form-control">
                        @error('invoice_number')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-2 col-form-label required">UOM*</label>
                      <div class="form-group">
                        <select name="uom_id" id="uom_id" class="form-control select2">
                          <option value="">Select UOM</option>
                          @foreach($uoms as $uom)
                          <option value="{{$uom->id}}" {{ old("uom_id") == $uom->id ? "selected" : "" }} >{{$uom->name}}</option>
                          @endforeach
                        </select>
                        @error('uom_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-4 col-form-label required">Quantity*</label>
                      <div class="form-group">
                      <input type="text" name="inward_quantity" id="inward_quantity" value="{{old('quantity')}}" class="form-control">
                      @error('inward_quantity')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
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
@push('scripts')
<script src="{{asset('js/select2.min.js')}}"></script>
<script>
  var type_id  = $("#type_id option:selected").val();
  function getmaterial()
  {
    $.ajax({
    url:"{{route('general.materials')}}",
    type:"POST",
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    data:{type_id:type_id},
    success:function(response)
    {
      $("#raw_material_id").html(response.html);
      $("#raw_material_id").select2({
        allowedClear:true,
        placeholder:'Select Material'
      });
      $(".uom_div").show();
      $("#uom_id").select2({
        allowedClear:true,
        placeholder:'Select UOM'
      });
    }
   });
  }
  if(type_id!='')
  {
    getmaterial();
  }
  $("#type_id").select2({
      placeholder:'Select Type',
      allowdClear:true
  });
  $("#purchase_order_id").select2({
      placeholder:'Select Purchase Order',
      allowdClear:true
  });

// Ajax 
$("#type_id").change(function(e){
   e.preventDefault();
   getmaterial();
});
$("#purchase_order_id").change(function(e){
  e.preventDefault();
  if($(this).val()=="" || $(this).val()==null || $(this).val()==undefined)
  {
    alert("Please Select Purchase Order..");
    return false;
  }else{
    var purchase_order_id = $(this).val();
    $.ajax({
      url:"{{route('store.getSupplier')}}",
      data:{purchase_order_id:purchase_order_id},
      type:"POST",
      success:function(response)
      {
        $("#supplier_id").html(response.html);
      }
    });
  }
});
</script>
@endpush