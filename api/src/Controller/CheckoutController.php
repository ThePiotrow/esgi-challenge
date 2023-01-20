<?php

namespace App\Controller;

use Stripe\Stripe;
use Stripe\StripeClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route('/checkout')]
class CheckoutController extends AbstractController
{
    #[Route('/', name: 'checkout', methods: ['POST'])]
    public function checkout(): Response
    {
        $stripe = new StripeClient('sk_test_51H22YjJmflweIzBLGSFWKTxqfOvCNllWqbWOUUrEdEmXF2KP5TyHWwjK13zUhdUMgT5E003sRZFKqLB7W2kHyzSP0053l7NWn3');

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => [[
                # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'produit'
                    ],
                    'unit_amount' => 10000,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'http://localhost',
            'cancel_url' => 'http://localhost',
        ]);


        dump($stripe->checkout->sessions->retrieve($checkout_session->id));
        dd($checkout_session);

        //$this->redirect($checkout_session->url);

        return new Response($checkout_session->url, 200, ["Content-Type" => "application/json"]);
    }
}
