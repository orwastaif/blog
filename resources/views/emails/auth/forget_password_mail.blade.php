@component('mail::message')
Hello {{$name}}

@component('mail::button', ['url' => route('getResetPassword',$reset_code)])
Click here to reset your password
@endcomponent
<p>or copy and paste the following link to your browser</p>
<p><a href="{{route('getResetPassword',$reset_code)}}">
{{route('getResetPassword',$reset_code)}}</a></p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
