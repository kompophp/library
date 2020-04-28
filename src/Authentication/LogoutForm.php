<?php

namespace Kompo\Library\Authentication;

use Kompo\Link;

class LogoutForm extends \VlForm
{
    protected $redirectTo = '/';

    public function handle($request)
    {
        \Auth::guard()->logout();
        //$locale = session('kompo_locale');  //for multi-lang sites
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        //session( ['kompo_locale' => $locale] );  //for multi-lang sites
    }

    public function komponents()
    {
        return [
            Link::form('Logout')->submit()
        ];
    }

    public function authorization()
    {
        return \Auth::check();
    }

}