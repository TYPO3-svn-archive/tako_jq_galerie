<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_takojqgalerie_images'] = array (
	'ctrl' => $TCA['tx_takojqgalerie_images']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,preview'
	),
	'feInterface' => $TCA['tx_takojqgalerie_images']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'preview' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:tako_jq_galerie/locallang_db.xml:tx_takojqgalerie_images.preview',		
			'config' => array (
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],	
				'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],	
				'uploadfolder' => 'uploads/tx_takojqgalerie',
				'show_thumbs' => 1,	
				'size' => 2,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, preview')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);
?>