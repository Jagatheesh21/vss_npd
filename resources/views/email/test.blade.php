@extends('layouts.email')

@section('content')
<p>Enquiry Register Details updated and the reference file attached in this email. kindly check it.</p>
<table class="discount" style="margin-bottom:15px;" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>

      <td align="center">
        <h1 class="f-fallback discount_heading">APQP Timing Plan - {{ $enquiry->timing_plan->apqp_timing_plan_number }}</h1>
        <p class="f-fallback discount_body">
            Part Number : {{ $enquiry->timing_plan->part_number->name }}, <br>
            Customer    : {{ $enquiry->timing_plan->customer->name }}
        </p>
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
          <tr>
            <td align="center">
              
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
@endsection