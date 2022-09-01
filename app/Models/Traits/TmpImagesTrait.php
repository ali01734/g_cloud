<?php

namespace nataalam\Models\Traits;

use File;

trait TmpImagesTrait
{
    public function moveImagesToStorage()
    {
        $fields = self::$ckEditorFields;

        $photos = [];
        foreach ($fields as $field) {
            $photos = array_merge(
                $photos,
                get_all_preg_matches(
                    '#<img *src=[\'"]/tmp/photos/([^"\']*)[\'"]#',
                    $this->{$field}
                )[1]
            );
        }

        foreach ($photos as $photo) {
            File::move(
                tmp_img_path($photo),
                $this->imagesStorage($photo)
            );
        }


        foreach($fields as $field) {
            $this->{$field} = preg_replace(
                '#/tmp/photos#',
                join_paths(self::$publicImgFolder, $this->id),
                $this->{$field}
            );
        }

    }
}