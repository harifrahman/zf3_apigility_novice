<?php
namespace Usage\V1\Rest\Usage;

class UsageResourceFactory
{
    public function __invoke($services)
    {
        $userProfileMapper = $services->get('User\Mapper\UserProfile');
        $usageMapper  = $services->get(\Usage\Mapper\Usage::class);
        $usageService = $services->get(\Usage\V1\Service\Usage::class);
        $resource = new UsageResource(
            $userProfileMapper,
            $usageMapper
        );
        $resource->setUsageService($usageService);
        return $resource;
    }
}
