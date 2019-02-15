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
use Zend\Authentication\Result;
use Zend\Json\Json;

class AuthController extends ApiController
{

    private $authenticationService;

    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    public function loginAction()
    {

        $request = $this->getRequest();

        if($request->isPost()) {

            $body = $request->getContent();
            $data = Json::decode($body);

            $email = $data->email;
            $password = $data->password;

            $adapter = $this->authenticationService->getAdapter();

            $adapter->setEmail($email);
            $adapter->setPassword($password);

            $result = $this->authenticationService->authenticate();

            if($result->getCode() == Result::SUCCESS){

                $user = $result->getIdentity();

                // generate token if valid user
                $payload = ['email' =>$user[0]['email'], 'name' => $user[0]['name']];

                $this->apiResponse['token'] = $this->generateJwtToken($payload);

                $this->apiResponse['message'] = 'Logged in successfully.';
                return $this->createResponse();

            }else{

                // Set the HTTP status code. By default, it is set to 200
                $this->httpStatusCode = 401;

                $this->apiResponse['message'] = 'Logged in failed.';
                return $this->createResponse();

            }


        }

    }

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