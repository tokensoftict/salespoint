<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InvoiceListComponent extends Component
{

    public $invoices;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($invoices)
    {
        $this->invoices = $invoices;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.invoice-list-component');
    }
}
