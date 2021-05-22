<?php

namespace App\Http\Livewire;

use App\Models\Size;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class  Sizes extends Component
{
    use WithPagination;
    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;

    // mdodel variables

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
                Rule::unique('sizes', 'name')->ignore($this->modelId)
            ]
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
            'name.required' => 'The size field is required!'
        ];
    }

    /**
     * Load model data of this component.
     *
     * @return void
     */
    public function loadModel() : void
    {
        $data = Size::find($this->modelId);
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
        Size::create($this->modelData());
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
        return Size::where('name', 'like', '%' . $this->query . '%')->paginate(10);
    }

    /**
     * Update function.
     *
     * @return void
     */
    public function update() : void
    {
        $this->validate();
        Size::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;

        $this->dispatchBrowserEvent('response', [
            'icon' => 'success',
            'title' => 'Sucessfully updated.'
        ]);
    }

    /**
     * Delete function.
     *
     * @return void
     */
    public function delete() : void
    {
        Size::destroy($this->modelId);
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
        return view('livewire.sizes', [
            'data' => $this->read()
        ]);
    }
}
