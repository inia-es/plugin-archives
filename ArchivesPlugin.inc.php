<?php

/**
 * @file CounterPlugin.inc.php
 *
 * Copyright (c) 2003-2011 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class CounterPlugin
 * @ingroup plugins_generic_counter
 *
 * @brief COUNTER plugin; provides COUNTER statistics.
 */


import('lib.pkp.classes.plugins.GenericPlugin');

class ArchivesPlugin extends GenericPlugin {
	/**
	 * Called as a plugin is registered to the registry
	 * @param $category String Name of category plugin was registered to
	 * @return boolean True iff plugin initialized successfully; if false,
	 * 	the plugin will not be registered.
	 */
	function register($category, $path) {
		$success = parent::register($category, $path);
		if ($success && $this->getEnabled()) {
			HookRegistry::register ('Templates::Editor::Index::Submissions', array(&$this, 'displayMenuArchives'));	
		        HookRegistry::register ('LoadHandler', array(&$this, 'handleRequest'));
		        $this->import('EditorSubmissionArchivesDAO');
			$editorSubmissionArchivesDAO = new EditorSubmissionArchivesDAO();
			DAORegistry::registerDAO('EditorSubmissionArchivesDAO', $editorSubmissionArchivesDAO);
	                }	
		return $success;
	}
	

	function getDisplayName() {
		return Locale::translate('plugins.generic.Archives.displayName');
	}

	function getDescription() {
		return Locale::translate('plugins.generic.Archives.description');
	}
	/**
	 * Get the management plugin
	 * @return object
	 */
	function &getManagerPlugin() {
		$plugin =& PluginRegistry::getPlugin('generic', $this->parentPluginName);
		return $plugin;
	}
      /**
	 * Get the Template path for this plugin.
	 */	
	function getTemplatePath() {
		return parent::getTemplatePath() . 'templates' . DIRECTORY_SEPARATOR ;
	}
	function displayMenuArchives($hookName, $args) {

		$params =& $args[0];
		$smarty =& $args[1];
		$output =& $args[2];
		$output  = '   <ul>  <li>&#187; <a href="'. Request::url(null,'editor','submissions','submissionsArchivesArchived') .'">'.Locale::translate('plugins.generic.Archives.submissionsArchivesArchived').'</a></li>';
		$output .= '     <li>&#187; <a href="'. Request::url(null,'editor','submissions','submissionsArchivesPublished') .'">'.Locale::translate('plugins.generic.Archives.submissionsArchivesPublished').'</a></li>';
		$output .= '     <li>&#187; <a href="'. Request::url(null,'editor','submissions','submissionsArchivesDeclined') .'">'.Locale::translate('plugins.generic.Archives.submissionsArchivesDeclined').'</a></li></ul>';
		return false;
	}

	function handleRequest($hookName, $args) {
		$page =& $args[0];
		$op =& $args[1];
		$sourceFile =& $args[2];
		$accion = Request::getRequestedArgs();
//		print_r($accion);
		// If the request is for the log analyzer itself, handle it.
		if ($page === 'editor') {
		        if($op){
		     	    if($op =='submissions' or $op =="deleteSubmission"){
		        		
		        	  if($accion[0]){	
		        	   $editorPages = array(
					'submissionsArchivesArchived',	
					'submissionsArchivesPublished',	
					'submissionsArchivesDeclined');
					
		    		 if (in_array($accion[0], $editorPages) or $op =="deleteSubmission"  ) {
		    		 	
			                        $this->import('ArchivesHandler');
			                        Registry::set('plugin', $this);
			                        define('HANDLER_CLASS', 'ArchivesHandler');
			                        return true;
		                                                 }
		                                return false;
	                                                
                                                       
                                  }
                                }
                                }
                                }
       }
 }      	
?>
