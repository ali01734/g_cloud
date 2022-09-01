<?php

namespace nataalam\Models\Traits;

use File;

trait HasFileAttrTrait {
    private function hasFileAttribute(string $dir) {
        $path = storage_path($dir) . "/$this->id.pdf";
        return File::exists($path);
    }
}