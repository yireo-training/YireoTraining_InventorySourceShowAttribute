<?php declare(strict_types=1);

namespace YireoTraining\InventorySourceShowAttributes\Test\Live;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\ObjectManager;
use Magento\InventoryApi\Api\Data\SourceInterface;
use Magento\InventoryApi\Api\SourceRepositoryInterface;
use PHPUnit\Framework\TestCase;

class SourceEntityTest extends TestCase
{
    public function testIfSourceEntityCouldBeModified()
    {
        $source = $this->getRandomSourceFromRepository();
        $sourceCode = $source->getSourceCode();

        $this->saveFrontendShow($source, true);
        $this->assertSourceContainsFrontendShow($this->getSourceFromRepositoryGet($sourceCode), true);
        $this->assertSourceContainsFrontendShow($this->getSourceFromRepositoryGetList($sourceCode), true);

        $this->saveFrontendShow($source, false);
        $this->assertSourceContainsFrontendShow($this->getSourceFromRepositoryGet($sourceCode), false);
        $this->assertSourceContainsFrontendShow($this->getSourceFromRepositoryGetList($sourceCode), false);
    }

    private function saveFrontendShow(SourceInterface $source, bool $frontendShow)
    {
        $source->getExtensionAttributes()->setFrontendShow($frontendShow);
        $this->getSourceRepository()->save($source);
    }

    private function assertSourceContainsFrontendShow(SourceInterface $source, bool $frontendShow)
    {
        $this->assertEquals($frontendShow, $source->getExtensionAttributes()->getFrontendShow());
    }

    private function getSourceFromRepositoryGet(string $sourceCode)
    {
        return $this->getSourceRepository()->get($sourceCode);
    }

    private function getSourceFromRepositoryGetList(string $sourceCode)
    {
        $searchCriteriaBuilder = ObjectManager::getInstance()->get(SearchCriteriaBuilder::class);
        $searchCriteriaBuilder->addFilter('source_code', $sourceCode);
        $searchCriteriaBuilder->setPageSize(1);
        $searchResults = $this->getSourceRepository()->getList($searchCriteriaBuilder->create());
        $sources = $searchResults->getItems();
        $source = array_shift($sources);
        return $source;
    }

    private function getSourceRepository(): SourceRepositoryInterface
    {
        return ObjectManager::getInstance()->get(SourceRepositoryInterface::class);
    }

    private function getRandomSourceFromRepository(): SourceInterface
    {
        $searchCriteriaBuilder = ObjectManager::getInstance()->get(SearchCriteriaBuilder::class);
        $searchCriteriaBuilder->setPageSize(1);
        $searchCriteria = $searchCriteriaBuilder->create();

        $sourceRepository = $this->getSourceRepository();
        $searchResult = $sourceRepository->getList($searchCriteria);
        $sources = $searchResult->getItems();

        $this->assertNotEmpty($sources);
        $source = array_shift($sources);
        $this->assertNotEmpty($source);
        return $source;
    }
}
