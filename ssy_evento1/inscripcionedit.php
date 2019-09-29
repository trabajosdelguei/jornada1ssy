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
$inscripcion_edit = new inscripcion_edit();

// Run the page
$inscripcion_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inscripcion_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var finscripcionedit = currentForm = new ew.Form("finscripcionedit", "edit");

// Validate form
finscripcionedit.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($inscripcion_edit->idinscripcion->Required) { ?>
			elm = this.getElements("x" + infix + "_idinscripcion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inscripcion->idinscripcion->caption(), $inscripcion->idinscripcion->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($inscripcion_edit->nombre->Required) { ?>
			elm = this.getElements("x" + infix + "_nombre");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inscripcion->nombre->caption(), $inscripcion->nombre->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($inscripcion_edit->institucion->Required) { ?>
			elm = this.getElements("x" + infix + "_institucion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inscripcion->institucion->caption(), $inscripcion->institucion->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($inscripcion_edit->rfc->Required) { ?>
			elm = this.getElements("x" + infix + "_rfc");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inscripcion->rfc->caption(), $inscripcion->rfc->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($inscripcion_edit->_email->Required) { ?>
			elm = this.getElements("x" + infix + "__email");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inscripcion->_email->caption(), $inscripcion->_email->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ew.forms[val])
			if (!ew.forms[val].validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
finscripcionedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
finscripcionedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $inscripcion_edit->showPageHeader(); ?>
<?php
$inscripcion_edit->showMessage();
?>
<form name="finscripcionedit" id="finscripcionedit" class="<?php echo $inscripcion_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($inscripcion_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $inscripcion_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inscripcion">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$inscripcion_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($inscripcion->idinscripcion->Visible) { // idinscripcion ?>
	<div id="r_idinscripcion" class="form-group row">
		<label id="elh_inscripcion_idinscripcion" class="<?php echo $inscripcion_edit->LeftColumnClass ?>"><?php echo $inscripcion->idinscripcion->caption() ?><?php echo ($inscripcion->idinscripcion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inscripcion_edit->RightColumnClass ?>"><div<?php echo $inscripcion->idinscripcion->cellAttributes() ?>>
<span id="el_inscripcion_idinscripcion">
<span<?php echo $inscripcion->idinscripcion->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($inscripcion->idinscripcion->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="inscripcion" data-field="x_idinscripcion" name="x_idinscripcion" id="x_idinscripcion" value="<?php echo HtmlEncode($inscripcion->idinscripcion->CurrentValue) ?>">
<?php echo $inscripcion->idinscripcion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inscripcion->nombre->Visible) { // nombre ?>
	<div id="r_nombre" class="form-group row">
		<label id="elh_inscripcion_nombre" for="x_nombre" class="<?php echo $inscripcion_edit->LeftColumnClass ?>"><?php echo $inscripcion->nombre->caption() ?><?php echo ($inscripcion->nombre->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inscripcion_edit->RightColumnClass ?>"><div<?php echo $inscripcion->nombre->cellAttributes() ?>>
<span id="el_inscripcion_nombre">
<input type="text" data-table="inscripcion" data-field="x_nombre" name="x_nombre" id="x_nombre" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($inscripcion->nombre->getPlaceHolder()) ?>" value="<?php echo $inscripcion->nombre->EditValue ?>"<?php echo $inscripcion->nombre->editAttributes() ?>>
</span>
<?php echo $inscripcion->nombre->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inscripcion->institucion->Visible) { // institucion ?>
	<div id="r_institucion" class="form-group row">
		<label id="elh_inscripcion_institucion" for="x_institucion" class="<?php echo $inscripcion_edit->LeftColumnClass ?>"><?php echo $inscripcion->institucion->caption() ?><?php echo ($inscripcion->institucion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inscripcion_edit->RightColumnClass ?>"><div<?php echo $inscripcion->institucion->cellAttributes() ?>>
<span id="el_inscripcion_institucion">
<input type="text" data-table="inscripcion" data-field="x_institucion" name="x_institucion" id="x_institucion" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($inscripcion->institucion->getPlaceHolder()) ?>" value="<?php echo $inscripcion->institucion->EditValue ?>"<?php echo $inscripcion->institucion->editAttributes() ?>>
</span>
<?php echo $inscripcion->institucion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inscripcion->rfc->Visible) { // rfc ?>
	<div id="r_rfc" class="form-group row">
		<label id="elh_inscripcion_rfc" for="x_rfc" class="<?php echo $inscripcion_edit->LeftColumnClass ?>"><?php echo $inscripcion->rfc->caption() ?><?php echo ($inscripcion->rfc->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inscripcion_edit->RightColumnClass ?>"><div<?php echo $inscripcion->rfc->cellAttributes() ?>>
<span id="el_inscripcion_rfc">
<input type="text" data-table="inscripcion" data-field="x_rfc" name="x_rfc" id="x_rfc" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($inscripcion->rfc->getPlaceHolder()) ?>" value="<?php echo $inscripcion->rfc->EditValue ?>"<?php echo $inscripcion->rfc->editAttributes() ?>>
</span>
<?php echo $inscripcion->rfc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inscripcion->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_inscripcion__email" for="x__email" class="<?php echo $inscripcion_edit->LeftColumnClass ?>"><?php echo $inscripcion->_email->caption() ?><?php echo ($inscripcion->_email->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inscripcion_edit->RightColumnClass ?>"><div<?php echo $inscripcion->_email->cellAttributes() ?>>
<span id="el_inscripcion__email">
<input type="text" data-table="inscripcion" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($inscripcion->_email->getPlaceHolder()) ?>" value="<?php echo $inscripcion->_email->EditValue ?>"<?php echo $inscripcion->_email->editAttributes() ?>>
</span>
<?php echo $inscripcion->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$inscripcion_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $inscripcion_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $inscripcion_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$inscripcion_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$inscripcion_edit->terminate();
?>