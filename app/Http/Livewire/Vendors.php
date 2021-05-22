<?php

namespace App\Http\Livewire;

use App\Models\Vendor;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class  Vendors extends Component
{
    use WithPagination;
    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;

    // public varialbes

    public $name, $address, $contact_person, $contact_person_telno, $contact_person_email;

    // search variables

    public $query;

    /**
     * Return to page one when searching
     */
    
    public function updatedQuery()
    {
        $this->gotoPage(1);
    }

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
                'max:255',
                Rule::unique('vendors', 'name')->ignore($this->modelId)
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
            'name.required' => 'The vendor field is required!'
        ];
    }

    /**
     * Load model data of this component.
     *
     * @return void
     */
    public function loadModel() : void
    {
        $data = Vendor::find($this->modelId);
        $this->name = $data->name;
        $this->address = $data->address;
        $this->contact_person = $data->contact_person;
        $this->contact_person_telno = $data->contact_person_telno;
        $this->contact_person_email = $data->contact_person_email;
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
            'address' => $this->address,
            'contact_person' => $this->contact_person,
            'contact_person_telno' => $this->contact_person_telno,
            'contact_person_email' => $this->contact_person_email,
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
        Vendor::create($this->modelData());
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
        return Vendor::where('name', 'like', '%' . $this->query . '%')
            ->paginate(10);
    }

    /**
     * Update function.
     *
     * @return void
     */
    public function update(): void
    {
        $this->validate();
        Vendor::find($this->modelId)->update($this->modelData());
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
        Vendor::destroy($this->modelId);
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
        return view('livewire.vendors', [
            'data' => $this->read()
        ]);
    }
}
