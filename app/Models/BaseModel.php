<?php

namespace App\Models;

use Eloquent;

class BaseModel extends Eloquent {
    public static function indexById() {
        $record = Self::get();
        $result = [];
        foreach ($record as $key => $value) {
            $result[$value->id] = $value;
            // $result[$value->id] = json_decode($value);
        }
        return $result;
    }

    public static function options($display = 'nama') {
        $record = Self::get();
        $result = [];
        foreach ($record as $key => $value) {
            $result[$value->id] = $value->$display;
            // $result[$value->id] = json_decode($value);
        }
        return $result;
    }
}
