<?php
/**
 * Created by PhpStorm.
 * User: Cookiesoft
 * Date: 14/02/2019
 * Time: 21:14
 */

namespace Api\Controller;


use RestApi\Controller\ApiController;

class ProductController extends ApiController
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

        $products = [
          [
            'id' => 1,
            'name' => 'product 1',
            'price' => 2.30,
            'quantity' => 300
          ],
          [
           'id' => 2,
           'name' => 'product 2',
           'price' => 2.40,
           'quantity' => 400
          ],
          [
           'id' => 2,
           'name' => 'product 2',
           'price' => 2.40,
           'quantity' => 400
          ]
        ];


        // Set the response
        $this->apiResponse['products'] = $products;

        return $this->createResponse();
    }


}