<?php

namespace App\Http\Livewire;

use App\Models\Flavor;
use App\Models\StockAdjustment;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\Helper;
use Carbon\Carbon;

class StockAdjustments extends Component
{

    use WithPagination;

    public $modelId;
    public $refno;
    public $pcode;
    public $desc;
    public $qty;
    public $action;
    public $remarks;
    public $product;
    public $user;

    public $query;

    public $pagination = 5;


    /**
     * Validation
     *
     * @return void
     */
    public function rules()
    {
        return [
            'refno' => 'required',
            'qty' => 'required',
            'action' => 'required',
            'remarks' => 'required',
            'product' => 'required',
            'user' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'refno.required' => 'The reference no. field is required.',
            'qty.required' => 'The quantity is field required.',
            'action.required' => 'The quantity is field required.',
            'remarks.required' => 'The quantity is field required.',
            'product.required' => 'The quantity is field required.',
            'user.required' => 'The quantity is field required.',
        ];
    }

    /**
     * Go to page one every search
     *
     * @return void
     */
    public function updatingQuery(): void
    {
        $this->gotoPage(1);
    }

    /**
     * Reflect selected items in the fields
     *
     * @return void
     */
    public function getSelectedProduct($id): void
    {
        $this->modelId = $id;

        $data = Flavor::with('size')->find($this->modelId);

        if ($this->refno !== '') {
            $this->refno = Helper::IDGenerator(new StockAdjustment, 'refno', 6, 'SA' . Carbon::now()->format('mdy'));
        }

        $this->pcode = $data->pcode;
        $this->desc = $data->name . ' ( ' . $data->size->name . ' )';
    }

    /**
     * Save function
     *
     * @return void
     */
    public function create() : void
    {

    }

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
                ->paginate($this->pagination);
        } else {
            return Flavor::paginate($this->pagination);
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
