<?php
namespace User\V1\Service\Listener;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Exception\InvalidArgumentException;
use Psr\Log\LoggerAwareTrait;
use User\Mapper\UserProfile as UserProfileMapper;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use User\V1\ProfileEvent;
use Aqilix\OAuth2\Mapper\OauthUsers as UserMapper;
use User\V1\UserSecret;

class ProfileEventListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;
    use LoggerAwareTrait;

    protected $config;
    protected $userProfileMapper;
    protected $userProfileHydrator;

    protected $userMapper;
    protected $fileConfig;

    /**
     * Constructor
     *
     * @param UserMapper          $userMapper
     * @param UserProfileMapper   $userProfileMapper
     * @param UserProfileHydrator $userProfileHydrator
     * @param array $config
     */
    public function __construct(
        UserMapper $userMapper,
        UserProfileMapper $userProfileMapper,
        DoctrineObject $userProfileHydrator,
        array $config = []
    ) {
        $this->setUserMapper($userMapper);
        $this->setUserProfileMapper($userProfileMapper);
        $this->setUserProfileHydrator($userProfileHydrator);
        $this->setConfig($config);
    }

    /**
     * (non-PHPdoc)
     * @see \Zend\EventManager\ListenerAggregateInterface::attach()
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(
            ProfileEvent::EVENT_CREATE_PROFILE,
            [$this, 'createUser'],
            500
        );

        $this->listeners[] = $events->attach(
            ProfileEvent::EVENT_UPDATE_PROFILE,
            [$this, 'updateProfile'],
            500
        );

        // $this->listeners[] = $events->attach(
        //     ProfileEvent::EVENT_DELETE_PROFILE,
        //     [$this, 'deleteProfile'],
        //     499
        // );
    }

    public function createUser(ProfileEvent $event)
    {
        try {
            // $userSecret = new UserSecret;
            // $strSecret  = $userSecret->generateUserSecret();
            $userData   = $event->getInputFilter()->getValues();
            $username   = $userData['email'];
            // $timezone   = $userData['timezone'];
            $checkUser  = $this->getUserMapper()->fetchOneBy([
                'username' => $username
            ]);
            if (! is_null($checkUser)) {
                $userProfileData = $this->getUserProfileMapper()->fetchOneBy([
                    "user" => $checkUser->getUsername()
                ]);
                if (! is_null($checkUser) && is_null($userProfileData)) {
                    $event->stopPropagation(true);
                    $message = "Cannot Registering User. Deleted user data still exist. Please contact developer";
                    return new \RuntimeException($message);
                }

                $event->stopPropagation(true);
                return new \RuntimeException('User already registed!');
            }

            $user = new \Aqilix\OAuth2\Entity\OauthUsers;
            $userProfile = new \User\Entity\UserProfile;
            $password = $this->getUserMapper()
                             ->getPasswordHash($userData['password']);
            
            
            // $userOAuth = $this->getUserProfileHydrator()->hydrate($userData, $user);

            $user->setUsername($username);
            $user->setPassword($password);
            $user->setFirstName($password);
            $user->setLastName($password);
            // $userOAuth->setAccount($userData['account']);
            $this->getUserMapper()->save($user);

            $hydrateEntity  = $this->getUserProfileHydrator()->hydrate($userData, $userProfile);
            $hydrateEntity->setUser($user);
            // $hydrateEntity->setTimezone($timezone);
            $hydrateEntity->setIsActive('1');
            // var_dump($hydrateEntity);exit;
            // $hydrateEntity->setSecret(substr($strSecret, 8));

            // $tmpName = $userData['photo']['tmp_name'];
            // if (! is_null($tmpName)) {
            //     $newPath = str_replace('data/', '', $tmpName);
            //     $hydrateEntity->setPhoto($newPath);
            // }

            $entityResult = $this->getUserProfileMapper()->save($hydrateEntity);
            $event->setUserProfileEntity($entityResult);

            $this->logger->log(
                \Psr\Log\LogLevel::INFO,
                "{function} {uuid} {userProfileUuid}",
                [
                    "function" => __FUNCTION__,
                    "uuid"     => $entityResult->getUser()->getUsername(),
                    "userProfileUuid"  => $entityResult->getUuid()
                ]
            );
        } catch (\Exception $e) {
            $event->stopPropagation(true);
            $this->logger->log(
                \Psr\Log\LogLevel::ERROR,
                "{function} {data} {message}",
                [
                    "data" => json_encode($entityResult),
                    "message"  => $e->getMessage(),
                    "function" => __FUNCTION__,
                ]
            );
            return $e;
        }
    }

    /**
     * Update Profile
     *
     * @param  SignupEvent $event
     * @return void|\Exception
     */
    public function updateProfile(ProfileEvent $event)
    {
        try {
            $userProfileEntity = $event->getUserProfileEntity();
            $updateData  = $event->getUpdateData();
            // add file input filter here
            if (! $event->getInputFilter() instanceof InputFilterInterface) {
                throw new InvalidArgumentException('Input Filter not set');
            }

            // adding filter for photo
            // $inputPhoto  = $event->getInputFilter()->get('photo');
            // $inputPhoto->getFilterChain()
            //         ->attach(new \Zend\Filter\File\RenameUpload([
            //             'target' => $this->getConfig()['backup_dir'],
            //             'randomize' => true,
            //             'use_upload_extension' => true
            //         ]));
            $userProfile = $this->getUserProfileHydrator()->hydrate($updateData, $userProfileEntity);
            $this->getUserProfileMapper()->save($userProfile);
            $event->setUserProfileEntity($userProfile);
            $this->logger->log(
                \Psr\Log\LogLevel::INFO,
                "{function} {username}",
                [
                    "function" => __FUNCTION__,
                    "username" => $userProfileEntity->getUser()->getUsername()
                ]
            );
        } catch (\Exception $e) {
            $event->stopPropagation(true);
            return $e;
        }
    }

    public function deleteProfile(ProfileEvent $event)
    {
        try {
            $profileData  = $event->getUpdateData();
            $deletedUuid  = $profileData['uuid'];

            $checkProfile = $this->getUserProfileMapper()->fetchOneBy(['uuid' => $deletedUuid]);
            $this->getUserProfileMapper()->delete($checkProfile);
            $this->logger->log(
                \Psr\Log\LogLevel::INFO,
                "{function} {uuid} {firstName} deleted!",
                [
                    "function" => __FUNCTION__,
                    "uuid"     => $deletedUuid,
                    "firstName"  => $checkProfile->getFirstName(),
                ]
            );
        } catch (\Exception $e) {
            $event->stopPropagation(true);
            $this->logger->log(
                \Psr\Log\LogLevel::ERROR,
                "{function} {message}",
                [
                    "message"  => $e->getMessage(),
                    "function" => __FUNCTION__,
                ]
            );
            return $e;
        }
    }

    /**
     * @return the $config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return the $userProfileMapper
     */
    public function getUserProfileMapper()
    {
        return $this->userProfileMapper;
    }

    /**
     * @param UserProfileMapper $userProfileMapper
     */
    public function setUserProfileMapper(UserProfileMapper $userProfileMapper)
    {
        $this->userProfileMapper = $userProfileMapper;
    }

    /**
     * @return the $userProfileHydrator
     */
    public function getUserProfileHydrator()
    {
        return $this->userProfileHydrator;
    }

    /**
     * @param DoctrineObject $userProfileHydrator
     */
    public function setUserProfileHydrator($userProfileHydrator)
    {
        $this->userProfileHydrator = $userProfileHydrator;
    }

    /**
     * Get the value of userMapper
     */ 
    public function getUserMapper()
    {
        return $this->userMapper;
    }

    /**
     * Set the value of userMapper
     *
     * @return  self
     */ 
    public function setUserMapper($userMapper)
    {
        $this->userMapper = $userMapper;

        return $this;
    }
}
