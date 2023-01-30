@component('mail::message')
@if ($user->status == 'A')
# Your Registration on SL Travel is Success

Now you can log into the system

@component('mail::button', ['url' => route('login'), 'color' => 'success'])
Login
@endcomponent
@else
# Your Registration on SL Travel is Waiting for approval

We will let you know when account reviewed.
@endif

Thanks,<br>
SL Travel
@endcomponent
