<?php

namespace VBA\CompanyInvoiceDetail\Plugin\Magento\Quote\Model;

class BillingAddressManagement
{

    protected $logger;

    public function __construct(
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function beforeAssign(
        \Magento\Quote\Model\BillingAddressManagement $subject,
                                                      $cartId,
        \Magento\Quote\Api\Data\AddressInterface $address,
                                                      $useForShipping = false
    ) {

        $extAttributes = $address->getExtensionAttributes();
        if (!empty($extAttributes)) {
            try {
                $address->setCompanyLegalName($extAttributes->getCompanyLegalName());
                $address->setCompanyAddress($extAttributes->getCompanyAddress());
                $address->setVatTax($extAttributes->getVatTax());
                $address->setCompanyRepresentative($extAttributes->getCompanyRepresentative());
                $address->setCompanyEmail($extAttributes->getCompanyEmail());
            } catch (\Exception $e) {
                $this->logger->critical($e->getMessage());
            }
        }
    }
}
