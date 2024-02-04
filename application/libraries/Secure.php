<?php

use Hashids\Hashids;

class Secure extends Hashids
{
    protected $salt = "jamesbonlabalibi";
    protected $length = 10;
    public function __construct()
    {
        parent::__construct($this->salt, $this->length);
    }
}
