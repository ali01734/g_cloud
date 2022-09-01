<?php

namespace nataalam;

use nataalam\Models\User;

trait BeAdminTrait {
    protected function beAdmin() {
        $this->be(User::where('is_admin', true)->first());
        return $this;
    }
}