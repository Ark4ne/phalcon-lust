<?php
/**
 * Created by PhpStorm.
 * User: gallegret
 * Date: 15/07/2016
 * Time: 11:57
 */

namespace Support;


trait TestListenize
{
    /**
     * @var array
     */
    protected $views;

    /**
     * @param string     $seek
     * @param array|null $data
     *
     * @return void
     */
    public function view($seek, array $data = null)
    {
        $this->views[$seek][] = $data;
    }

    /**
     * @param string $seek
     *
     * @return bool
     */
    public function hasView($seek)
    {
        return isset($this->views[$seek]);
    }

    /**
     * @param string $seek
     *
     * @return array|null
     */
    public function getView($seek)
    {
        return $this->hasView($seek) ? $this->views[$seek] : null;
    }
}