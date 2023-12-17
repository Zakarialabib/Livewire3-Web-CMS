<x-mail::message>
# {{ __('Dear Admin') }}

## {{ __('New Contact inquiry') }}

{{__('You have received a new contact inquiry. Here are the details:')}}

- **{{__('Name')}}:** {{ $contact->name }}
- **{{__('Email')}}:** {{ $contact->email }}
- **{{__('Phone number')}}:** {{ $contact->phone_number }}

**{{__('Message')}}:**
<p>
{{ $contact->message }}
</p>
    
    {{__('Best regards,')}}
</x-mail::message>