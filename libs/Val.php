<?php

class Val
{
    function __construct()
    {
    }

    public function minlength($data, $arg)
    {
        if (strlen($data) < $arg) {
            return "La chaine doit avoir au moins " . $arg . "caractères";
        }
    }

    public function maxlength($data, $arg)
    {
        if (strlen($data) > $arg) {
            return "La chaine ne doit pas depasser " . $arg . "caractères";
        }
    }

    public function _digit($data)
    {
        if (ctype_digit($data) == false) {
            return "Ceci doit être un chiffre ou un nombre";
        }
    }

    public function __call($name, $arguments)
    {
        throw new Exception("$name n'existe pas dans " . __CLASS__);
    }
}
