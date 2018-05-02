@component('mail::message')
# Dobrý deň {{$user->name}}.
(Good morning)

# Verifikujete si svoj email týmto linkom,
(Please verify your email with this link)

<a id="purple-tag" href="{{route('registration.verify',$user->token)}}">kliknite sem</a>

# Ak ste o tento typ emailu nežiadali, prosím ignorujte ho.
(If you don t ask for this email just ignore him please)

# Dakujeme Vám za dôveru.
(Thank you for your trust)
@endcomponent