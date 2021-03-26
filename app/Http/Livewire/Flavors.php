<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Flavor;
use App\Models\Size;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class  Flavors extends Component
{
    use WithPagination;
    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;

    // model variables

    public $name, $category, $size, $price;

    // search variables

    public $query;

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
            'category.size' => 'The size field is required!',
            'category.price' => 'The price field is required!'
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
        $this->name = $data->name;
        $this->category = $data->category->id;
        $this->size = $data->size->id;
        $this->price = $data->price;
    }

     /**
     * Model data of this component.
     *
     * @return void
     */
    public function modelData()
    {
        return [
            'name' => $this->name,
            'category_id' => $this->category,
            'size_id' => $this->size,
            'price' => $this->price,
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
        Flavor::create($this->modelData());
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
        return Flavor::with('category')
            ->where('name', 'like', '%' . $this->query . '%')
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
        Flavor::find($this->modelId)->update($this->modelData());
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
            'sizes' => Size::all()
        ]);
    }


}
