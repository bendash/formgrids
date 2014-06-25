<?php
$extensionClassesPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('formgrids') . 'Classes/';
return array(
	'TYPO3\\CMS\\Form\\Domain\\Model\\Element\\GridElement' => $extensionClassesPath . 'Domain/Model/Element/GridElement.php',
	'TYPO3\\CMS\\Form\\Domain\\Model\\Json\\GridJsonElement' => $extensionClassesPath . 'Domain/Model/Element/GridJsonElement.php',
    'TYPO3\\CMS\\Form\\View\\Form\\Element\\GridElementView' => $extensionClassesPath . 'View/Form/Element/GridElementView.php',
    'TYPO3\\CMS\\Form\\View\\Mail\\Html\\Element\\GridElementView' => $extensionClassesPath . 'View/Mail/Html/Element/GridElementView.php',
	'TYPO3\\CMS\\Form\\View\\Mail\\Plain\\Element\\GridElementView' => $extensionClassesPath . 'View/Mail/Plain/Element/GridElementView.php',
);
