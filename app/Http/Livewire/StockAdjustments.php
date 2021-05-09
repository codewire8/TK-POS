<?php

namespace App\Http\Livewire;

use App\Models\Flavor;
use App\Models\StockAdjustment;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class  StockAdjustments extends Component
{
    use WithPagination;
    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;

    // search variables

    public $query;

    /**
     * Form Validation.
     *
     * @return void
     */

    public function rules()
    {
        return [];
    }

    /**
     * Custom Error  Validataion
     *
     * @return void
     */
    public function messages()
    {
        return [];
    }

    /**
     * Load model data of this component.
     *
     * @return void
     */
    public function loadModel()
    {
        $data = StockAdjustment::find($this->modelId);

        // Assign your variables here eg: $this->publicVar = $data->param;.
    }

    /**
     * Model data of this component.
     *
     * @return void
     */
    public function modelData()
    {
        return [];
    }

    /**
     * Create function for this component.
     *
     * @return void
     */
    public function create()
    {
        $this->validate();
        StockAdjustment::create($this->modelData());
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
        if ($this->query !== null) {
            return Flavor::where('pcode', 'like', '%' . $this->query . '%')
                ->orWhere('name', 'like', '%' . $this->query . '%')
                ->with('size')
                ->with('brand')
                ->with('category')
                ->paginate(5);
        } else {
            return Flavor::paginate(5);
        }
    }

    /**
     * Update function.
     *
     * @return void
     */
    public function update()
    {
        $this->validate();
        StockAdjustment::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    /**
     * Delete function.
     *
     * @return void
     */
    public function delete()
    {
        StockAdjustment::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
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
        $this->reset();
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
        return view('livewire.stock-adjustments', [
            'data' => $this->read()
        ]);
    }
}
