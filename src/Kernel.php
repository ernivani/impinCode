<?php

// /traumas/src/Kernel.php

namespace App;

use Ernicani\Kernel\BaseKernel;
use Ernicani\Kernel\MicroKernelTrait;


class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function __construct()
    {
        session_start();
        $this->boot(); 
        session_write_close();
    }
}
