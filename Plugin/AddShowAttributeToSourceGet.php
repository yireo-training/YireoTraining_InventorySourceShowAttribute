<?php declare(strict_types=1);

namespace YireoTraining\InventorySourceShowAttribute\Plugin;

use Magento\Inventory\Model\Source\Command\Get;
use Magento\InventoryApi\Api\Data\SourceInterface;

class AddShowAttributeToSourceGet
{
    /**
     * @param Get $get
     * @param SourceInterface $source
     * @return SourceInterface
     */
    public function afterExecute(Get $get, SourceInterface $source)
    {
        $extensionAttributes = $source->getExtensionAttributes();
        if (!$extensionAttributes) {
            return $source;
        }

        $extensionAttributes->setFrontendShow((bool)$source->getData('frontend_show'));
        return $source;
    }
}
