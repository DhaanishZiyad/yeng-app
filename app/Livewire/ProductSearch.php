<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductSearch extends Component
{
    public $search = ''; // Bind to the search input field
    public $products = []; // Holds the filtered products

    public function updatedSearch()
    {
        logger('Search term updated: ' . $this->search);

        $this->products = Product::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%{$this->search}%");
            })
            ->get();
    }

    public function mount()
    {
        $this->products = Product::all();
    }

    public function render()
    {
        return view('livewire.product-search');
    }
}
