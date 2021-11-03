<?php
namespace Usage\V1\Rest\Usage;

class UsageResourceFactory
{
    public function __invoke($services)
    {
        return new UsageResource();
    }
}
