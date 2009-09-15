<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009 takomat Agentur <takodev@takomat.com>
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
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 * Hint: use extdeveval to insert/update function index above.
 */

require_once(PATH_tslib.'class.tslib_pibase.php');


/**
 * Plugin 'tako jQuery Gallery' for the 'tako_jq_galerie' extension.
 *
 * @author	takomat Agentur <takodev@takomat.com>
 * @package	TYPO3
 * @subpackage	tx_takojqgalerie
 */
class tx_takojqgalerie_pi1 extends tslib_pibase {
	var $prefixId      = 'tx_takojqgalerie_pi1';		// Same as class name
	var $scriptRelPath = 'pi1/class.tx_takojqgalerie_pi1.php';	// Path to this script relative to the extension dir.
	var $extKey        = 'tako_jq_galerie';	// The extension key.
	var $pi_checkCHash = true;
	
	/**
	 * The main method of the PlugIn
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @return	The content that is displayed on the website
	 */
	function main($content, $conf) {
		$this->conf = $conf;
		$this->pi_setPiVarDefaults();
		$this->pi_loadLL();
		
		$this->pi_initPIflexForm(); // Init and get the flexform data of the plugin
		$this->lConf = array(); // Setup our storage array..
		// Assign the flexform data to a local variable for easier access
		
		$this->getPluginConfig();
		$this->getImages();
		$this->generateLinks();
		$this->generateButton();
		//renderTemplate();
		//t3lib_div::debug($piFlexForm['data'],'list array'); 
		
		$content = $this->renderTemplate(); 
	
		return $this->pi_wrapInBaseClass($content);
	}
	
	
	function getPluginConfig(){
		$piFlexForm = $this->cObj->data['pi_flexform'];
		$this->path = $this->pi_getFFvalue($this->cObj->data['pi_flexform'],'path','sDEF')."/";
		$this->buttonText = $this->pi_getFFvalue($this->cObj->data['pi_flexform'],'button','sDEF');
		$this->prevIMG = $this->pi_getFFvalue($this->cObj->data['pi_flexform'],'preview','sDEF');
		$this->galTitel = $this->pi_getFFvalue($this->cObj->data['pi_flexform'],'titel','sDEF');
	}
	function generateButton(){
		$this->button = $this->LinkArray[0].$this->buttonText.'</a>';
	}
	function getImages(){
		$this->img = '<img src="/uploads/tako_jq_galerie/'.$this->prevIMG.'" />';
	}
	function generateLinks(){
		$this->LinkArray = array();
		$handle=opendir ($this->path);
		
		//echo "Verzeichnisinhalt:<br>";
		$rand = mt_rand(0,9999);
		
		$linkBefore = '<a href="';
		$linkAfter = '" rel="lightbox['.$rand.']" title="'.$this->galTitel.'" class="lightbox">';
		$i = 0;
		while ($datei = readdir ($handle)) {
			if(!file_exists($datei)){
				
				 $this->LinkArray[] = $linkBefore.$this->path.$datei.$linkAfter;
				 if($i!=0){
					 $this->links .= $linkBefore.$this->path.$datei.$linkAfter.'</a>';
				 }
				 
				 $i++;
			}
		
		
		}
		
		closedir($handle);
		//t3lib_div::debug($this->LinkArray,'list array'); 
		//$this->links = '<a href="#">mudda</a>';
	}
	function renderTemplate(){
		$this->template=$this->cObj->fileResource('EXT:tako_jq_galerie/template.html');  
		$subpart=$this->cObj->getSubpart($this->template,'###LISTVIEW###'); 
		$markerArray['###IMAGE###']=$this->img;
		$markerArray['###BUTTON###']=$this->button;
		$markerArray['###LINKS###']=$this->links;
		return $this->cObj->substituteMarkerArrayCached($subpart,$markerArray,$subpartArray,array()); 
	}
	
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tako_jq_galerie/pi1/class.tx_takojqgalerie_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tako_jq_galerie/pi1/class.tx_takojqgalerie_pi1.php']);
}

?>