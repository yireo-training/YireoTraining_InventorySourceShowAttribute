<?php declare(strict_types=1);

namespace YireoTraining\InventorySourceShowAttribute\Plugin;

use Magento\Inventory\Model\Source\Command\GetListInterface;
use Magento\InventoryApi\Api\Data\SourceSearchResultsInterface;

class AddShowAttributeToSourceGetList
{
    public function afterExecute(
        GetListInterface $getList,
        SourceSearchResultsInterface $searchResults = null
    ): SourceSearchResultsInterface {
        $sources = $searchResults->getItems();
        foreach ($sources as $source) {

            $extensionAttributes = $source->getExtensionAttributes();
            if (!$extensionAttributes) {
                continue;
            }

            $source->getExtensionAttributes()->setFrontendShow((bool)$source->getFrontendShow());
        }

        return $searchResults;
    }
}
