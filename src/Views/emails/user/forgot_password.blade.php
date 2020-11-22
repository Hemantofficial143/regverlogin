@component('mail::message')
# Forgot Password Email

Hi {{ $email }}<br>
You Received Mail because you request for reset your password on {{ config('app.name') }}.
<br>
to reset your password click below.

@component('mail::button', ['url' => URL::to('/reset-password/'.$token)])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
