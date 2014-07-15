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
 * Json to Typoscript converter
 *
 * Takes the incoming Json and converts it to Typoscipt
 *
 * @author Patrick Broens <patrick@patrickbroens.nl>
 */
class JsonToTypoScript extends \TYPO3\CMS\Form\Domain\Factory\JsonToTypoScript {
	
	/**
	 * Converts the JSON array for each element to a TypoScript array
	 * and adds this Typoscript array to the parent
	 *
	 * @param array $elements The JSON array
	 * @param array $parent The parent element
	 * @param boolean $childrenWithParentName Indicates if the children use the parent name
	 * @return void
	 */
	protected function convertToTyposcriptArray(array $elements, array &$parent, $childrenWithParentName = FALSE) {
		if (is_array($elements)) {
			$elementCounter = 10;
			foreach ($elements as $element) {
				if ($element['xtype']) {
					$this->elementId++;
					switch ($element['xtype']) {
						case 'typo3-form-wizard-elements-basic-button':

						case 'typo3-form-wizard-elements-basic-checkbox':

						case 'typo3-form-wizard-elements-basic-fileupload':

						case 'typo3-form-wizard-elements-basic-hidden':

						case 'typo3-form-wizard-elements-basic-password':

						case 'typo3-form-wizard-elements-basic-radio':

						case 'typo3-form-wizard-elements-basic-reset':

						case 'typo3-form-wizard-elements-basic-select':

						case 'typo3-form-wizard-elements-basic-submit':

						case 'typo3-form-wizard-elements-basic-textarea':

						case 'typo3-form-wizard-elements-basic-textline':

						case 'typo3-form-wizard-elements-predefined-email':

						case 'typo3-form-wizard-elements-content-header':
							
						case 'typo3-form-wizard-elements-content-textblock':
							$this->getDefaultElementSetup($element, $parent, $elementCounter, $childrenWithParentName);
							break;
						
						case 'typo3-form-wizard-elements-special-grid':
						
						case 'typo3-form-wizard-elements-basic-fieldset':
							
						case 'typo3-form-wizard-elements-predefined-name':
							$this->getDefaultElementSetup($element, $parent, $elementCounter);
							$this->getContainer($element, $parent, $elementCounter);
							break;
						case 'typo3-form-wizard-elements-predefined-checkboxgroup':

						case 'typo3-form-wizard-elements-predefined-radiogroup':
							$this->getDefaultElementSetup($element, $parent, $elementCounter);
							$this->getContainer($element, $parent, $elementCounter, TRUE);
							break;
						case 'typo3-form-wizard-elements-basic-form':
							$this->getDefaultElementSetup($element, $parent, $elementCounter);
							$this->getContainer($element, $parent, $elementCounter);
							$this->getForm($element, $parent, $elementCounter);
							break;
						default:

					}
				}
				$elementCounter = $elementCounter + 10;
			}
		}
	}

	/**
	 * Returns the content object type which is related to the ExtJS xtype
	 *
	 * @param array $element The JSON array for this element
	 * @return string The Content Object Type
	 */
	protected function getContentObjectType(array $element) {
		$contentObjectType = NULL;
		$shortXType = str_replace('typo3-form-wizard-elements-', '', $element['xtype']);
		list($category, $type) = explode('-', $shortXType);
		switch ($category) {
			case 'special':
			    switch ($type) {
					case 'grid':
						$contentObjectType = strtoupper($type);
						break;
			    }
			    break;
			default:
			    $contentObjectType = parent::getContentObjectType($element);
			    break;

		}
		return $contentObjectType;
	}
	
	/**
	 * Iterates over the various configuration settings and calls the
	 * appropriate function for each setting
	 *
	 * @param array $element The JSON array for this element
	 * @param array $parent The parent element
	 * @param integer $elementCounter The element counter
	 * @param boolean $childrenWithParentName Indicates if the children use the parent name
	 * @return void
	 */
	protected function setConfiguration(array $element, array &$parent, $elementCounter, $childrenWithParentName = FALSE) {
		parent::setConfiguration($element, $parent, $elementCounter, $childrenWithParentName);
		foreach ($element['configuration'] as $key => $value) {
			switch ($key) {
				case 'grid':
					$this->setGrid($element, $value, $parent, $elementCounter);
					break;
				default:
			}
		}
	}
	
	/**
	 * Set the various configuration of an element
	 *
	 * @param array $element The JSON array for this element
	 * @param array $options The JSON array for the various options of this element
	 * @param array $parent The parent element
	 * @param integer $elementCounter The element counter
	 * @return void
	 */
	protected function setGrid(array $element, array $grid, array &$parent, $elementCounter) {
		foreach ($grid as $key => $value) {
			switch ($key) {
				case 'containerClass':
					$parent[$elementCounter . '.'][$key] = (string) $value;
					break;
			}
		}
	}

}

?>