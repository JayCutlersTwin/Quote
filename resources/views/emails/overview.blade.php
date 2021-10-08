@component('mail::message')

<h2 class="text-center text-2xl font-bold">Todays Quotes Overview</h2>



@foreach ($quote as $customers)

Customer Name: {{ $customers->firstname }} {{ $customers->lastname }}

Quote Name: {{ $customers->quotename }}

@if($customers->order_complete === 1)
Order Complete
@else
Order Incomplete
@endif

<hr>

@endforeach

Thanks, <br>
{{ config('app.name') }}
@endcomponent
