<?php
$extensionClassesPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('formgrids') . 'Classes/';
return array(
	'TYPO3\\CMS\\Form\\Domain\\Model\\Element\\GridElement' => $extensionClassesPath . 'Other/GridElement.php',
	'TYPO3\\CMS\\Form\\Domain\\Model\\Json\\GridJsonElement' => $extensionClassesPath . 'Other/GridJsonElement.php',
        'TYPO3\\CMS\\Form\\View\\Form\\Element\\GridElementView' => $extensionClassesPath . 'Other/GridElementView.php',
);
