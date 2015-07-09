@extends('layouts.email')

@section('content')

                            <h1>Welcome to MidwestFit!</h1>

<h3>Confirm your e-mail address and start earning rewards today.</h3>

<p><span style="color: #000000;font-family: helvetica;font-size: 12px;line-height: normal;">Thank you for signing up. We cannot wait to help you reach your fitness goals! Please follow the instructions below to get started.<br>
<br>
<strong>Click the link below&nbsp;to confirm your email address:</strong></span><br style="color: #000000;font-family: Helvetica;font-size: 12px;line-height: normal;">
<br style="color: #000000;font-family: Helvetica;font-size: 12px;line-height: normal;">
<a href="{{ route('auth.confirm', [ $token ]) }}" style="font-family: Helvetica; font-size: 12px; line-height: normal;">{{ route('auth.confirm', [ $token ]) }}</a><span style="color: #000000;font-family: helvetica;font-size: 12px;line-height: normal;">&nbsp;</span><br style="color: #000000;font-family: Helvetica;font-size: 12px;line-height: normal;">
<br style="color: #000000;font-family: Helvetica;font-size: 12px;line-height: normal;">
<br style="color: #000000;font-family: Helvetica;font-size: 12px;line-height: normal;">
<strong><span style="color: #000000;font-family: helvetica;font-size: 12px;line-height: normal;">To check on your referral status and see how many friends signed up via your link, you may bookmark this page:</span></strong><br style="color: #000000;font-family: Helvetica;font-size: 12px;line-height: normal;">
<br style="color: #000000;font-family: Helvetica;font-size: 12px;line-height: normal;">
<a href="{{ route('user.status', [ $secret ]) }}" style="font-family: Helvetica; font-size: 12px; line-height: normal;">{{ route('user.status', [ $secret ]) }}</a><br>
&nbsp;</p>

@stop
