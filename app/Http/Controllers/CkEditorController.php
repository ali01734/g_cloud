<?php

namespace nataalam\Http\Controllers;

use Illuminate\Http\Request;

use nataalam\Http\Requests;
use Phine\Path\Path;

class CkEditorController extends Controller
{
    public function uploadToTmpFolder() {

        $file = \Request::file('upload');
        $file->move(public_path('tmp/photos'));

        return [
            'uploaded' => 1,
            'url' => join_paths('/tmp/photos', $file->getFilename()),
            'filename' => $file->getFilename(),
        ];
    }
}
