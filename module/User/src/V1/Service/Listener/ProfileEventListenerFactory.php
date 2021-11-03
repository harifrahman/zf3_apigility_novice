<?php
namespace User\V1\Service\Listener;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class ProfileEventListenerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config               = $container->get('Config')['project'];
        $userProfileMapper    = $container->get('User\Mapper\UserProfile');
        $userMapper           = $container->get('Aqilix\OAuth2\Mapper\OauthUsers');
        $userProfileHydrator  = $container->get('HydratorManager')->get('User\Hydrator\UserProfile');
        $profileEventConfig   = $container->get('Config')['user']['photo'];

        $profileEventListener = new ProfileEventListener(
            $userMapper,
            $userProfileMapper,
            $userProfileHydrator,
            $profileEventConfig
        );

        $profileEventListener->setLogger($container->get("logger_default"));
        $profileEventListener->setUserProfileHydrator($userProfileHydrator);
        $profileEventListener->setConfig($config);
        return $profileEventListener;
    }
}
