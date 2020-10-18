<?php


namespace App\Helper;


use Goutte\Client;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class priceAlertHelper
{
    /**
     * @var string
     */
    private $email;
    /**
     * @var MailerInterface
     */
    private $mailer;

    public function __construct(string $email, MailerInterface $mailer)
    {
        $this->email = $email;
        $this->mailer = $mailer;
    }

    public function priceLookup(string $url, int $threshold): void
    {
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $priceDollars = (int) $crawler->filter('span.price-dollars')->getNode(0)->textContent;
        $priceCents = (int) $crawler->filter('span.price-cents')->getNode(0)->textContent;

        $result = $this->priceCompare($priceDollars, $priceCents, $threshold);
        $this->notifyMe($result, $priceDollars, $priceCents);
    }

    private function priceCompare(int $priceDollars, int $priceCents, $threshold): bool
    {
        $itemPrice = $priceDollars * 100 + $priceCents;
        if ($itemPrice > $threshold * 100) {
            return false;
        } else {
            return true;
        }
    }

    private function notifyMe(bool $result, int $priceDollars, int $priceCents): void
    {
        if ($result) {
            $subject = 'Great, price is lower than your expectation';
            $body = sprintf('Congratulations! the current price of the item is $%d.%d', $priceDollars, $priceCents);
        } else {
            $subject = 'Oops, price is higher than your expectation';
            $body = sprintf("Sigh! the current price of the item is $%d.%d, it's so high...", $priceDollars, $priceCents);
        }
        print_r($body);

//        $email = (new Email())
//            ->from('hello@priceAlert.com')
//            ->to($this->email)
//            ->subject('')
//            ->text($body)
//            ->html("<p>$body</p>");
//
//        $this->mailer->send($email);
    }
}