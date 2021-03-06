<?php

namespace Kompo\Library\Authentication;

use Kompo\{Form, Hidden, Input, Password, SubmitButton};
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordForm extends Form
{
    use ResetsPasswords;

    public $class = 'p-4 mx-auto';
    public $style = 'max-width:350px';
    protected $redirectTo = '/';

    public function handle()
    {
        return $this->reset(request());
    }

    public function komponents()
    {
        return [
            Hidden::form('token')->value($this->parameter('token')),
            Input::form('Email')->name('email')->value($this->parameter('email')),
            Password::form('Password')->name('password'),
            Password::form('Password Confirmation')->name('password_confirmation'),
            SubmitButton::form('Reset Password')
        ];
    }

    public function authorize()
    {
        return \Auth::guest();
    }

    public function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8'
        ];
    }

}