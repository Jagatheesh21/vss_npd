<option value="">Select Supplier</option>
@foreach($suppliers as $supplier)
<option value="{{$supplier->id}}" {{ old("supplier_id") == $supplier->id ? "selected" : "" }}>{{$supplier->name}}-{{$supplier->name}}</option>
@endforeach
