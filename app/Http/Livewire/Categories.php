<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class  Categories extends Component
{
    use WithPagination;

    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;

    // model variables

    public $name;

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
                    Rule::unique('categories', 'name')->ignore($this->modelId),
                ]
        ];
    }


    /**
     * Custom Error Validataion
     *
     * @return void
     */
    public function messages()
    {
        return [
            'name.required' => 'The category field is required!'
        ];
    }

    /**
     * Load model data of this component.
     *
     * @return void
     */
    public function loadModel() : void
    {
        $data = Category::find($this->modelId);
        $this->name = $data->name;
    }

     /**
     * Model data of this component.
     *
     * @return void
     */
    public function modelData()
    {
        return [
            'name' => $this->name
        ];
    }

    /**
     * Create function for this component.
     *
     * @return void
     */
    public function create() : void
    {
        $this->validate();
        Category::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();

        $this->dispatchBrowserEvent('response', [
            'icon' => 'success',
            'title' => 'Successfully saved.'
        ]);
    }

    /**
     * Display records.
     *
     * @return void
     */
    public function read()
    {
        return Category::where('name', 'like', '%' . $this->query . '%')
            ->paginate(10);
    }

    /**
     * Update function.
     *
     * @return void
     */
    public function update() : void
    {
        $this->validate();
        Category::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;

        $this->dispatchBrowserEvent('response', [
            'icon' => 'success',
            'title' => 'Successfully updated.'
        ]);
        $this->reset();
    }

    /**
     * Delete function.
     *
     * @return void
     */
    public function delete() : void
    {
        Category::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;

         $this->dispatchBrowserEvent('response', [
            'icon' => 'success',
            'title' => 'Successfully deleted.'
        ]);
        $this->reset();
    }

    /**
     * Displays modal when create button is click
     *
     * @return void
     */
    public function createShowModal() : void
    {
        $this->resetValidation();
        $this->modalFormVisible = true;
    }

    /**
     * Show modal in update mode.
     *
     * @param  mixed $id
     * @return void
     */
    public function updateShowModal($id) : void
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
    public function deleteShowModal($id) : void
    {
        $this->modelId = $id;
        $this->modalConfirmDeleteVisible = true;
    }


    public function render()
    {
        return view('livewire.categories', [
            'data' => $this->read()
        ]);
    }


}
