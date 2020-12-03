@component('mail::message')
Thanks for Laravel
<strong>Nmae:</strong>{{ $data['name'] }}
<strong>Email:</strong>{{ $data['email'] }}
<strong>Email:</strong>{{ $data['phone'] }}
<strong>Message:</strong>

{{ $data['message'] }}

@endcomponent
