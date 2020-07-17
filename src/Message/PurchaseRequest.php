<?php


namespace Omnipay\Ozow\Message;


use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractRequest;

class PurchaseRequest extends AbstractRequest
{
    protected $endpoint = "https://api.ozow.com/PostPaymentRequest";

    public function getSiteCode()
    {
        return $this->getParameter('siteCode');
    }

    public function setSiteCode($value)
    {
        return $this->setParameter('siteCode', $value);
    }

    public function getCountryCode()
    {
        return $this->getParameter('countryCode');
    }

    public function setCountryCode($value)
    {
        return $this->setParameter('countryCode', $value);
    }

    public function getCurrencyCode()
    {
        return $this->getParameter('currencyCode');
    }

    public function setCurrencyCode($value)
    {
        return $this->setParameter('currencyCode', $value);
    }

    public function getPrivateKey()
    {
        return $this->getParameter('privateKey');
    }

    public function setPrivateKey($value)
    {
        return $this->setParameter('privateKey', $value);
    }

    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    public function getIsTest()
    {
        return $this->getParameter('isTest');
    }

    public function setIsTest($value)
    {
        if ($value) {
            return $this->setParameter('isTest', 'true');
        }

        return $this->setParameter('isTest', 'false');
    }

    public function getBankReference()
    {
        return $this->getParameter('bankReference');
    }

    public function setBankReference($value)
    {
        return $this->setParameter('bankReference', $value);
    }

    public function getOptional1()
    {
        return $this->getParameter('optional1');
    }

    public function setOptional1($value)
    {
        return $this->setParameter('optional1', $value);
    }

    public function getOptional2()
    {
        return $this->getParameter('optional2');
    }

    public function setOptional2($value)
    {
        return $this->setParameter('optional2', $value);
    }

    public function getOptional3()
    {
        return $this->getParameter('optional3');
    }

    public function setOptional3($value)
    {
        return $this->setParameter('optional3', $value);
    }

    public function getOptional4()
    {
        return $this->getParameter('optional4');
    }

    public function setOptional4($value)
    {
        return $this->setParameter('optional4', $value);
    }

    public function getOptional5()
    {
        return $this->getParameter('optional5');
    }

    public function setOptional5($value)
    {
        return $this->setParameter('optional5', $value);
    }

    public function getCustomer()
    {
        return $this->getParameter('customer');
    }

    public function setCustomer($value)
    {
        return $this->setParameter('customer', $value);
    }

    public function getCancelUrl()
    {
        return $this->getParameter('cancelUrl');
    }

    public function setCancelUrl($value)
    {
        return $this->setParameter('cancelUrl', $value);
    }

    public function getErrorUrl()
    {
        return $this->getParameter('errorUrl');
    }

    public function setErrorUrl($value)
    {
        return $this->setParameter('errorUrl', $value);
    }

    public function getNotifyUrl()
    {
        return $this->getParameter('notifyUrl');
    }

    public function setNotifyUrl($value)
    {
        return $this->setParameter('notifyUrl', $value);
    }

    public function getSuccessUrl()
    {
        return $this->getParameter('successUrl');
    }

    public function setSuccessUrl($value)
    {
        return $this->setParameter('successUrl', $value);
    }

    /**
     * @inheritDoc
     */
    public function getData(): array
    {
        $this->validate('siteCode', 'countryCode', 'currencyCode', 'amount', 'transactionId', 'bankReference', 'isTest');

        $data = array();
        $data['SiteCode'] = $this->getSiteCode();
        $data['CountryCode'] = $this->getCountryCode();
        $data['CurrencyCode'] = $this->getCurrencyCode();
        $data['Amount'] = $this->getAmount();
        $data['TransactionReference'] = $this->getTransactionId();
        $data['BankReference'] = $this->getBankReference();
        $data['Optional1'] = $this->getOptional1();
        $data['Optional2'] = $this->getOptional2();
        $data['Optional3'] = $this->getOptional3();
        $data['Optional4'] = $this->getOptional4();
        $data['Optional5'] = $this->getOptional5();
        $data['Customer'] = $this->getCustomer();
        $data['CancelUrl'] = $this->getCancelUrl();
        $data['ErrorUrl'] = $this->getErrorUrl();
        $data['SuccessUrl'] = $this->getSuccessUrl();
        $data['NotifyUrl'] = $this->getNotifyUrl();
        $data['IsTest'] = $this->getIsTest();

        $data['HashCheck'] = $this->generateHash($data);

        return $data;
    }

    /**
     * Generate hash for Ozow
     *
     * @param array $data
     * @return string
     */
    public function generateHash(array $data): string
    {
        $hashCheckData = '';

        foreach ($data as $field) {
            $hashCheckData .= $field;
        }

        $hashCheckData .= $this->getPrivateKey();

        $hashCheckData = strtolower($hashCheckData);

        return hash('sha512', $hashCheckData);
    }

    /**
     * @inheritDoc
     */
    public function sendData($data)
    {
        $httpResponse = $this->httpClient->request('POST', $this->endpoint, [
            'ApiKey' => $this->getApiKey(),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ], json_encode($data));

        $responseData = json_decode($httpResponse->getBody()->getContents(), true);

        if ($responseData['errorMessage'] !== null) {
            throw new InvalidRequestException($responseData['errorMessage']);
        }

        return $this->response = new PurchaseResponse($this, $responseData);
    }
}
