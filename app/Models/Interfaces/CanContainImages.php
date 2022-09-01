<?php

namespace nataalam\Models\Interfaces;

/**
 * An content type that can contain images uploaded using CkEditor
 * @package nataalam\Models
 */
interface CanContainImages {
    /**
     * Moves images from tmp folder to storage folder
     */
    public function moveImagesToStorage();

    /**
     * Return the images storage folder path
     * @param null $photo filename
     * @return string
     */
    public function imagesStorage($photo = null);
}