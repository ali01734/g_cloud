<?php

require 'paths.php';
require 'where.php';

function join_paths() {
    $args = func_get_args();
    $paths = array();
    foreach ($args as $arg) {
        $paths = array_merge($paths, (array)$arg);
    }

    $trimedPaths = [];

    foreach ($paths as $key => $path) {
        if (!$key)
            $trimedPaths[] = ($path[0] == '/' ? '/' : '') . trim($path, "/");
        else
            $trimedPaths[] = trim($path, "/");
    }

    $paths = array_filter($trimedPaths);
    return join('/', $paths);
}

function get_all_preg_matches($regex, $target) {
    $matches = [];
    preg_match_all($regex, $target, $matches);
    return $matches;
}