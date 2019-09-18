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
$usuarios_delete = new usuarios_delete();

// Run the page
$usuarios_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuarios_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fusuariosdelete = currentForm = new ew.Form("fusuariosdelete", "delete");

// Form_CustomValidate event
fusuariosdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fusuariosdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fusuariosdelete.lists["x_userlevel_id"] = <?php echo $usuarios_delete->userlevel_id->Lookup->toClientList() ?>;
fusuariosdelete.lists["x_userlevel_id"].options = <?php echo JsonEncode($usuarios_delete->userlevel_id->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $usuarios_delete->showPageHeader(); ?>
<?php
$usuarios_delete->showMessage();
?>
<form name="fusuariosdelete" id="fusuariosdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($usuarios_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $usuarios_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuarios">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($usuarios_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($usuarios->idusuarios->Visible) { // idusuarios ?>
		<th class="<?php echo $usuarios->idusuarios->headerCellClass() ?>"><span id="elh_usuarios_idusuarios" class="usuarios_idusuarios"><?php echo $usuarios->idusuarios->caption() ?></span></th>
<?php } ?>
<?php if ($usuarios->nombrecompleto->Visible) { // nombrecompleto ?>
		<th class="<?php echo $usuarios->nombrecompleto->headerCellClass() ?>"><span id="elh_usuarios_nombrecompleto" class="usuarios_nombrecompleto"><?php echo $usuarios->nombrecompleto->caption() ?></span></th>
<?php } ?>
<?php if ($usuarios->correo->Visible) { // correo ?>
		<th class="<?php echo $usuarios->correo->headerCellClass() ?>"><span id="elh_usuarios_correo" class="usuarios_correo"><?php echo $usuarios->correo->caption() ?></span></th>
<?php } ?>
<?php if ($usuarios->contrasenia->Visible) { // contrasenia ?>
		<th class="<?php echo $usuarios->contrasenia->headerCellClass() ?>"><span id="elh_usuarios_contrasenia" class="usuarios_contrasenia"><?php echo $usuarios->contrasenia->caption() ?></span></th>
<?php } ?>
<?php if ($usuarios->userlevel_id->Visible) { // userlevel_id ?>
		<th class="<?php echo $usuarios->userlevel_id->headerCellClass() ?>"><span id="elh_usuarios_userlevel_id" class="usuarios_userlevel_id"><?php echo $usuarios->userlevel_id->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$usuarios_delete->RecCnt = 0;
$i = 0;
while (!$usuarios_delete->Recordset->EOF) {
	$usuarios_delete->RecCnt++;
	$usuarios_delete->RowCnt++;

	// Set row properties
	$usuarios->resetAttributes();
	$usuarios->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$usuarios_delete->loadRowValues($usuarios_delete->Recordset);

	// Render row
	$usuarios_delete->renderRow();
?>
	<tr<?php echo $usuarios->rowAttributes() ?>>
<?php if ($usuarios->idusuarios->Visible) { // idusuarios ?>
		<td<?php echo $usuarios->idusuarios->cellAttributes() ?>>
<span id="el<?php echo $usuarios_delete->RowCnt ?>_usuarios_idusuarios" class="usuarios_idusuarios">
<span<?php echo $usuarios->idusuarios->viewAttributes() ?>>
<?php echo $usuarios->idusuarios->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuarios->nombrecompleto->Visible) { // nombrecompleto ?>
		<td<?php echo $usuarios->nombrecompleto->cellAttributes() ?>>
<span id="el<?php echo $usuarios_delete->RowCnt ?>_usuarios_nombrecompleto" class="usuarios_nombrecompleto">
<span<?php echo $usuarios->nombrecompleto->viewAttributes() ?>>
<?php echo $usuarios->nombrecompleto->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuarios->correo->Visible) { // correo ?>
		<td<?php echo $usuarios->correo->cellAttributes() ?>>
<span id="el<?php echo $usuarios_delete->RowCnt ?>_usuarios_correo" class="usuarios_correo">
<span<?php echo $usuarios->correo->viewAttributes() ?>>
<?php echo $usuarios->correo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuarios->contrasenia->Visible) { // contrasenia ?>
		<td<?php echo $usuarios->contrasenia->cellAttributes() ?>>
<span id="el<?php echo $usuarios_delete->RowCnt ?>_usuarios_contrasenia" class="usuarios_contrasenia">
<span<?php echo $usuarios->contrasenia->viewAttributes() ?>>
<?php echo $usuarios->contrasenia->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuarios->userlevel_id->Visible) { // userlevel_id ?>
		<td<?php echo $usuarios->userlevel_id->cellAttributes() ?>>
<span id="el<?php echo $usuarios_delete->RowCnt ?>_usuarios_userlevel_id" class="usuarios_userlevel_id">
<span<?php echo $usuarios->userlevel_id->viewAttributes() ?>>
<?php echo $usuarios->userlevel_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$usuarios_delete->Recordset->moveNext();
}
$usuarios_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $usuarios_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$usuarios_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$usuarios_delete->terminate();
?>