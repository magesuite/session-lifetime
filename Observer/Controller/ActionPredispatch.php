<?php

namespace MageSuite\SessionLifetime\Observer\Controller;

class ActionPredispatch implements \Magento\Framework\Event\ObserverInterface
{

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
     * @var \MageSuite\SessionLifetime\Helper\Configuration
     */
    protected $configuration;

    /**
     * ActionPredispatch constructor.
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \MageSuite\SessionLifetime\Helper\Configuration $configuration
     */
    public function __construct(\Magento\Customer\Model\Session $customerSession, \MageSuite\SessionLifetime\Helper\Configuration $configuration)
    {
        $this->customerSession = $customerSession;
        $this->configuration = $configuration;
    }

    /**
     * @param \\Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if ($this->customerSession->isLoggedIn() && $this->configuration->getStatus()) {
            $this->customerSession->regenerateId();
        }
    }

}
