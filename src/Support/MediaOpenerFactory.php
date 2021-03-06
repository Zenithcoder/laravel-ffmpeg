<?php

namespace ProtoneMedia\LaravelFFMpeg\Support;

use Illuminate\Support\Traits\ForwardsCalls;
use ProtoneMedia\LaravelFFMpeg\Drivers\PHPFFMpeg;
use ProtoneMedia\LaravelFFMpeg\MediaOpener;

class MediaOpenerFactory
{
    use ForwardsCalls;

    private $defaultDisk;
    private $driver;

    public function __construct(string $defaultDisk, PHPFFMpeg $driver)
    {
        $this->defaultDisk = $defaultDisk;
        $this->driver      = $driver;
    }

    /**
    * Handle dynamic method calls into the MediaOpener.
    *
    * @param  string  $method
    * @param  array  $parameters
    * @return mixed
    */
    public function __call($method, $parameters)
    {
        return $this->forwardCallTo(
            new MediaOpener($this->defaultDisk, $this->driver),
            $method,
            $parameters
        );
    }
}
