{**
 * submissions.tpl
 *
 * Copyright (c) 2003-2011 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * With contributions from:
 * 	- 2014 Instituto Nacional de Investigacion y Tecnologia Agraria y Alimentaria
 *
 * Editor submissions page(s).
 *
 * $Id$
 *}
{strip}
{strip}

{assign var="pageTitle" value="plugins.generic.Archives.$pageToDisplay"}
{url|assign:"currentUrl" page="editor" op="submissions" path=$pageToDisplay }
{include file="common/header.tpl"}
{/strip}
{/strip}

<ul class="menu">
	<li{if $pageToDisplay == "submissionsUnassigned"} class="current"{/if}><a href="{url page="editor" op="submissions" path="submissionsUnassigned"}">{translate key="common.queue.short.submissionsUnassigned"}</a></li>
	<li{if $pageToDisplay == "submissionsInReview"} class="current"{/if}><a href="{url page="editor" op="submissions" path="submissionsInReview"}">{translate key="common.queue.short.submissionsInReview"}</a></li>
	<li{if $pageToDisplay == "submissionsInEditing"} class="current"{/if}><a href="{url page="editor" op="submissions" path="submissionsInEditing"}">{translate key="common.queue.short.submissionsInEditing"}</a></li>
	<li{if $pageToDisplay == "submissionsArchives"} class="current"{/if}><a href="{url page="editor" op="submissions" path="submissionsArchives"}">{translate key="common.queue.short.submissionsArchives"}</a></li>
	<li{if $pageToDisplay == "submissionsArchivesArchived"} class="current"{/if}><a href="{url page="editor" op="submissions" path="submissionsArchivesArchived"}">{translate key="plugins.generic.Archives.submissionsArchivesArchived"}</a></li>
	<li{if $pageToDisplay == "submissionsArchivesPublished"} class="current"{/if}><a href="{url page="editor" op="submissions" path="submissionsArchivesPublished"}">{translate key="plugins.generic.Archives.submissionsArchivesPublished"}</a></li>
	<li{if $pageToDisplay == "submissionsArchivesDeclined"} class="current"{/if}><a href="{url page="editor" op="submissions" path="submissionsArchivesDeclined"}">{translate key="plugins.generic.Archives.submissionsArchivesDeclined"}</a></li>
</ul>

<form action="#">
<ul class="filter">
	<li>{translate key="editor.submissions.assignedTo"}: <select name="filterEditor" onchange="location.href='{url|escape:"javascript" path=$pageToDisplay searchField=$searchField searchMatch=$searchMatch search=$search dateFromDay=$dateFromDay dateFromYear=$dateFromYear dateFromMonth=$dateFromMonth dateToDay=$dateToDay dateToYear=$dateToYear dateToMonth=$dateToMonth dateSearchField=$dateSearchField filterEditor="EDITOR" escape=false}'.replace('EDITOR', this.options[this.selectedIndex].value)" size="1" class="selectMenu">{html_options options=$editorOptions selected=$filterEditor}</select></li>
	<li>{translate key="editor.submissions.inSection"}: <select name="filterSection" onchange="location.href='{url|escape:"javascript" path=$pageToDisplay searchField=$searchField searchMatch=$searchMatch search=$search dateFromDay=$dateFromDay dateFromYear=$dateFromYear dateFromMonth=$dateFromMonth dateToDay=$dateToDay dateToYear=$dateToYear dateToMonth=$dateToMonth dateSearchField=$dateSearchField filterSection="SECTION_ID" escape=false}'.replace('SECTION_ID', this.options[this.selectedIndex].value)" size="1" class="selectMenu">{html_options options=$sectionOptions selected=$filterSection}</select></li>
</ul>
</form>

{if !$dateFrom}
{assign var="dateFrom" value="--"}
{/if}

{if !$dateTo}
{assign var="dateTo" value="--"}
{/if}

<script type="text/javascript">
{literal}
<!--
function sortSearch(heading, direction) {
  document.submit.sort.value = heading;
  document.submit.sortDirection.value = direction;
  document.submit.submit() ;
}
// -->
{/literal}
</script> 

<form method="post" name="submit" action="{url op="submissions" path=$pageToDisplay}">
	<input type="hidden" name="sort" value="id"/>
	<input type="hidden" name="sortDirection" value="ASC"/>
	<select name="searchField" size="1" class="selectMenu">
		{html_options_translate options=$fieldOptions selected=$searchField}
	</select>
	<select name="searchMatch" size="1" class="selectMenu">
		<option value="contains"{if $searchMatch == 'contains'} selected="selected"{/if}>{translate key="form.contains"}</option>
		<option value="is"{if $searchMatch == 'is'} selected="selected"{/if}>{translate key="form.is"}</option>
		<option value="startsWith"{if $searchMatch == 'startsWith'} selected="selected"{/if}>{translate key="form.startsWith"}</option>
	</select>
	<input type="text" size="15" name="search" class="textField" value="{$search|escape}" />
	<br/>
	<select name="dateSearchField" size="1" class="selectMenu">
		{html_options_translate options=$dateFieldOptions selected=$dateSearchField}
	</select>
	{translate key="common.between"}
	{html_select_date prefix="dateFrom" time=$dateFrom all_extra="class=\"selectMenu\"" year_empty="" month_empty="" day_empty="" start_year="-5" end_year="+1"}
	{translate key="common.and"}
	{html_select_date prefix="dateTo" time=$dateTo all_extra="class=\"selectMenu\"" year_empty="" month_empty="" day_empty="" start_year="-5" end_year="+1"}
	<input type="hidden" name="dateToHour" value="23" />
	<input type="hidden" name="dateToMinute" value="59" />
	<input type="hidden" name="dateToSecond" value="59" />
	<br/>
	<input type="submit" value="{translate key="common.search"}" class="button" />
</form>
&nbsp;

{include file="$pageDir.tpl"}

{if ($pageToDisplay == "submissionsInReview")}
<br />
<div id="notes">
<h4>{translate key="common.notes"}</h4>
{translate key="editor.submissionReview.notes"}
</div>
{/if}

{include file="common/footer.tpl"}
