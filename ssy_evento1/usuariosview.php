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
$usuarios_view = new usuarios_view();

// Run the page
$usuarios_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuarios_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$usuarios->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fusuariosview = currentForm = new ew.Form("fusuariosview", "view");

// Form_CustomValidate event
fusuariosview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fusuariosview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fusuariosview.lists["x_userlevel_id"] = <?php echo $usuarios_view->userlevel_id->Lookup->toClientList() ?>;
fusuariosview.lists["x_userlevel_id"].options = <?php echo JsonEncode($usuarios_view->userlevel_id->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$usuarios->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $usuarios_view->ExportOptions->render("body") ?>
<?php $usuarios_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $usuarios_view->showPageHeader(); ?>
<?php
$usuarios_view->showMessage();
?>
<form name="fusuariosview" id="fusuariosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($usuarios_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $usuarios_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuarios">
<input type="hidden" name="modal" value="<?php echo (int)$usuarios_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($usuarios->idusuarios->Visible) { // idusuarios ?>
	<tr id="r_idusuarios">
		<td class="<?php echo $usuarios_view->TableLeftColumnClass ?>"><span id="elh_usuarios_idusuarios"><?php echo $usuarios->idusuarios->caption() ?></span></td>
		<td data-name="idusuarios"<?php echo $usuarios->idusuarios->cellAttributes() ?>>
<span id="el_usuarios_idusuarios">
<span<?php echo $usuarios->idusuarios->viewAttributes() ?>>
<?php echo $usuarios->idusuarios->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuarios->nombrecompleto->Visible) { // nombrecompleto ?>
	<tr id="r_nombrecompleto">
		<td class="<?php echo $usuarios_view->TableLeftColumnClass ?>"><span id="elh_usuarios_nombrecompleto"><?php echo $usuarios->nombrecompleto->caption() ?></span></td>
		<td data-name="nombrecompleto"<?php echo $usuarios->nombrecompleto->cellAttributes() ?>>
<span id="el_usuarios_nombrecompleto">
<span<?php echo $usuarios->nombrecompleto->viewAttributes() ?>>
<?php echo $usuarios->nombrecompleto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuarios->correo->Visible) { // correo ?>
	<tr id="r_correo">
		<td class="<?php echo $usuarios_view->TableLeftColumnClass ?>"><span id="elh_usuarios_correo"><?php echo $usuarios->correo->caption() ?></span></td>
		<td data-name="correo"<?php echo $usuarios->correo->cellAttributes() ?>>
<span id="el_usuarios_correo">
<span<?php echo $usuarios->correo->viewAttributes() ?>>
<?php echo $usuarios->correo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuarios->contrasenia->Visible) { // contrasenia ?>
	<tr id="r_contrasenia">
		<td class="<?php echo $usuarios_view->TableLeftColumnClass ?>"><span id="elh_usuarios_contrasenia"><?php echo $usuarios->contrasenia->caption() ?></span></td>
		<td data-name="contrasenia"<?php echo $usuarios->contrasenia->cellAttributes() ?>>
<span id="el_usuarios_contrasenia">
<span<?php echo $usuarios->contrasenia->viewAttributes() ?>>
<?php echo $usuarios->contrasenia->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuarios->userlevel_id->Visible) { // userlevel_id ?>
	<tr id="r_userlevel_id">
		<td class="<?php echo $usuarios_view->TableLeftColumnClass ?>"><span id="elh_usuarios_userlevel_id"><?php echo $usuarios->userlevel_id->caption() ?></span></td>
		<td data-name="userlevel_id"<?php echo $usuarios->userlevel_id->cellAttributes() ?>>
<span id="el_usuarios_userlevel_id">
<span<?php echo $usuarios->userlevel_id->viewAttributes() ?>>
<?php echo $usuarios->userlevel_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$usuarios_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$usuarios->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$usuarios_view->terminate();
?>