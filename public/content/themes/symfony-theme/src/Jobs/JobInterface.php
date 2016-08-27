<?php

namespace SymfonyTheme\Jobs;

interface JobInterface
{
    /**
     * Runs the job.
     *
     * @return int
     */
    public function run();
}
