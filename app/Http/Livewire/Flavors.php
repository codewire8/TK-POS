<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Flavor;
use App\Models\Size;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use App\Helpers\Helper;

class  Flavors extends Component
{
    use WithPagination;
    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;

    // model variables

    public $barcode;
    public $name;
    public $brand;
    public $category;
    public $size;
    public $price;
    public $reorder;

    // search variables

    public $searchBy;
    public $search;

    private $pagination = 10;

    /**
     * Form Validation.
     *
     * @return void
     */

    public function rules()
    {
        return [
            'name' => [
                'required',
                'max:50',
                Rule::unique('flavors')->where(function ($query) {

                    return $query
                        ->whereName($this->name)
                        ->whereBrandId($this->brand)
                        ->whereCategoryId($this->category)
                        ->whereSizeId($this->size);
                })->ignore($this->modelId),
            ],
            'brand' => 'required',
            'category' => 'required',
            'size' => 'required',
            'price' => 'required'
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
            'name.unique' => 'This product is already exist in our records.',
            'category.required' => 'The category field is required.',
            'size.required' => 'The size field is required.',
            'price.required' => 'The price field is required.'
        ];
    }

    /**
     * Load model data of this component.
     *
     * @return void
     */
    public function loadModel(): void
    {
        $data = Flavor::find($this->modelId);
        $this->pcode = $data->pcode;
        $this->barcode = $data->barcode;
        $this->name = $data->name;
        $this->brand = $data->brand_id;
        $this->category = $data->category->id;
        $this->size = $data->size->id;
        $this->price = $data->price;
        $this->reorder = $data->reorder;
    }

    /**
     * Model data of this component.
     *
     * @return void
     */
    public function createmodelData()
    {
        $productDesc = '';

        if ($this->size !== null) {
            $size = Size::find($this->size);
            $productDesc = $this->name . ' (' . $size->name . ') ';
        } else {
            $productDesc = $this->name;
        }

        return [
            'pcode' => Helper::IDGenerator(new Flavor, 'pcode', 5, 'P'),
            'barcode' => $this->barcode,
            'name' => $productDesc,
            'brand_id' => $this->brand,
            'category_id' => $this->category,
            'size_id' => $this->size,
            'price' => $this->price,
            'reorder' => $this->reorder
        ];
    }


    public function updatemodelData() 
    {
        $productDesc = '';

        if ($this->size !== null) {
            $size = Size::find($this->size);
            $productDesc = $this->name . ' (' . $size->name . ') ';
        } else {
            $productDesc = $this->name;
        }

        return [
            'barcode' => $this->barcode,
            'name' => $productDesc,
            'brand_id' => $this->brand,
            'category_id' => $this->category,
            'size_id' => $this->size,
            'price' => $this->price,
            'reorder' => $this->reorder
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
        Flavor::create($this->createmodelData());
        $this->modalFormVisible = false;

        $this->dispatchBrowserEvent('response', [
            'icon' => 'success',
            'title' => 'Sucessfully saved.'
        ]);

        $this->reset();
    }

    /**
     * Display records.
     *
     * @return void
     */
    public function read()
    {
        if ($this->search !== null && $this->searchBy === 'Product Code') {
            dd('pcode');
            return Flavor::where('pcode', '=' . $this->searchBy)
                ->orWhere('pcode', 'like', '%' . $this->search . '%')
                ->with('category')
                ->with('size')
                ->with('brand')
                ->paginate($this->pagination);
        } else if ($this->search !== null && $this->searchBy === 'Description') {
            dd('desc');
            return Flavor::where('name', '=' . $this->searchBy)
                ->orWhere('name', 'like', '%' . $this->search . '%')
                ->with('category')
                ->with('size')
                ->with('brand')
                ->paginate($this->pagination);
        } else {
            return Flavor::with('category')
                ->with('size')
                ->with('brand')
                ->paginate($this->pagination);
        }
    }


    /**
     * Update function.
     *
     * @return void
     */
    public function update(): void
    {
        $this->validate();
        Flavor::find($this->modelId)->update($this->updatemodelData());
        $this->modalFormVisible = false;

        $this->dispatchBrowserEvent('response', [
            'icon' => 'success',
            'title' => 'Sucessfully updated.'
        ]);

        $this->reset();
    }


    /**
     * Delete function.
     *
     * @return void
     */
    public function delete(): void
    {
        Flavor::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;

        $this->dispatchBrowserEvent('response', [
            'icon' => 'success',
            'title' => 'Sucessfully deleted.'
        ]);

        $this->reset();
    }

    /**
     * Displays modal when create button is click
     *
     * @return void
     */
    public function createShowModal(): void
    {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
    }

    /**
     * Show modal in update mode.
     *
     * @param  mixed $id
     * @return void
     */
    public function updateShowModal($id): void
    {
        $this->resetValidation();
        $this->modalFormVisible = true;
        $this->modelId = $id;
        $this->loadModel();
    }

    /**
     * Shows delete confirmation dialog.
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteShowModal($id): void
    {
        $this->modelId = $id;
        $this->modalConfirmDeleteVisible = true;
    }

    public function render()
    {
        return view('livewire.flavors', [
            'data' => $this->read(),
            'categories' => Category::all(),
            'sizes' => Size::all(),
            'brands' => Brand::all(),
        ]);
    }
}
