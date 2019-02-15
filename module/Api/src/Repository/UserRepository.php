<?php
/**
 * Created by PhpStorm.
 * User: Cookiesoft
 * Date: 14/02/2019
 * Time: 21:24
 */

namespace Api\Repository;


class UserRepository
{

    public function findUserByEmailAndPassword($email, $password){

        if($email == 'g.dasilva@hotmail.com' && $password == 'ufpb2014'){

            return [
              [
                'id' => 1,
                'name' => 'Alyson Rodrigo',
                'email' => 'g.dasilva@hotmail.com'
              ]
            ];

        }else {
            return false;
        }


    }

}