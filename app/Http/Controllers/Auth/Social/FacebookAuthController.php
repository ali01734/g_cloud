<?php

namespace nataalam\Http\Controllers\Auth\Social;

class FacebookAuthController extends AbstractAuthController
{

    /**
     * FacebookAuthController constructor.
     */
    public function __construct()
    {
        parent::__construct('facebook');
    }
}
