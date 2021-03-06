<?php
/**
 * Magento Enterprise Edition
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magento Enterprise Edition End User License Agreement
 * that is bundled with this package in the file LICENSE_EE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.magento.com/license/enterprise-edition
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Tests
 * @package     Tests_Functional
 * @copyright Copyright (c) 2006-2015 X.commerce, Inc. (http://www.magento.com)
 * @license http://www.magento.com/license/enterprise-edition
 */

namespace Mage\Catalog\Test\Block\Product\ProductList;

use Magento\Mtf\Block\Block;
use Magento\Mtf\Client\Element\SimpleElement as Element;
use Magento\Mtf\Client\Locator;
use Magento\Mtf\Fixture\InjectableFixture;

/**
 * Related product block on the page.
 */
class Related extends Block
{
    /**
     * Related product locator on the page.
     *
     * @var string
     */
    protected $relatedProduct = "//div[normalize-space(div//a)='%s']";

    /**
     * Checking related product visibility.
     *
     * @param InjectableFixture $product
     * @return bool
     */
    public function isRelatedProductVisible(InjectableFixture $product)
    {
        return $this->getProductElement($product->getName())->isVisible();
    }

    /**
     * Get related product element.
     *
     * @param string $productName
     * @return Element
     */
    protected function getProductElement($productName)
    {
        return $this->_rootElement->find(sprintf($this->relatedProduct, $productName), Locator::SELECTOR_XPATH);
    }
}
