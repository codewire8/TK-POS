<?php

namespace App\Http\Livewire;

use App\Models\StockEntry;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\Helper;
use App\Models\Flavor;
use App\Models\Vendor;
use Carbon\Carbon;

class  StockEntries extends Component
{
    use WithPagination;
    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;

    public $items = [];

    public $refno;
    public $stock_in_by;
    public $stock_in_date;

    public $vendorId;
    public $contact_person;
    public $address;

    // Cart items
    public $pcode;
    public $product;
    public $qty = 1;

    // search var

    public $query;


    /**
     * Form Validation.
     *
     * @return void
     */

    public function rules()
    {
        return [
            'refno' => 'required|max:255',
            'stock_in_by' => 'required|max:255',
            'stock_in_date' => 'required|date',
            'vendor_id' => 'required',
            'flavor_id' => 'required',
            'qty' => 'required|numeric',
        ];
    }

        /**
     * Custom Error  Validataion
     *
     * @return void
     */
    public function messages()
    {
        return [
            'refno' => 'The reference no. field is required!',
            'stock_in_by' => 'The stock in by field is required!',
            'stock_in_date' => 'The stock in date field is required!',
            'vendor_id' => 'The vendor field is required!',
            'flavor_id' => 'The product field is required!',
            'qty' => 'The quantity field is required!',
        ];
    }

     /**
     * Model data of this component.
     *
     * @return void
     */
    public function modelData()
    {
        return [
            'refno' => Helper::IDGenerator(new StockEntry, 'refno', 5, 'REF'),
            'stock_in_by' => 'The stock in by field is required!',
            'stock_in_date' => 'The stock in date field is required!',
            'vendor_id' => 'The vendor field is required!',
            'flavor_id' => 'The product field is required!',
            'qty' => 'The quantity field is required!',
        ];
    }

    /**
     * Create function for this component.
     *
     * @return void
     */
    public function create()
    {
        $this->validate();
        StockEntry::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();

        $this->dispatchBrowserEvent('response', [
            'icon' => 'success',
            'title' => 'Sucessfully saved.'
        ]);
    }

    public function products()
    {
        return Flavor::where('pcode', 'like', '%' . $this->query . '%')
            ->orWhere('name', 'like', '%' . $this->query . '%')
            ->with('size')->paginate(10);
    }

    /**
     * Show List of products
     *
     * @return void
     */
    public function showProductListModal()
    {
        $this->modalFormVisible = true;
    }

    public function getSelectedItems($id): void
    {
        $this->modelId = $id;

        $data = Flavor::with('size')->find($this->modelId);
        $this->pcode = $data->pcode;
        $this->product = $data->name . ' (' . $data->size->name . ') ';
        $this->qty = 0;

        $this->addDataRow();
    }

    public function addDataRow()
    {
        array_push($this->items, [
            'pcode' => $this->pcode,
            'product' => $this->product,
            'qty' => 1
        ]);
    }

    /**
     * Genereate Reference No. for eacht entry
     *
     * @return void
     */
    public function generateReferenceNo()
    {
       $this->refno = Helper::IDGenerator(new StockEntry, 'refno', 6, Carbon::now()->format('Ymd'));
    }


    public function getVendorDetails()
    {
        if ($this->vendorId !== '') {
            $data = Vendor::find($this->vendorId);
            $this->contact_person = $data->contact_person;
            $this->address = $data->address;
        } else {
            $this->contact_person = '';
            $this->address = '';
        }
    }

    public function render()
    {
        return view('livewire.stock-entries', [
            'vendors' => Vendor::all(),
            'products' => $this->products()
        ]);
    }


}
