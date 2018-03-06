@component('mail::message')
# Introduction

The body of your message.

@foreach($cart->item())

Thanks,<br>
{{ config('app.name') }}
@endcomponent
