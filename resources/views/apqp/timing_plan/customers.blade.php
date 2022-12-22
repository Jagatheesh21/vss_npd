<option value="">Select Customer</option>
@foreach($customers as $customer)
<option value="{{$customer->id}}" @if (old('customer_id')==$customer->id)
  selected
@endif>{{$customer->name}}</option>
@endforeach