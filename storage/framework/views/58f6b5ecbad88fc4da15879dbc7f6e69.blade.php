@if($response)
{!! $response->head !!}
@else
{!! $slot !!}
@endif