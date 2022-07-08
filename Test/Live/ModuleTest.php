<?php declare(strict_types=1);

namespace YireoTraining\InventorySourceShowAttributes\Test\Live;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\Module\ModuleList;
use PHPUnit\Framework\TestCase;

class ModuleTest extends TestCase
{
    public function testIfModuleIsEnabled()
    {
        $moduleList = ObjectManager::getInstance()->get(ModuleList::class);
        $module = $moduleList->getOne('YireoTraining_InventorySourceShowAttribute');
        $this->assertNotEmpty($module);

        $module = $moduleList->getOne('Magento_Inventory');
        $this->assertNotEmpty($module);
    }
}
