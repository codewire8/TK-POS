<?php

namespace App\Http\Livewire;

use App\Models\UserPermission;
use Livewire\Component;
use Livewire\WithPagination;

class  UserPermissions extends Component
{
    use WithPagination;

    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;

    public $role;
    public $routeName;

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
            'role' => 'required',
            'routeName' => 'required'
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
            'role.required' => 'The role field is required!',
            'routeName.required' => 'The route name field is required!',
        ];
    }

    /**
     * Load model data of this component.
     *
     * @return void
     */
    public function loadModel() : void
    {
        $data = UserPermission::find($this->modelId);
        $this->role = $data->role;
        $this->routeName = $data->route_name;
    }

     /**
     * Model data of this component.
     *
     * @return void
     */
    public function modelData()
    {
        return [
            'role' => $this->role,
            'route_name' => $this->routeName
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
        UserPermission::create($this->modelData());
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
        return UserPermission::where('role', 'like', '%' . $this->query . '%')
            ->orWhere('route_name', 'like', '%' . $this->query . '%')
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
        UserPermission::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    /**
     * Delete function.
     *
     * @return void
     */
    public function delete() : void
    {
        UserPermission::destroy($this->modelId);
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
    public function deleteShowModal($id) : void
    {
        $this->modelId = $id;
        $this->modalConfirmDeleteVisible = true;
    }

    public function render()
    {
        return view('livewire.user-permissions', [
            'data' => $this->read()
        ]);
    }


}
