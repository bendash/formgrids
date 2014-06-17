<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

// Add Form Object 'GRID' to FormUtility Singleton
$formUtility = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Form\\Utility\\FormUtility');
$formUtility->setFormObjects(array_merge($formUtility->getFormObjects(), array('GRID')));

// XCLASS TypoScriptFactory of sysext 'form'
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Form\\Domain\\Factory\\TypoScriptFactory'] = array(
    'className' => 'WorldDirect\\Formgrids\\Xclass\\TypoScriptFactory',
);

// XCLASS JsonToTypoScript Factory of sysext 'form'
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Form\\Domain\\Factory\\JsonToTypoScript'] = array(
    'className' => 'WorldDirect\\Formgrids\\Xclass\\JsonToTypoScript',
);

// XCLASS TypoScriptToJsonConverter of sysext 'form'
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Form\\Utility\\TypoScriptToJsonConverter'] = array(
    'className' => 'WorldDirect\\Formgrids\\Xclass\\TypoScriptToJsonConverter',
);

// Register a Hook for the Backend Form Wizard
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['form']['hooks']['renderWizard'][] = 'WorldDirect\\Formgrids\\Hooks\\WizardViewHook->initialize';


// Add Page TS Config for form wizard
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/TsConfig/page.ts">');



?>
