<?php

namespace App\View\Components\Products;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class ProductsList extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public Collection $products,
        public array $cart
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.products.products-list');
    }
}
