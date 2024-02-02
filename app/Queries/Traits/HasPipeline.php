<?php

namespace App\Queries\Traits;

use Illuminate\Support\Facades\Pipeline;

trait HasPipeline
{
    /**
     * @param array<int,mixed> $pipes
     * @return \Illuminate\Pipeline\Pipeline
     */
    public function through(array $pipes): \Illuminate\Pipeline\Pipeline
    {
        return Pipeline::send($this)->through($pipes);
    }
}
