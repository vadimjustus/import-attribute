<?php

/**
 * TechDivision\Import\Attribute\Actions\Processors\AttributeUpdateProcessor
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

namespace TechDivision\Import\Attribute\Actions\Processors;

use TechDivision\Import\Attribute\Utils\MemberNames;
use TechDivision\Import\Actions\Processors\AbstractUpdateProcessor;

/**
 * The EAV attribute update processor implementation.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-attribute
 * @link      http://www.techdivision.com
 */
class AttributeUpdateProcessor extends AbstractUpdateProcessor
{

    /**
     * Return's the array with the SQL statements that has to be prepared.
     *
     * @return array The SQL statements to be prepared
     * @see \TechDivision\Import\Actions\Processors\AbstractBaseProcessor::getStatements()
     */
    protected function getStatements()
    {

        // load the utility class name
        $utilityClassName = $this->getUtilityClassName();

        // return the array with the SQL statements that has to be prepared
        return array(
            $utilityClassName::UPDATE_ATTRIBUTE => $this->getUtilityClass()->find($utilityClassName::UPDATE_ATTRIBUTE)
        );
    }

    /**
     * Update's the passed row.
     *
     * @param array       $row  The row to update
     * @param string|null $name The name of the prepared statement that has to be executed
     *
     * @return string The ID of the updated attribute
     */
    public function execute($row, $name = null)
    {
        parent::execute($row, $name);
        return $row[MemberNames::ATTRIBUTE_ID];
    }
}
