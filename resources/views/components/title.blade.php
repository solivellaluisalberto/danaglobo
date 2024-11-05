@props([
    'title' => '',
    'big' => false
])

@if($big)
    <h5 class="mb-2 text-3xl font-bold tracking-tight text-gray-900 ">{{$title}}</h5>
@else
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">{{$title}}</h5>
@endif
