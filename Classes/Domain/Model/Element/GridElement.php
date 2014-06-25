<?php
namespace TYPO3\CMS\Form\Domain\Model\Element;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2008-2013 Patrick Broens (patrick@patrickbroens.nl)
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
 * grid model object
 *
 * @author Patrick Broens <patrick@patrickbroens.nl>
 * @author Ben Walch <ben.walch@world-direct.at>
 */
class GridElement extends \TYPO3\CMS\Form\Domain\Model\Element\ContainerElement {
        
        /**
	 * css class for the child element wrap
	 *
	 * @var array
	 */
	protected $childrenClasses = array();
        
	/**
	 * Allowed attributes for this object
	 *
	 * @var array
	 */
	protected $allowedAttributes = array(
		'class' => '',
		'dir' => '',
		'id' => '',
		'lang' => '',
		'style' => '',
	);
        
        /**
	 * get child classes
	 *
	 * @return array
	 */
        public function getChildrenClasses() {
            return $this->childrenClasses;
        }
        
        /**
	 * set child classes
	 *
	 * @param array $childrenClasses
	 */
        public function setChildrenClasses($childrenClasses) {
            $this->childrenClasses = $childrenClasses;
        }
        
        /**
	 * add children class
	 *
	 * @param array $childrenClass
	 */
        public function addChildrenClass($childrenClass) {
            $this->childrenClasses = array_merge($this->childrenClasses, $childrenClass);
        }
}
