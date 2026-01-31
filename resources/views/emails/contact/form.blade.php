@component('mail::message')
# New Contact Inquiry

You have received a new message from the contact form on your website.

**Name:** {{ $data['name'] }}
**Email:** {{ $data['email'] }}
**Phone:** {{ $data['phone'] ?? 'N/A' }}
**Subject:** {{ $data['subject'] ?? 'General Inquiry' }}

**Message:**
{{ $data['message'] }}


@if(!empty($data['newsletter']))
    *Note: This user has opted in to the newsletter.*
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent