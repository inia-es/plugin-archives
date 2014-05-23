<?php

/**
 * @file classes/editor/EditorSubmissionDAO.inc.php
 *
 * Copyright (c) 2003-2011 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * With contributions from:
 * 	- 2014 Instituto Nacional de Investigacion y Tecnologia Agraria y Alimentaria
 *
 * @class EditorSubmissionDAO
 * @ingroup submission
 * @see EditorSubmission
 *
 * @brief Operations for retrieving and modifying EditorSubmission objects.
 */

// $Id$


import('classes.submission.editor.EditorSubmissionDAO');

class EditorSubmissionArchivesDAO extends EditorSubmissionDAO {
	/**
	 * Get all submissions archived for a journal.
	 * @param $journalId int
	 * @param $sectionId int
	 * @param $editorId int
	 * @param $searchField int Symbolic SUBMISSION_FIELD_... identifier
	 * @param $searchMatch string "is" or "contains" or "startsWith"
	 * @param $search String to look in $searchField for
	 * @param $dateField int Symbolic SUBMISSION_FIELD_DATE_... identifier
	 * @param $dateFrom String date to search from
	 * @param $dateTo String date to search to
	 * @param $rangeInfo object
	 * @return array EditorSubmission
	 */
	public function &getEditorArchivesArchived($journalId, $sectionId, $editorId, $searchField = null, $searchMatch = null, $search = null, $dateField = null, $dateFrom = null, $dateTo = null, $rangeInfo = null, $sortBy = null, $sortDirection = SORT_DIRECTION_ASC) {
		$result =& $this->_getUnfilteredEditorSubmissions(
			$journalId, $sectionId, $editorId,
			$searchField, $searchMatch, $search,
			$dateField, $dateFrom, $dateTo,
			'a.status = ' . STATUS_ARCHIVED,
			$rangeInfo, $sortBy, $sortDirection
		);
		$returner = new DAOResultFactory($result, $this, '_returnEditorSubmissionFromRow');
		return $returner;
	}
       public function &getEditorArchivesPublished($journalId, $sectionId, $editorId, $searchField = null, $searchMatch = null, $search = null, $dateField = null, $dateFrom = null, $dateTo = null, $rangeInfo = null, $sortBy = null, $sortDirection = SORT_DIRECTION_ASC) {
		$result =& $this->_getUnfilteredEditorSubmissions(
			$journalId, $sectionId, $editorId,
			$searchField, $searchMatch, $search,
			$dateField, $dateFrom, $dateTo,
			'a.status = ' . STATUS_PUBLISHED,
			$rangeInfo, $sortBy, $sortDirection
		);
		$returner = new DAOResultFactory($result, $this, '_returnEditorSubmissionFromRow');
		return $returner;
	}
       public function &getEditorArchivesDeclined($journalId, $sectionId, $editorId, $searchField = null, $searchMatch = null, $search = null, $dateField = null, $dateFrom = null, $dateTo = null, $rangeInfo = null, $sortBy = null, $sortDirection = SORT_DIRECTION_ASC) {
		$result =& $this->_getUnfilteredEditorSubmissions(
			$journalId, $sectionId, $editorId,
			$searchField, $searchMatch, $search,
			$dateField, $dateFrom, $dateTo,
			'a.status = ' . STATUS_DECLINED,
			$rangeInfo, $sortBy, $sortDirection
		);
		$returner = new DAOResultFactory($result, $this, '_returnEditorSubmissionFromRow');
		return $returner;
	}
}
?>
