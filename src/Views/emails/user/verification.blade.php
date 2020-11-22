@component('mail::message')
# Account Verification Email

Hi {{ $name }}<br>
Look like you just created Account.<br>
Please Verify your Account by Clicking Below button.<br>
@component('mail::button', ['url' => URL::to('/verify/'.$token)])
Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent