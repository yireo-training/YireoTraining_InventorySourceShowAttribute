<?php declare(strict_types=1);

namespace YireoTraining\InventorySourceShowAttributes\Test\Live;

use Magento\Framework\App\ObjectManager;
use Magento\InventoryApi\Api\Data\SourceInterface;
use PHPUnit\Framework\TestCase;

class ExtensionAttributeShowTest extends TestCase
{
    public function testIfExtensionAttributeExists()
    {
        $source = ObjectManager::getInstance()->get(SourceInterface::class);
        $extensionAttributes = $source->getExtensionAttributes();
        $this->assertNotEmpty($extensionAttributes);
        $this->assertTrue(method_exists($extensionAttributes, 'getFrontendShow'), 'Method getFrontendShow() does not exist');
        $this->assertTrue(method_exists($extensionAttributes, 'setFrontendShow'), 'Method setFrontendShow() does not exist');
    }

    public function testIfExtensionAttributeWorks()
    {
        $source = ObjectManager::getInstance()->get(SourceInterface::class);
        $extensionAttributes = $source->getExtensionAttributes();
        $extensionAttributes->setFrontendShow(true);
        $this->assertTrue($extensionAttributes->getFrontendShow());

        $extensionAttributes->setFrontendShow(false);
        $this->assertFalse($extensionAttributes->getFrontendShow());
    }
}
