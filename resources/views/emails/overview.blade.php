@component('mail::message')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
            <h2 class="text-center text-2xl font-bold">Overview</h2>
        </div>

        <table class="table-fixed border-2 rounded border-solid my-2">
            <thead>
                <th class="w-1/3 text-left p-4">Customer</th>
                <th class="w-1/3 text-center p-4">Quote Info</th>
            </thead>
            <tbody>
                @foreach ($customer as $customer)
                    <tr>
                        <td>
                            {{ $customer->id }} {{ $customer->firstname }} {{ $customer->lastname }}
                        </td>
                        @if($customer->id === $quote->customer_id)
                            @foreach ($quote as $quote)
                                <td>
                                    {{ $quote->quotename }}
                                </td>
                            @endforeach
                        @endif
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>
</div>

Thanks, <br>
{{ config('app.name') }}
@endcomponent
