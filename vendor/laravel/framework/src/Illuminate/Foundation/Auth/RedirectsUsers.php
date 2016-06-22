<?php

namespace Illuminate\Foundation\Auth;

trait RedirectsUsers
{
    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (property_exists($this, 'redirectPath')) {
            return $this->redirectPath;
        }

<<<<<<< HEAD
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
=======
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
>>>>>>> 019be12074db53f0325327492a5cf9f777403583
    }
}
