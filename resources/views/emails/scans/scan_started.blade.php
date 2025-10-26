@component('mail::message')
# Scan Initiated

Hello,

This is a confirmation that your vulnerability scan for **{{ $nmapRequest->target }}** has started.

We will notify you again as soon as the scan is complete. This process typically takes about 2-3 minutes.

You can check the status on your dashboard.

@component('mail::button', ['url' => url('/dashboard')])
Go to Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
