<?php
namespace App\Controller\API;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class PaymentController extends AbstractController
{
    const ORDER_PROCESSING_CONFIRMED  = 'confirmed';
    const ORDER_PROCESSING_DECLINED = 'declined';

    /**
     * @Route("/payment/process-order", name="process_order")
     */
    public function processOrder()
    {
        $request = Request::createFromGlobals();
        $order = $request->request->get('order');

        if(!$order){
            return $this->json(['status' => Response::HTTP_NOT_FOUND, 'test' => $order]);
        }

        $processingResult = (bool) random_int(0, 1) ? self::ORDER_PROCESSING_CONFIRMED : self::ORDER_PROCESSING_DECLINED;

        return $this->json(['status' => Response::HTTP_OK, 'result' => $processingResult]);
    }
}