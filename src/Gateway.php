<?php


namespace Omnipay\Ozow;


use Omnipay\Common\AbstractGateway;

/**
 * Ozow Gateway
 *
 * @link https://ozow.com/integrations/
 *
 */
class Gateway extends AbstractGateway
{
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'Ozow';
    }

    /**
     * @inheritDoc
     */
    public function getDefaultParameters()
    {
        return array(
            'siteCode' => '',
            'countryCode' => '',
            'currencyCode' => '',
            'privateKey' => '',
            'isTest' => false,
        );
    }

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

    public function setIsTest(bool $value)
    {
        return $this->setParameter('isTest', $value);
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

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Ozow\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Ozow\Message\CompletePurchaseRequest', $parameters);
    }
}
