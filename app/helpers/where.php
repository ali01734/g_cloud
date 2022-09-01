<?php
use Illuminate\Database\Eloquent\Model;

/**
 * Makes a where clause testing that the id equals to the id of $related
 * @param $related Model
 * @return Closure
 */
function withIdOf($related) {
    return function($query) use($related) {
        $query->where('id', $related->id);
    };
}

/**
 * Makes a where clause testing the id.
 * @param $id integer
 * @return Closure
 */
function withId($id) {
    return function($query) use($id) {
        $query->where('id', $id);
    };
}

/**
 * Used to set the value of a foreign key by passing the result Closure
 * to each() method of a collection
 * example:
 *  $courses->each(set_fk('subject_id', $subject))
 * @param $fk string The name of the foreign key
 * @param $from * The referenced model
 * @param string $references string The name of the primary key.
 * @return Closure
 */
function set_fk($fk, $from, $references = 'id') {
    return function($row) use($from, $fk, $references) {
        $row->{$fk} = $from->{$references};
    };
}