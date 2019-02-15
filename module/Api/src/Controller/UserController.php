<?php
/**
 * Created by PhpStorm.
 * User: Cookiesoft
 * Date: 14/02/2019
 * Time: 21:14
 */

namespace Api\Controller;


use RestApi\Controller\ApiController;
use Zend\Authentication\AuthenticationService;

class UserController extends ApiController
{

    /**
     * bar method
     *
     */
    public function indexAction()
    {
        // your action logic

        // Set the HTTP status code. By default, it is set to 200
        $this->httpStatusCode = 200;

        $users = [
          [
            'id' => 1,
            'name' => 'User 1',
            'email' => 'user1@email.com',
            'username' => 'username1'
          ],
          [
              'id' => 2,
              'name' => 'User 2',
              'email' => 'user2@email.com',
              'username' => 'username2'
          ],
          [
              'id' => 3,
              'name' => 'User 3',
              'email' => 'user3@email.com',
              'username' => 'username3'
          ]
        ];


        // Set the response
        $this->apiResponse['users'] = $users;

        return $this->createResponse();
    }


}