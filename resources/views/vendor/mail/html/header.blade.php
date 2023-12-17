@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('images/' . Helpers::settings('site_logo')) }}" class="logo" alt="{{ Helpers::settings('site_logo') }}">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
