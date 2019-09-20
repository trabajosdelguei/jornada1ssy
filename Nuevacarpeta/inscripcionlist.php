<?php
namespace PHPMaker2019\project5;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$inscripcion_list = new inscripcion_list();

// Run the page
$inscripcion_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inscripcion_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$inscripcion->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var finscripcionlist = currentForm = new ew.Form("finscripcionlist", "list");
finscripcionlist.formKeyCountName = '<?php echo $inscripcion_list->FormKeyCountName ?>';

// Form_CustomValidate event
finscripcionlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
finscripcionlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var finscripcionlistsrch = currentSearchForm = new ew.Form("finscripcionlistsrch");

// Filters
finscripcionlistsrch.filterList = <?php echo $inscripcion_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$inscripcion->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($inscripcion_list->TotalRecs > 0 && $inscripcion_list->ExportOptions->visible()) { ?>
<?php $inscripcion_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($inscripcion_list->ImportOptions->visible()) { ?>
<?php $inscripcion_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($inscripcion_list->SearchOptions->visible()) { ?>
<?php $inscripcion_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($inscripcion_list->FilterOptions->visible()) { ?>
<?php $inscripcion_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$inscripcion_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$inscripcion->isExport() && !$inscripcion->CurrentAction) { ?>
<form name="finscripcionlistsrch" id="finscripcionlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($inscripcion_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="finscripcionlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="inscripcion">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($inscripcion_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($inscripcion_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $inscripcion_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($inscripcion_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($inscripcion_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($inscripcion_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($inscripcion_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $inscripcion_list->showPageHeader(); ?>
<?php
$inscripcion_list->showMessage();
?>
<?php if ($inscripcion_list->TotalRecs > 0 || $inscripcion->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($inscripcion_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> inscripcion">
<form name="finscripcionlist" id="finscripcionlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($inscripcion_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $inscripcion_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inscripcion">
<div id="gmp_inscripcion" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($inscripcion_list->TotalRecs > 0 || $inscripcion->isGridEdit()) { ?>
<table id="tbl_inscripcionlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$inscripcion_list->RowType = ROWTYPE_HEADER;

// Render list options
$inscripcion_list->renderListOptions();

// Render list options (header, left)
$inscripcion_list->ListOptions->render("header", "left");
?>
<?php if ($inscripcion->idinscripcion->Visible) { // idinscripcion ?>
	<?php if ($inscripcion->sortUrl($inscripcion->idinscripcion) == "") { ?>
		<th data-name="idinscripcion" class="<?php echo $inscripcion->idinscripcion->headerCellClass() ?>"><div id="elh_inscripcion_idinscripcion" class="inscripcion_idinscripcion"><div class="ew-table-header-caption"><?php echo $inscripcion->idinscripcion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idinscripcion" class="<?php echo $inscripcion->idinscripcion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inscripcion->SortUrl($inscripcion->idinscripcion) ?>',1);"><div id="elh_inscripcion_idinscripcion" class="inscripcion_idinscripcion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inscripcion->idinscripcion->caption() ?></span><span class="ew-table-header-sort"><?php if ($inscripcion->idinscripcion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inscripcion->idinscripcion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inscripcion->nombre->Visible) { // nombre ?>
	<?php if ($inscripcion->sortUrl($inscripcion->nombre) == "") { ?>
		<th data-name="nombre" class="<?php echo $inscripcion->nombre->headerCellClass() ?>"><div id="elh_inscripcion_nombre" class="inscripcion_nombre"><div class="ew-table-header-caption"><?php echo $inscripcion->nombre->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombre" class="<?php echo $inscripcion->nombre->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inscripcion->SortUrl($inscripcion->nombre) ?>',1);"><div id="elh_inscripcion_nombre" class="inscripcion_nombre">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inscripcion->nombre->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inscripcion->nombre->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inscripcion->nombre->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inscripcion->apellido->Visible) { // apellido ?>
	<?php if ($inscripcion->sortUrl($inscripcion->apellido) == "") { ?>
		<th data-name="apellido" class="<?php echo $inscripcion->apellido->headerCellClass() ?>"><div id="elh_inscripcion_apellido" class="inscripcion_apellido"><div class="ew-table-header-caption"><?php echo $inscripcion->apellido->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="apellido" class="<?php echo $inscripcion->apellido->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inscripcion->SortUrl($inscripcion->apellido) ?>',1);"><div id="elh_inscripcion_apellido" class="inscripcion_apellido">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inscripcion->apellido->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inscripcion->apellido->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inscripcion->apellido->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inscripcion->e_mail->Visible) { // e-mail ?>
	<?php if ($inscripcion->sortUrl($inscripcion->e_mail) == "") { ?>
		<th data-name="e_mail" class="<?php echo $inscripcion->e_mail->headerCellClass() ?>"><div id="elh_inscripcion_e_mail" class="inscripcion_e_mail"><div class="ew-table-header-caption"><?php echo $inscripcion->e_mail->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="e_mail" class="<?php echo $inscripcion->e_mail->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inscripcion->SortUrl($inscripcion->e_mail) ?>',1);"><div id="elh_inscripcion_e_mail" class="inscripcion_e_mail">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inscripcion->e_mail->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inscripcion->e_mail->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inscripcion->e_mail->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inscripcion->institucion->Visible) { // institucion ?>
	<?php if ($inscripcion->sortUrl($inscripcion->institucion) == "") { ?>
		<th data-name="institucion" class="<?php echo $inscripcion->institucion->headerCellClass() ?>"><div id="elh_inscripcion_institucion" class="inscripcion_institucion"><div class="ew-table-header-caption"><?php echo $inscripcion->institucion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="institucion" class="<?php echo $inscripcion->institucion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inscripcion->SortUrl($inscripcion->institucion) ?>',1);"><div id="elh_inscripcion_institucion" class="inscripcion_institucion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inscripcion->institucion->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inscripcion->institucion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inscripcion->institucion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inscripcion->rfc->Visible) { // rfc ?>
	<?php if ($inscripcion->sortUrl($inscripcion->rfc) == "") { ?>
		<th data-name="rfc" class="<?php echo $inscripcion->rfc->headerCellClass() ?>"><div id="elh_inscripcion_rfc" class="inscripcion_rfc"><div class="ew-table-header-caption"><?php echo $inscripcion->rfc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rfc" class="<?php echo $inscripcion->rfc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inscripcion->SortUrl($inscripcion->rfc) ?>',1);"><div id="elh_inscripcion_rfc" class="inscripcion_rfc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inscripcion->rfc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inscripcion->rfc->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inscripcion->rfc->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$inscripcion_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($inscripcion->ExportAll && $inscripcion->isExport()) {
	$inscripcion_list->StopRec = $inscripcion_list->TotalRecs;
} else {

	// Set the last record to display
	if ($inscripcion_list->TotalRecs > $inscripcion_list->StartRec + $inscripcion_list->DisplayRecs - 1)
		$inscripcion_list->StopRec = $inscripcion_list->StartRec + $inscripcion_list->DisplayRecs - 1;
	else
		$inscripcion_list->StopRec = $inscripcion_list->TotalRecs;
}
$inscripcion_list->RecCnt = $inscripcion_list->StartRec - 1;
if ($inscripcion_list->Recordset && !$inscripcion_list->Recordset->EOF) {
	$inscripcion_list->Recordset->moveFirst();
	$selectLimit = $inscripcion_list->UseSelectLimit;
	if (!$selectLimit && $inscripcion_list->StartRec > 1)
		$inscripcion_list->Recordset->move($inscripcion_list->StartRec - 1);
} elseif (!$inscripcion->AllowAddDeleteRow && $inscripcion_list->StopRec == 0) {
	$inscripcion_list->StopRec = $inscripcion->GridAddRowCount;
}

// Initialize aggregate
$inscripcion->RowType = ROWTYPE_AGGREGATEINIT;
$inscripcion->resetAttributes();
$inscripcion_list->renderRow();
while ($inscripcion_list->RecCnt < $inscripcion_list->StopRec) {
	$inscripcion_list->RecCnt++;
	if ($inscripcion_list->RecCnt >= $inscripcion_list->StartRec) {
		$inscripcion_list->RowCnt++;

		// Set up key count
		$inscripcion_list->KeyCount = $inscripcion_list->RowIndex;

		// Init row class and style
		$inscripcion->resetAttributes();
		$inscripcion->CssClass = "";
		if ($inscripcion->isGridAdd()) {
		} else {
			$inscripcion_list->loadRowValues($inscripcion_list->Recordset); // Load row values
		}
		$inscripcion->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$inscripcion->RowAttrs = array_merge($inscripcion->RowAttrs, array('data-rowindex'=>$inscripcion_list->RowCnt, 'id'=>'r' . $inscripcion_list->RowCnt . '_inscripcion', 'data-rowtype'=>$inscripcion->RowType));

		// Render row
		$inscripcion_list->renderRow();

		// Render list options
		$inscripcion_list->renderListOptions();
?>
	<tr<?php echo $inscripcion->rowAttributes() ?>>
<?php

// Render list options (body, left)
$inscripcion_list->ListOptions->render("body", "left", $inscripcion_list->RowCnt);
?>
	<?php if ($inscripcion->idinscripcion->Visible) { // idinscripcion ?>
		<td data-name="idinscripcion"<?php echo $inscripcion->idinscripcion->cellAttributes() ?>>
<span id="el<?php echo $inscripcion_list->RowCnt ?>_inscripcion_idinscripcion" class="inscripcion_idinscripcion">
<span<?php echo $inscripcion->idinscripcion->viewAttributes() ?>>
<?php echo $inscripcion->idinscripcion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inscripcion->nombre->Visible) { // nombre ?>
		<td data-name="nombre"<?php echo $inscripcion->nombre->cellAttributes() ?>>
<span id="el<?php echo $inscripcion_list->RowCnt ?>_inscripcion_nombre" class="inscripcion_nombre">
<span<?php echo $inscripcion->nombre->viewAttributes() ?>>
<?php echo $inscripcion->nombre->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inscripcion->apellido->Visible) { // apellido ?>
		<td data-name="apellido"<?php echo $inscripcion->apellido->cellAttributes() ?>>
<span id="el<?php echo $inscripcion_list->RowCnt ?>_inscripcion_apellido" class="inscripcion_apellido">
<span<?php echo $inscripcion->apellido->viewAttributes() ?>>
<?php echo $inscripcion->apellido->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inscripcion->e_mail->Visible) { // e-mail ?>
		<td data-name="e_mail"<?php echo $inscripcion->e_mail->cellAttributes() ?>>
<span id="el<?php echo $inscripcion_list->RowCnt ?>_inscripcion_e_mail" class="inscripcion_e_mail">
<span<?php echo $inscripcion->e_mail->viewAttributes() ?>>
<?php echo $inscripcion->e_mail->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inscripcion->institucion->Visible) { // institucion ?>
		<td data-name="institucion"<?php echo $inscripcion->institucion->cellAttributes() ?>>
<span id="el<?php echo $inscripcion_list->RowCnt ?>_inscripcion_institucion" class="inscripcion_institucion">
<span<?php echo $inscripcion->institucion->viewAttributes() ?>>
<?php echo $inscripcion->institucion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inscripcion->rfc->Visible) { // rfc ?>
		<td data-name="rfc"<?php echo $inscripcion->rfc->cellAttributes() ?>>
<span id="el<?php echo $inscripcion_list->RowCnt ?>_inscripcion_rfc" class="inscripcion_rfc">
<span<?php echo $inscripcion->rfc->viewAttributes() ?>>
<?php echo $inscripcion->rfc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$inscripcion_list->ListOptions->render("body", "right", $inscripcion_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$inscripcion->isGridAdd())
		$inscripcion_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$inscripcion->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($inscripcion_list->Recordset)
	$inscripcion_list->Recordset->Close();
?>
<?php if (!$inscripcion->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$inscripcion->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($inscripcion_list->Pager)) $inscripcion_list->Pager = new PrevNextPager($inscripcion_list->StartRec, $inscripcion_list->DisplayRecs, $inscripcion_list->TotalRecs, $inscripcion_list->AutoHidePager) ?>
<?php if ($inscripcion_list->Pager->RecordCount > 0 && $inscripcion_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($inscripcion_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $inscripcion_list->pageUrl() ?>start=<?php echo $inscripcion_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($inscripcion_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $inscripcion_list->pageUrl() ?>start=<?php echo $inscripcion_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $inscripcion_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($inscripcion_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $inscripcion_list->pageUrl() ?>start=<?php echo $inscripcion_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($inscripcion_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $inscripcion_list->pageUrl() ?>start=<?php echo $inscripcion_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $inscripcion_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($inscripcion_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $inscripcion_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $inscripcion_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $inscripcion_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $inscripcion_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($inscripcion_list->TotalRecs == 0 && !$inscripcion->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $inscripcion_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$inscripcion_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$inscripcion->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$inscripcion_list->terminate();
?>