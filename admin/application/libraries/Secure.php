<?php

use Hashids\Hashids;

class Secure extends Hashids
{
    protected $salt = "suksespasti123";
    protected $length = 10;
    public function __construct()
    {
        parent::__construct($this->salt, $this->length);
    }
}
