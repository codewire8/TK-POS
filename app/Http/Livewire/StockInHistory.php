<?php

namespace App\Http\Livewire;

use App\Models\StockEntry;
use Livewire\Component;
use Livewire\WithPagination;

class StockInHistory extends Component
{

    use WithPagination;

    public $query;

    public function read()
    {
        return StockEntry::where('refno', 'like', '%' . $this->query. '%')
                ->with('vendor')
                ->with('flavor')
                ->paginate(15);
    }

    public function render()
    {
        return view('livewire.stock-in-history', [
            'data' => $this->read()
        ]);
    }
}
