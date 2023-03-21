@extends('layouts.password')

@section('content')
<p>{{$mail_data['name']}} updated Password On Our NPD Software.kindly check it.</p>
<table class="discount" style="margin-bottom:15px;" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>

      <td align="center">
        <h1 class="f-fallback discount_heading">User Details</h1>
        <p class="f-fallback discount_body">
            Email : {{ $mail_data['email'] }}, <br>
            New Password    : {{ $mail_data['password'] }} <br>

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
