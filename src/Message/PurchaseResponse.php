<?php


namespace Omnipay\Ozow\Message;


use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    protected $redirectUrl;
    protected $paymentRequestId;

    /**
     * PurchaseResponse constructor.
     *
     * @param RequestInterface $request
     * @param $data
     */
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);
        $this->redirectUrl = $data['url'];
        $this->paymentRequestId = $data['paymentRequestId'];
    }

    /**
     * @inheritDoc
     */
    public function isSuccessful()
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function isRedirect()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }

    /**
     * @inheritDoc
     */
    public function getRedirectMethod()
    {
        return 'POST';
    }

    /**
     * @inheritDoc
     */
    public function getRedirectData()
    {
        return $this->getData();
    }

    /**
     * @inheritDoc
     */
    public function getTransactionReference()
    {
        return $this->paymentRequestId;
    }
}
