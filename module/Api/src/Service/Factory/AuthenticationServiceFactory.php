<?php
/**
 * Created by PhpStorm.
 * User: Cookiesoft
 * Date: 14/02/2019
 * Time: 21:37
 */

namespace Api\Service\Factory;


use Api\Service\AuthAdapter;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\SessionManager;
use Zend\Authentication\Storage\Session as SessionStorage;

class AuthenticationServiceFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        $sessionManager = $container->get(SessionManager::class);
        $authStorage = new SessionStorage('Zend_Auth', 'session', $sessionManager);
        $authAdapter = $container->get(AuthAdapter::class);

        // Create the service and inject dependencies into its constructor.
        return new AuthenticationService($authStorage, $authAdapter);

    }
}