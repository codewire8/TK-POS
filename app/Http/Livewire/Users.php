<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class  Users extends Component
{
    use WithPagination;
    public $modalFormVisible;
    public $modelId;

    public $name, $role;

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
                 Rule::unique('users', 'name')->ignore($this->modelId)
            ],
            'role' => [
                'required'
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
            'name.required' => 'The name field is required!',
            'role.required' => 'The role field is required!'
        ];
    }

    /**
     * Load model data of this component.
     *
     * @return void
     */
    public function loadModel()
    {
        $data = User::find($this->modelId);
        $this->name = $data->name;
        $this->role = $data->role;
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
            'role' => $this->role
        ];
    }

    /**
     * Display records.
     *
     * @return void
     */
    public function read()
    {
        return User::paginate(10);
    }

    /**
     * Update function.
     *
     * @return void
     */
    public function update()
    {
        $this->validate();
        User::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;

         $this->dispatchBrowserEvent('response', [
            'icon' => 'success',
            'title' => 'Sucessfully updated.'
        ]);
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

    public function render()
    {
        return view('livewire.users', [
            'data' => $this->read()
        ]);
    }


}
