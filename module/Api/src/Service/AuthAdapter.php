<?php
/**
 * Created by PhpStorm.
 * User: Cookiesoft
 * Date: 14/02/2019
 * Time: 21:23
 */

namespace Api\Service;


use Api\Repository\UserRepository;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;

class AuthAdapter implements AdapterInterface
{

    protected $email;
    protected $password;

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface If authentication cannot be performed
     */
    public function authenticate()
    {

       $user = $this->userRepository->findUserByEmailAndPassword($this->getEmail(), $this->getPassword());

        if($user){
            return new Result(Result::SUCCESS,
                $user,
                ['Authenticated successfully.']);
        }

        return new Result(
            Result::FAILURE_CREDENTIAL_INVALID,
            null,
            ['Invalid credentials.']);

    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }


}