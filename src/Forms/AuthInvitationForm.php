<?php
namespace Kompo\Library\Forms;

use Illuminate\Support\Str;
use Vuravel\Auth\Events\InvitedToRegister;
use Vuravel\Auth\Invitation;
use Kompo\{Hidden, Input, Select, SubmitButton};
use Kompo\Form;

class AuthInvitationForm extends Form
{
	public $class = 'p-4 mx-auto';
	public $style = 'max-width:350px';

	public $model = Invitation::class;

	public function afterSave($invitation)
	{
		event(new InvitedToRegister($invitation));
	}

	public function response($model)
	{
		return responseInSuccessModal(__('Your invitation has been sent!'));
	}

	public function komponents()
	{
		return [
			Hidden::form('token')->value(Str::random(60)),
			Input::form(__('Email'))->name('email'),
			Select::form(__('Role'))->name('roles')->optionsFrom('id','name'),
			SubmitButton::form(__('Send invitation'))
		];
	}

	public function rules()
	{
		return [
			'email' => 'required|email'
		];
	}

}