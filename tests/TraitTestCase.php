<?php

/**
 * Created by PhpStorm.
 * User: gallegret
 * Date: 07/07/2016
 * Time: 15:10
 */
trait TraitTestCase
{
    /**
     * @return mixed
     */
    protected function kernel()
    {
        return \App\Http\Kernel::class;
    }
}