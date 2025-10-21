@component('mail::message')
# Welcome to AfriGuard, {{ $user->name }}!

We are thrilled to have you join us.

To get started and secure your account, you need to verify your email address. Please click the button below:

@component('mail::button', ['url' => $url])
Verify Email Address
@endcomponent

Every week, we share honest stories, security insights, and practical guides to help you stay secure & mitigate cyber attacks in your business.

Join our communities using the links below for more details. **PIN the Channels so you don't miss anything!**

@component('mail::button', ['url' => 'https://www.whatsapp.com/channel/0029VbB0G3AEKyZDnb8juE47'])
WhatsApp Channel
@endcomponent

<p style="text-align: center; margin: 0;">&</p>

@component('mail::button', ['url' => 'https://t.me/indomie'])
Telegram Channel
@endcomponent

Thanks,<br>
The {{ config('app.name') }} Team
@endcomponent