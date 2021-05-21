<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class  Brands extends Component
{
    use WithPagination;
    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;

    // variables

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
            'name' =>  [
                    'required',
                    'max:50',
                    Rule::unique('brands', 'name')
                        ->ignore($this->modelId),
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
            'message.required' => 'The brand field is required!'
        ];
    }

    /**
     * Load model data of this component.
     *
     * @return void
     */
    public function loadModel() : void
    {
        $data = Brand::find($this->modelId);
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
        Brand::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }

    /**
     * Display records.
     *
     * @return void
     */
    public function read()
    {
        return Brand::where('name', 'like', '%' . $this->query . '%')
            ->orderby('name')
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
        Brand::find($this->modelId)->update($this->modelData());
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
        Brand::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();

        $this->dispatchBrowserEvent('response', [
            'icon' => 'success',
            'title' => 'Successfully deleted.'
        ]);
    }

    /**
     * Displays modal when create button is click
     *
     * @return void
     */
    public function createShowModal() : void
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
        return view('livewire.brands', [
            'data' => $this->read()
        ]);
    }


}
