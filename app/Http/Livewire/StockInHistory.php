<?php

namespace App\Http\Livewire;

use App\Models\StockEntry;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class StockInHistory extends Component
{

    use WithPagination;

    public $startDate;
    public $endDate;

    public function mount()
    {
        $this->startDate = Carbon::now()->format('Y-m-d');
        $this->endDate = Carbon::now()->format('Y-m-d');
    }

    public function read()
    {
        $from = $this->startDate;
        $to = $this->endDate;

        if ($from !== null && $to !== null) {
            return StockEntry::whereBetween('stock_in_date', [$from, $to])
                ->with('vendor')
                ->with('flavor')
                ->paginate(15);
        } else {
            return StockEntry::with('vendor')
                ->with('flavor')
                ->paginate(15);
        }
    }

    public function render()
    {
        return view('livewire.stock-in-history', [
            'data' => $this->read()
        ]);
    }
}
