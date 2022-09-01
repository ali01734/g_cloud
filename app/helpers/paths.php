<?php

function tmp_img_path($photo = null) {
    return public_path(join_paths(config('app.tmp_photo_folder'), $photo));
}