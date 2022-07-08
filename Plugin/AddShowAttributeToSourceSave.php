<?php declare(strict_types=1);

namespace YireoTraining\InventorySourceShowAttribute\Plugin;

use Magento\Inventory\Model\Source\Command\Save;
use Magento\InventoryApi\Api\Data\SourceInterface;

class AddShowAttributeToSourceSave
{
    public function beforeExecute(Save $save, SourceInterface $source)
    {
        $extensionAttributes = $source->getExtensionAttributes();
        if (!$extensionAttributes) {
            return $source;
        }

        $source->setData('frontend_show', (int)$extensionAttributes->getFrontendShow());
        return [$source];
    }
}
