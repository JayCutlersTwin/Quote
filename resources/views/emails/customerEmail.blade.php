@component('mail::message')

{{ $quote[0]->firstname }} {{ $quote[0]->lastname }}

@foreach($quote as $Q)

Product: {{ $Q->productname }}, <br>
Quantity: {{ $Q->quantity }}, <br>
Price each: {{ $Q-> price }}

@endforeach

@php
    $totals = array();

    for ($i=0; $i < count($quote); $i++) {
        array_push($totals, $quote[$i]->price * $quote[$i]->quantity);

    }
    $Done = array_sum($totals);
@endphp

Total: ${{ $Done }}

Thanks, <br>
{{ config('app.name') }}
@endcomponent
