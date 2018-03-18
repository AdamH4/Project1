<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CardOrder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $products;
    public $information;
    public $total;
    public $type;
    public $note;

    public function __construct($products,$information,$total,$type,$note)
    {
        $this->products = $products;
        $this->information = $information;
        $this->total = $total;
        $this->type = $type;
        $this->note = $note;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('shop.emails.card-order');
    }
}
