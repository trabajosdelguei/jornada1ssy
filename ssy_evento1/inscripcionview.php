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
$inscripcion_view = new inscripcion_view();

// Run the page
$inscripcion_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inscripcion_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$inscripcion->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var finscripcionview = currentForm = new ew.Form("finscripcionview", "view");

// Form_CustomValidate event
finscripcionview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
finscripcionview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$inscripcion->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $inscripcion_view->ExportOptions->render("body") ?>
<?php $inscripcion_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $inscripcion_view->showPageHeader(); ?>
<?php
$inscripcion_view->showMessage();
?>
<form name="finscripcionview" id="finscripcionview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($inscripcion_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $inscripcion_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inscripcion">
<input type="hidden" name="modal" value="<?php echo (int)$inscripcion_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($inscripcion->idinscripcion->Visible) { // idinscripcion ?>
	<tr id="r_idinscripcion">
		<td class="<?php echo $inscripcion_view->TableLeftColumnClass ?>"><span id="elh_inscripcion_idinscripcion"><?php echo $inscripcion->idinscripcion->caption() ?></span></td>
		<td data-name="idinscripcion"<?php echo $inscripcion->idinscripcion->cellAttributes() ?>>
<span id="el_inscripcion_idinscripcion">
<span<?php echo $inscripcion->idinscripcion->viewAttributes() ?>>
<?php echo $inscripcion->idinscripcion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inscripcion->nombre->Visible) { // nombre ?>
	<tr id="r_nombre">
		<td class="<?php echo $inscripcion_view->TableLeftColumnClass ?>"><span id="elh_inscripcion_nombre"><?php echo $inscripcion->nombre->caption() ?></span></td>
		<td data-name="nombre"<?php echo $inscripcion->nombre->cellAttributes() ?>>
<span id="el_inscripcion_nombre">
<span<?php echo $inscripcion->nombre->viewAttributes() ?>>
<?php echo $inscripcion->nombre->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inscripcion->institucion->Visible) { // institucion ?>
	<tr id="r_institucion">
		<td class="<?php echo $inscripcion_view->TableLeftColumnClass ?>"><span id="elh_inscripcion_institucion"><?php echo $inscripcion->institucion->caption() ?></span></td>
		<td data-name="institucion"<?php echo $inscripcion->institucion->cellAttributes() ?>>
<span id="el_inscripcion_institucion">
<span<?php echo $inscripcion->institucion->viewAttributes() ?>>
<?php echo $inscripcion->institucion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inscripcion->rfc->Visible) { // rfc ?>
	<tr id="r_rfc">
		<td class="<?php echo $inscripcion_view->TableLeftColumnClass ?>"><span id="elh_inscripcion_rfc"><?php echo $inscripcion->rfc->caption() ?></span></td>
		<td data-name="rfc"<?php echo $inscripcion->rfc->cellAttributes() ?>>
<span id="el_inscripcion_rfc">
<span<?php echo $inscripcion->rfc->viewAttributes() ?>>
<?php echo $inscripcion->rfc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inscripcion->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $inscripcion_view->TableLeftColumnClass ?>"><span id="elh_inscripcion__email"><?php echo $inscripcion->_email->caption() ?></span></td>
		<td data-name="_email"<?php echo $inscripcion->_email->cellAttributes() ?>>
<span id="el_inscripcion__email">
<span<?php echo $inscripcion->_email->viewAttributes() ?>>
<?php echo $inscripcion->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$inscripcion_view->showPageFooter();
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
$inscripcion_view->terminate();
?>