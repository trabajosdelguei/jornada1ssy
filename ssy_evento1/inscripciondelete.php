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
$inscripcion_delete = new inscripcion_delete();

// Run the page
$inscripcion_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inscripcion_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var finscripciondelete = currentForm = new ew.Form("finscripciondelete", "delete");

// Form_CustomValidate event
finscripciondelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
finscripciondelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $inscripcion_delete->showPageHeader(); ?>
<?php
$inscripcion_delete->showMessage();
?>
<form name="finscripciondelete" id="finscripciondelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($inscripcion_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $inscripcion_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inscripcion">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($inscripcion_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($inscripcion->idinscripcion->Visible) { // idinscripcion ?>
		<th class="<?php echo $inscripcion->idinscripcion->headerCellClass() ?>"><span id="elh_inscripcion_idinscripcion" class="inscripcion_idinscripcion"><?php echo $inscripcion->idinscripcion->caption() ?></span></th>
<?php } ?>
<?php if ($inscripcion->nombre->Visible) { // nombre ?>
		<th class="<?php echo $inscripcion->nombre->headerCellClass() ?>"><span id="elh_inscripcion_nombre" class="inscripcion_nombre"><?php echo $inscripcion->nombre->caption() ?></span></th>
<?php } ?>
<?php if ($inscripcion->apellido->Visible) { // apellido ?>
		<th class="<?php echo $inscripcion->apellido->headerCellClass() ?>"><span id="elh_inscripcion_apellido" class="inscripcion_apellido"><?php echo $inscripcion->apellido->caption() ?></span></th>
<?php } ?>
<?php if ($inscripcion->e_mail->Visible) { // e-mail ?>
		<th class="<?php echo $inscripcion->e_mail->headerCellClass() ?>"><span id="elh_inscripcion_e_mail" class="inscripcion_e_mail"><?php echo $inscripcion->e_mail->caption() ?></span></th>
<?php } ?>
<?php if ($inscripcion->institucion->Visible) { // institucion ?>
		<th class="<?php echo $inscripcion->institucion->headerCellClass() ?>"><span id="elh_inscripcion_institucion" class="inscripcion_institucion"><?php echo $inscripcion->institucion->caption() ?></span></th>
<?php } ?>
<?php if ($inscripcion->rfc->Visible) { // rfc ?>
		<th class="<?php echo $inscripcion->rfc->headerCellClass() ?>"><span id="elh_inscripcion_rfc" class="inscripcion_rfc"><?php echo $inscripcion->rfc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$inscripcion_delete->RecCnt = 0;
$i = 0;
while (!$inscripcion_delete->Recordset->EOF) {
	$inscripcion_delete->RecCnt++;
	$inscripcion_delete->RowCnt++;

	// Set row properties
	$inscripcion->resetAttributes();
	$inscripcion->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$inscripcion_delete->loadRowValues($inscripcion_delete->Recordset);

	// Render row
	$inscripcion_delete->renderRow();
?>
	<tr<?php echo $inscripcion->rowAttributes() ?>>
<?php if ($inscripcion->idinscripcion->Visible) { // idinscripcion ?>
		<td<?php echo $inscripcion->idinscripcion->cellAttributes() ?>>
<span id="el<?php echo $inscripcion_delete->RowCnt ?>_inscripcion_idinscripcion" class="inscripcion_idinscripcion">
<span<?php echo $inscripcion->idinscripcion->viewAttributes() ?>>
<?php echo $inscripcion->idinscripcion->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inscripcion->nombre->Visible) { // nombre ?>
		<td<?php echo $inscripcion->nombre->cellAttributes() ?>>
<span id="el<?php echo $inscripcion_delete->RowCnt ?>_inscripcion_nombre" class="inscripcion_nombre">
<span<?php echo $inscripcion->nombre->viewAttributes() ?>>
<?php echo $inscripcion->nombre->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inscripcion->apellido->Visible) { // apellido ?>
		<td<?php echo $inscripcion->apellido->cellAttributes() ?>>
<span id="el<?php echo $inscripcion_delete->RowCnt ?>_inscripcion_apellido" class="inscripcion_apellido">
<span<?php echo $inscripcion->apellido->viewAttributes() ?>>
<?php echo $inscripcion->apellido->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inscripcion->e_mail->Visible) { // e-mail ?>
		<td<?php echo $inscripcion->e_mail->cellAttributes() ?>>
<span id="el<?php echo $inscripcion_delete->RowCnt ?>_inscripcion_e_mail" class="inscripcion_e_mail">
<span<?php echo $inscripcion->e_mail->viewAttributes() ?>>
<?php echo $inscripcion->e_mail->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inscripcion->institucion->Visible) { // institucion ?>
		<td<?php echo $inscripcion->institucion->cellAttributes() ?>>
<span id="el<?php echo $inscripcion_delete->RowCnt ?>_inscripcion_institucion" class="inscripcion_institucion">
<span<?php echo $inscripcion->institucion->viewAttributes() ?>>
<?php echo $inscripcion->institucion->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inscripcion->rfc->Visible) { // rfc ?>
		<td<?php echo $inscripcion->rfc->cellAttributes() ?>>
<span id="el<?php echo $inscripcion_delete->RowCnt ?>_inscripcion_rfc" class="inscripcion_rfc">
<span<?php echo $inscripcion->rfc->viewAttributes() ?>>
<?php echo $inscripcion->rfc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$inscripcion_delete->Recordset->moveNext();
}
$inscripcion_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $inscripcion_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$inscripcion_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$inscripcion_delete->terminate();
?>