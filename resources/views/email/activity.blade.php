@extends('layouts.email')

@section('content')
<p> Timing Plan {{ $activity->plan->apqp_timing_plan_number }} - {{ $activity->plan->sub_stage->name }} Activity details updated On Our NPD Software.kindly check it.</p>
<table class="discount" style="margin-bottom:15px;" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>

      <td align="center">
        <h1 class="f-fallback discount_heading">APQP Timing Plan - {{ $activity->plan->apqp_timing_plan_number }}</h1>
        <p class="f-fallback discount_body">
            Part Number : {{ $activity->plan->part_number->name }}, <br>
            Customer    : {{ $activity->plan->customer->name }} <br>

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
