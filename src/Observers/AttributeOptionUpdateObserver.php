<?php

/**
 * TechDivision\Import\Attribute\Observers\AttributeOptionUpdateObserver
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-attribute
 * @link      http://www.techdivision.com
 */

namespace TechDivision\Import\Attribute\Observers;

use TechDivision\Import\Utils\StoreViewCodes;
use TechDivision\Import\Attribute\Utils\ColumnKeys;

/**
 * Observer that update's the attribute options found in the additional CSV file.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-attribute
 * @link      http://www.techdivision.com
 */
class AttributeOptionUpdateObserver extends AttributeOptionObserver
{

    /**
     * Initialize the EAV attribute option with the passed attributes and returns an instance.
     *
     * @param array $attr The EAV attribute option attributes
     *
     * @return array The initialized EAV attribute option
     */
    protected function initializeAttribute(array $attr)
    {

        // initialize the data to load the EAV attribute option
        $value = $this->getValue(ColumnKeys::VALUE);
        $storeId = $this->getRowStoreId(StoreViewCodes::ADMIN);
        $attributeCode = $this->getValue(ColumnKeys::ATTRIBUTE_CODE);

        // try to load the EAV attribute option
        if ($attributeOption = $this->loadAttributeOptionByAttributeCodeAndStoreIdAndValue($attributeCode, $storeId, $value)) {
            return $this->mergeEntity($attributeOption, $attr);
        }

        // simply return the attributes
        return $attr;
    }

    /**
     * Load's and return's the EAV attribute option with the passed code, store ID and value.
     *
     * @param string  $attributeCode The code of the EAV attribute option to load
     * @param integer $storeId       The store ID of the attribute option to load
     * @param string  $value         The value of the attribute option to load
     *
     * @return array The EAV attribute option
     */
    protected function loadAttributeOptionByAttributeCodeAndStoreIdAndValue($attributeCode, $storeId, $value)
    {
        return $this->getAttributeBunchProcessor()->loadAttributeOptionByAttributeCodeAndStoreIdAndValue($attributeCode, $storeId, $value);
    }
}
