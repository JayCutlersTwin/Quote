<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Quote;
use App\Models\Customer;
use App\Models\Product;


class EmailQuote extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Models\Quote
     */
    public $quote;

    /**
     * The order instance.
     *
     * @var \App\Models\Customer
     */
    public $customer;

    /**
     * The order instance.
     *
     * @var \App\Models\Product
     */
    public $product;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($quote, $customer, $product,)
    {
        $this->quote = $quote;
        $this->customer = $customer;
        $this->product = $product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.overview');
    }
}
