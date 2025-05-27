<?php

namespace App\Traits;

trait NormalizeName
{
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = mb_strtolower(trim($value ?? ''));
    }
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = mb_strtolower(trim($value ?? ''));
    }
    public function getFirstNameAttribute($value)
    {
        return mb_strtolower(trim($value ?? ''));
    }

    public function getLastNameAttribute($value)
    {
        return mb_strtolower(trim($value ?? ''));
    }
}
