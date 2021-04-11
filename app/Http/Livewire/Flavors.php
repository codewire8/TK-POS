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

    public $barcode, $name, $brand, $category, $size, $price, $reorder;

    // search variables

    public $search;

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
                 Rule::unique('flavors', 'name')->ignore($this->modelId)
            ],
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
            'name.required' => 'The flavor field is required!',
            'category.required' => 'The category field is required!',
            'size.required' => 'The size field is required!',
            'price.required' => 'The price field is required!'
        ];
    }

    /**
     * Load model data of this component.
     *
     * @return void
     */
    public function loadModel()
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
        return [
            'pcode' => Helper::IDGenerator(new Flavor, 'pcode', 5, 'P'),
            'barcode' => $this->barcode,
            'name' => $this->name,
            'brand_id' => $this->brand,
            'category_id' => $this->category,
            'size_id' => $this->size,
            'price' => $this->price,
            'reorder' => $this->reorder
        ];
    }


    public function updatemodelData()
    {
        return [
            'barcode' => $this->barcode,
            'name' => $this->name,
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
    public function create()
    {
        $this->validate();
        Flavor::create($this->createmodelData());
        $this->modalFormVisible = false;
        $this->reset();

        $this->dispatchBrowserEvent('response', [
            'icon' => 'success',
            'title' => 'Sucessfully saved.'
        ]);
    }

    /**
     * Display records.
     *
     * @return void
     */
    public function read()
    {
        return Flavor::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('pcode', 'like', '%' . $this->search . '%')
            ->with('category')
            ->with('size')
            ->with('brand')
            ->paginate(10);
    }


    /**
     * Update function.
     *
     * @return void
     */
    public function update()
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
    public function delete()
    {
        Flavor::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();

        $this->dispatchBrowserEvent('response', [
            'icon' => 'success',
            'title' => 'Sucessfully deleted.'
        ]);
    }

    /**
     * Displays modal when create button is click
     *
     * @return void
     */
    public function createShowModal()
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
    public function updateShowModal($id)
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
    public function deleteShowModal($id)
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
