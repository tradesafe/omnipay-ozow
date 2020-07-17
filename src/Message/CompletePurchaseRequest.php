<?php


namespace Omnipay\Ozow\Message;


class CompletePurchaseRequest extends PurchaseRequest
{
    public function getData()
    {
        die('CompletePurchaseRequest::getData');

        throw new InvalidRequestException('Missing PDT or ITN variables');
    }

    public function sendData($data)
    {
        die('CompletePurchaseRequest::sendData');
        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}
