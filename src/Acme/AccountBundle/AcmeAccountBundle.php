<?php

namespace Acme\AccountBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AcmeAccountBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
