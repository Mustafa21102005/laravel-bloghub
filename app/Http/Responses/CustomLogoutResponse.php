<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;

class CustomLogoutResponse implements LogoutResponseContract
{
    /**
     * Create an HTTP response representing the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        // redirect to posts after logging out
        return redirect('/posts');
    }
}
