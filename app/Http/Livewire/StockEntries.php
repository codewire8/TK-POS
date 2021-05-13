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
    public $modalErrorProduct;

    /**Data model */

    public $refno;
    public $stock_in_by;
    public $stock_in_date;
    public $vendorId;
    public $productId;

    /**
     *
        Temporary variables
     *
     **/

    // Vendor details

    public $contact_person;
    public $address;

    // Cart items

    public $items = [];
    public $productCode;
    public $productDescription;
    public $qty = 1;

    /**
     * Search variable
     */

    public $query;

    public function hydrate()
    {
        $this->stock_in_date = Carbon::now()->format('Y-m-d');
    }

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
            'vendorId' => 'required',
            'productId' => 'required',
            'qty' => 'required|numeric|min:1',
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
            'refno.required' => '*Reference No. is required.',
            'stock_in_by.required' => '*Stock In By is required.',
            'stock_in_date.required' => '*Stock In Date is required.',
            'vendorId.required' => '*Vendor is required.',
            'productId.required' => '*Product(s) are required. Click "BROWSE PRODUCTS" to add an item(s).'
        ];
    }


    /**
     * Create function for this component.
     *
     * @return void
     */
    public function create(): void
    {
        $this->validate();

        $items = $this->items;

        foreach ($items as $key => $item) {

            StockEntry::create([
                'refno' => $this->refno,
                'stock_in_by' => $this->stock_in_by,
                'stock_in_date' => $this->stock_in_date,
                'vendor_id' => $this->vendorId,
                'description' => $items[$key]['productDescription'],
                'flavor_id' => $items[$key]['pId'],
                'qty' => $items[$key]['qty']
            ]);
        }

        foreach ($items as $key => $item) {
            Flavor::find($items[$key]['pId'])->increment('qty', $items[$key]['qty']);
        }


        $this->dispatchBrowserEvent('response', [
            'icon' => 'success',
            'title' => 'Sucessfully saved.'
        ]);

        $this->modalFormVisible = false;
        $this->reset();
    }

    /**
     * List of products
     *
     * @return void
     */
    public function products()
    {
        return Flavor::where('pcode', 'like', '%' . $this->query . '%')
            ->orWhere('name', 'like', '%' . $this->query . '%')
            ->with('size')->paginate(20);
    }

    /**
     * Show List of products
     *
     * @return void
     */
    public function showProductListModal(): void
    {
        $this->modalFormVisible = true;
    }

    /**
     * Add selected item
     *
     * @param  mixed $id
     * @return void
     */
    public function addSelectedItem($id): void
    {
        $this->productId = $id;

        $data = Flavor::with('size')->find($this->productId);
        $this->productId = $data->id;
        $this->productCode = $data->pcode;
        $this->productDescription = $data->name . ' (' . $data->size->name . ') ';

        $this->itemRow();
    }

    /**
     * Selected item row
     *
     * @return void
     */
    public function itemRow(): void
    {
        if (($key = array_search($this->productCode, array_column($this->items, 'productCode'))) !== false) {
            $this->items[$key]['qty'] += 1;
        } else {
            array_push($this->items, [
                'pId' => $this->productId,
                'productCode' => $this->productCode,
                'productDescription' => $this->productDescription,
                'qty' => $this->qty
            ]);
        }
    }

    /**
     * Decrease quantity
     *
     * @return void
     */
    public function decrement($id): void
    {
        if (($key = array_search($id, array_column($this->items, 'pId'))) !== false) {
            $this->items[$key]['qty'] -= 1;
        }
    }

    /**
     * Increase quantity
     *
     * @return void
     */
    public function increment($id): void
    {
        if (($key = array_search($id, array_column($this->items, 'pId'))) !== false) {
            $this->items[$key]['qty'] += 1;
        }
    }

    /**
     * Remove selected item
     *
     * @param  mixed $index
     * @return void
     */
    public function removeSelectedItem($index): void
    {
        unset($this->items[$index]);

        $this->items = array_values($this->items);
    }


    /**
     * Genereate Reference No. for eacht entry
     *
     * @return void
     */
    public function generateReferenceNo(): void
    {
        $this->refno = Helper::IDGenerator(new StockEntry, 'refno', 6, Carbon::now()->format('mdy'));
    }


    /**
     * Get vendor details
     *
     * @return void
     */
    public function getVendorDetails(): void
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

    /**
     * Render data
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.stock-entries', [
            'vendors' => Vendor::all(),
            'products' => $this->products()
        ]);
    }
}
