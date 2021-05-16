<?php

namespace App\Http\Livewire;

use App\Models\Flavor;
use App\Models\StockAdjustment;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class StockAdjustments extends Component {

    use WithPagination;

    public $modelId;

    public $query;

    /**
     * List of products in the database
     *
     * @return void
     */
    public function read()
    {
        if ($this->query !== null) {
            return Flavor::where('pcode', 'like', '%' . $this->query . '%')
                ->orWhere('name', 'like', '%' . $this->query . '%')
                ->with('size')
                ->with('brand')
                ->with('category')
                ->paginate(5);
        } else {
            return Flavor::paginate(5);
        }
    }

    /**
     * Display data in the view
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.stock-adjustments', [
            'data' => $this->read()
        ]);
    }

}
