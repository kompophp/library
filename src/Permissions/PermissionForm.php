<?php

namespace Kompo\Library\Permissions;

use Kompo\Library\Permissions\Permission;
use Kompo\{Form, Title, Input, SubmitButton};

class PermissionForm extends Form
{
    public $model = Permission::class;
    public $class = 'p-4';

    public function komponents()
    {
        return [
            Title::form(($this->modelKey() ? 'Add a' : 'Edit').' permission'),
            Input::form('Name'),
            Input::form('Guard')->name('guard_name')->default('web'),
            SubmitButton::form('Save')
        ];
    }

    public function authorize()
    {
        return auth()->user() && auth()->user()->hasRole('admin|super-admin');
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'guard_name' => 'required'
        ];
    }

}