<?php
namespace TYPO3\CMS\Form\View\Form\Element;

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
 * View object for the grid element
 *
 * @author Patrick Broens <patrick@patrickbroens.nl>
 * @author Ben Walch <ben.walch@world-direct.at>
 */
class GridElementView extends \TYPO3\CMS\Form\View\Form\Element\ContainerElementView {

	/**
	 * Default layout of this object
	 *
	 * @var string
	 */
	protected $layout = '
		<div>
                    <elements />
		</div>
	';
        
	/**
	 * Get the child objects
	 * and render them as document fragment
	 *
	 * @param \DOMDocument $dom DOMDocument
	 * @return \DOMDocumentFragment
	 */
	public function getChildElements(\DOMDocument $dom) {
		$modelChildren = $this->model->getElements();
		$documentFragment = $dom->createDocumentFragment();
                $childrenClasses = $this->model->getChildrenClasses();
		foreach ($modelChildren as $key => $modelChild) {
			$class = (array_key_exists('id-' . $modelChild->getElementId(), $childrenClasses)) ? $childrenClasses['id-' . $modelChild->getElementId()] . ' ' : '';
                        $child = $this->createChildElementFromModel($modelChild);
			if ($child->noWrap() === TRUE) {
				$childNode = $child->render();
			} else {
				$childNode = $child->render('elementWrap');
			        if (strlen($childNode->getAttribute('class')) > 0) {
				       $class .= $childNode->getAttribute('class') . ' ';
				}
				$class .= $child->getElementWraps();
			        $childNode->setAttribute('class', $class);
			}
			$importedNode = $dom->importNode($childNode, TRUE);
			$documentFragment->appendChild($importedNode);
		}
		return $documentFragment;
	}
        
        /**
	 * Parse the XML of a view object,
	 * check the node type and name
	 * and add the proper XML part of child tags
	 * to the DOMDocument of the current tag
	 *
	 * @param \DOMDocument $dom
	 * @param \DOMNode $reference Current XML structure
	 * @return void
	 */
	protected function parseXML(\DOMDocument $dom, \DOMNode $reference) {
		$node = $reference->firstChild;
		while (!is_null($node)) {
			$deleteNode = FALSE;
			$nodeType = $node->nodeType;
			$nodeName = $node->nodeName;
			switch ($nodeType) {
				case XML_TEXT_NODE:
					break;
				case XML_ELEMENT_NODE:
					switch ($nodeName) {
						case 'containerWrap':
							$this->replaceNodeWithFragment($dom, $node, $this->render('containerWrap'));
							$deleteNode = TRUE;
							break;
						case 'elements':
							$replaceNode = $this->getChildElements($dom);
							$node->parentNode->replaceChild($replaceNode, $node);
							break;
						case 'button':

						case 'fieldset':

						case 'form':
                                                    
                                                case 'div':

						case 'input':

						case 'optgroup':

						case 'select':
							$this->setAttributes($node);
							break;
						case 'label':
							if (!strrchr(get_class($this), 'AdditionalElement')) {
								if ($this->model->additionalIsSet($nodeName)) {
									$this->replaceNodeWithFragment($dom, $node, $this->getAdditional('label'));
								}
								$deleteNode = TRUE;
							} else {
								if ($this->model->additionalIsSet($nodeName)) {
									$this->setAttributeWithValueofOtherAttribute($node, 'for', 'id');
								} else {
									$deleteNode = TRUE;
								}
							}
							break;
						case 'legend':
							if (!strrchr(get_class($this), 'AdditionalElement')) {
								if ($this->model->additionalIsSet($nodeName)) {
									$this->replaceNodeWithFragment($dom, $node, $this->getAdditional('legend'));
								}
								$deleteNode = TRUE;
							}
							break;
						case 'textarea':

						case 'option':
							$this->setAttributes($node);
							$appendNode = $dom->createTextNode($this->getElementData());
							$node->appendChild($appendNode);
							break;
						case 'errorvalue':

						case 'labelvalue':

						case 'legendvalue':

						case 'mandatoryvalue':
							$replaceNode = $dom->createTextNode($this->getAdditionalValue());
							$node->parentNode->insertBefore($replaceNode, $node);
							$deleteNode = TRUE;
							break;
						case 'mandatory':

						case 'error':
							if ($this->model->additionalIsSet($nodeName)) {
								$this->replaceNodeWithFragment($dom, $node, $this->getAdditional($nodeName));
							}
							$deleteNode = TRUE;
							break;
						case 'content':

						case 'header':

						case 'textblock':
							$replaceNode = $dom->createTextNode($this->getElementData(FALSE));
							$node->parentNode->insertBefore($replaceNode, $node);
							$deleteNode = TRUE;
							break;
					}
					break;
			}
			// Parse the child nodes of this node if available
			if ($node->hasChildNodes()) {
				$this->parseXML($dom, $node);
			}
			// Get the current node for deletion if replaced. We need this because nextSibling can be empty
			$oldNode = $node;
			// Go to next sibling to parse
			$node = $node->nextSibling;
			// Delete the old node. This can only be done after going to the next sibling
			if ($deleteNode) {
				$oldNode->parentNode->removeChild($oldNode);
			}
		}
	}

}
