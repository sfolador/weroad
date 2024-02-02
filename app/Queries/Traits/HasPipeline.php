<?php

namespace App\Queries\Traits;

use Illuminate\Support\Facades\Pipeline;

trait HasPipeline
{
    /**
     * @param  array<int,mixed>  $pipes
     */
    public function through(array $pipes): \Illuminate\Pipeline\Pipeline
    {
        return Pipeline::send($this)->through($pipes);
    }
}
