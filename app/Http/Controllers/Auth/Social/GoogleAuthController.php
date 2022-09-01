<?php

namespace nataalam\Http\Controllers\Auth\Social;

class GoogleAuthController extends AbstractAuthController
{
    public function __construct()
    {
        parent::__construct('google');
    }
}
