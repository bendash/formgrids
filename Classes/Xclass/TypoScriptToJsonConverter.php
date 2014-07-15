<?php
namespace WorldDirect\Formgrids\Xclass;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011-2013 Patrick Broens (patrick@patrickbroens.nl)
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Typoscript to JSON converter
 *
 * Takes the incoming Typoscript and converts it to Json
 *
 * @author Patrick Broens <patrick@patrickbroens.nl>
 * @author Ben Walch <ben.walch@world-direct.at>
 */
class TypoScriptToJsonConverter extends \TYPO3\CMS\Form\Utility\TypoScriptToJsonConverter {

	/**
	 * Add child object to this element
	 *
	 * @param \TYPO3\CMS\Form\Domain\Model\Json\AbstractJsonElement $parentElement The parent object
	 * @param string $class Type of element
	 * @param array $arguments Configuration array
	 * @return void
	 */
	public function addElement(\TYPO3\CMS\Form\Domain\Model\Json\AbstractJsonElement $parentElement, $class, array $arguments) {
		$element = $this->createElement($class, $arguments);
		if(\TYPO3\CMS\Form\Utility\FormUtility::getInstance()->getLastPartOfClassName($parentElement, TRUE) == 'grid') {
			$element->configuration = array_merge($element->configuration, array('grid' => array('containerClass' => $arguments['containerClass'])));
		}
		$parentElement->addElement($element);
	}

}
