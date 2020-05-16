<?php

namespace Torralbodavid\SimpleRecaptchaV3;

class SimpleRecaptchaV3
{
    protected $id;

    public function __construct()
    {
        $this->id = 0;
    }

    public function generateId(): string
    {
        $this->id = $this->id+1;

        return encrypt($this->id);
    }

}
