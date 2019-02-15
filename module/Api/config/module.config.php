<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Api;

use Api\Controller\Factory\AuthControllerFactory;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'auth-login' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/auth/login',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action' => 'login',
                    ],
                ],
            ],
            'users' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/users[/:action]',
                    'defaults' => [
                        'controller' => Controller\UserController::class,
                        'action' => 'index',
                        'isAuthorizationRequired' => true // set true if this api Required JWT Authorization.
                    ],
                ],
            ],
            'products' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/products[/:action]',
                    'defaults' => [
                        'controller' => Controller\ProductController::class,
                        'action'     => 'index',
                        'isAuthorizationRequired' => true // set true if this api Required JWT Authorization.
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\AuthController::class => AuthControllerFactory::class,
            Controller\UserController::class => InvokableFactory::class,
            Controller\ProductController::class => InvokableFactory::class
        ],
    ],
    'service_manager' => [
        'factories' => [
            Repository\UserRepository::class => InvokableFactory::class,
            \Zend\Authentication\AuthenticationService::class => Service\Factory\AuthenticationServiceFactory::class,
            Service\AuthAdapter::class => Service\Factory\AuthAdapterFactory::class

        ]
    ]
];
