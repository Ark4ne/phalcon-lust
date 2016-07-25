<?php

namespace Luxury;

/**
 * Class Adapter
 *
 * @package Luxury
 */
abstract class Adapter
{
    /**
     * Supported Adapters
     *
     * @var array
     */
    protected $supported;

    /**
     * Default Adapter
     *
     * @var string
     */
    protected $default;

    /**
     * @var array
     */
    private $adapters = [];

    /**
     * @var mixed
     */
    private $adapter;

    /**
     * @param null $use
     *
     * @return mixed
     */
    public function uses($use = null)
    {
        if (empty($use) && empty($this->adapter)) {
            $this->adapter = $this->adapters[$this->default] = new $this->default();
        }
        if (!empty($use)) {
            foreach ($this->adapters as $_adapter) {
                if ($use === $_adapter) {
                    if (isset($this->adapters[$_adapter])) {
                        $this->adapter = $this->adapters[$_adapter];
                    } else {
                        $this->adapter = $this->adapters[$_adapter] = new $_adapter();
                    }
                }
            }
        }
        if (empty($this->adapter)) {
            $this->adapter = $this->adapters[$this->default] = new $this->default();
        }

        return $this->adapter;
    }
}
