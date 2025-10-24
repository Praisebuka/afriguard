@component('mail::message')
# Scan Completed!

Hello,

Your vulnerability scan for **{{ $nmapRequest->target }}** is now complete.

Our simulated scan found potential vulnerabilities on your target. Please log in to your dashboard to review the detailed report and recommended actions.

@component('mail::button', ['url' => url('/dashboard/scan/' . $nmapRequest->id)])
View Full Report
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
