<?php
/**
 * Created by PhpStorm.
 * User: Matthieu
 * Date: 20/10/2018
 * Time: 14:41
 */

namespace App\Service;

use App\Service\Interfaces\StripeHandlerInterface;


/**
 * Class StripeHandler
 * @package App\Service
 */
class StripeHandler implements StripeHandlerInterface
{

    /**
     * @var string $token
     */
    private $token;

    /**
     * @var int $price
     */
    private $price;

    /**
     * @var string $moneyunit
     */
    private $moneyunit;

    public function __construct
    (
        string $token,
        int $price,
        string $moneyunit
    )
    {
        $this->token = $token;
        $this->price = $price;
        $this->moneyunit = $moneyunit;
    }

    /**
     * @return mixed
     */
    public function getPaiement($name, $firstname)
    {
        $token = $this->token;
        $price = $this->price;
        $money = $this->moneyunit;

        $message = [];

        \Stripe\Stripe::setApiKey(getenv('STRIPE_TOKEN'));

        try {
            $charge = \Stripe\Charge::create([
                'amount' => $price,
                'currency' => $money,
                'description' => sprintf('Le paiement de %d pour Monsieur/Madame %s %s a été validé', $price, $name, $firstname),
                'source' => $token
            ]);

            $price = $price/100;

            $message = ["Votre paiement de $price € a été réalisé avec succès. Vous recevrez par courriel vos tickets de réservation",true];

            return $message;


        } catch(\Stripe\Error\Card $e) {

            $message = ["Echec du paiement : ".$e->getMessage(),false];

            return $message;

        } catch (\Stripe\Error\RateLimit $e) {

            $message = ["Echec du paiement : ".$e->getMessage(),false];

            return $message;

        } catch (\Stripe\Error\InvalidRequest  $e) {

            $message = ["Echec du paiement : ".$e->getMessage(),false];

            return $message;

        } catch (\Stripe\Error\Authentication $e) {

            $message = ["Echec du paiement : ".$e->getMessage(),false];

            return $message;

        } catch (\Stripe\Error\ApiConnection $e) {

            $message = ["Echec du paiement : ".$e->getMessage(),false];

            return $message;

        } catch (\Stripe\Error\Base $e) {

            $message = ["Echec du paiement : ".$e->getMessage(),false];

            return $message;

        } catch (\Exception $e) {

            $message = ["Echec du paiement : ".$e->getMessage(),false];

            return $message;

        }
    }
}