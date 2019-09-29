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
$register = new register();

// Run the page
$register->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$register->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "register";
var fregister = currentForm = new ew.Form("fregister", "register");

// Validate form
fregister.validate = function() {
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
		<?php if ($register->nombrecompleto->Required) { ?>
			elm = this.getElements("x" + infix + "_nombrecompleto");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, ew.language.phrase("EnterUserName"));
		<?php } ?>
		<?php if ($register->correo->Required) { ?>
			elm = this.getElements("x" + infix + "_correo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios->correo->caption(), $usuarios->correo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($register->contrasenia->Required) { ?>
			elm = this.getElements("x" + infix + "_contrasenia");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, ew.language.phrase("EnterPassword"));
		<?php } ?>
			if (fobj.c_contrasenia.value != fobj.x_contrasenia.value)
				return this.onError(fobj.c_contrasenia, ew.language.phrase("MismatchPassword"));

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fregister.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fregister.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $register->showPageHeader(); ?>
<?php
$register->showMessage();
?>
<form name="fregister" id="fregister" class="<?php echo $register->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($register->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $register->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuarios">
<input type="hidden" name="action" id="action" value="insert">
<!-- Fields to prevent google autofill -->
<input type="hidden" type="text" name="<?php echo Encrypt(Random()) ?>">
<input type="hidden" type="password" name="<?php echo Encrypt(Random()) ?>">
<?php if ($usuarios->isConfirm()) { // Confirm page ?>
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } ?>
<div class="ew-register-div"><!-- page* -->
<?php if ($usuarios->nombrecompleto->Visible) { // nombrecompleto ?>
	<div id="r_nombrecompleto" class="form-group row">
		<label id="elh_usuarios_nombrecompleto" for="x_nombrecompleto" class="<?php echo $register->LeftColumnClass ?>"><?php echo $usuarios->nombrecompleto->caption() ?><?php echo ($usuarios->nombrecompleto->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuarios->nombrecompleto->cellAttributes() ?>>
<?php if (!$usuarios->isConfirm()) { ?>
<span id="el_usuarios_nombrecompleto">
<input type="text" data-table="usuarios" data-field="x_nombrecompleto" name="x_nombrecompleto" id="x_nombrecompleto" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($usuarios->nombrecompleto->getPlaceHolder()) ?>" value="<?php echo $usuarios->nombrecompleto->EditValue ?>"<?php echo $usuarios->nombrecompleto->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuarios_nombrecompleto">
<span<?php echo $usuarios->nombrecompleto->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($usuarios->nombrecompleto->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="usuarios" data-field="x_nombrecompleto" name="x_nombrecompleto" id="x_nombrecompleto" value="<?php echo HtmlEncode($usuarios->nombrecompleto->FormValue) ?>">
<?php } ?>
<?php echo $usuarios->nombrecompleto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios->correo->Visible) { // correo ?>
	<div id="r_correo" class="form-group row">
		<label id="elh_usuarios_correo" for="x_correo" class="<?php echo $register->LeftColumnClass ?>"><?php echo $usuarios->correo->caption() ?><?php echo ($usuarios->correo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuarios->correo->cellAttributes() ?>>
<?php if (!$usuarios->isConfirm()) { ?>
<span id="el_usuarios_correo">
<input type="text" data-table="usuarios" data-field="x_correo" name="x_correo" id="x_correo" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($usuarios->correo->getPlaceHolder()) ?>" value="<?php echo $usuarios->correo->EditValue ?>"<?php echo $usuarios->correo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuarios_correo">
<span<?php echo $usuarios->correo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($usuarios->correo->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="usuarios" data-field="x_correo" name="x_correo" id="x_correo" value="<?php echo HtmlEncode($usuarios->correo->FormValue) ?>">
<?php } ?>
<?php echo $usuarios->correo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios->contrasenia->Visible) { // contrasenia ?>
	<div id="r_contrasenia" class="form-group row">
		<label id="elh_usuarios_contrasenia" for="x_contrasenia" class="<?php echo $register->LeftColumnClass ?>"><?php echo $usuarios->contrasenia->caption() ?><?php echo ($usuarios->contrasenia->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuarios->contrasenia->cellAttributes() ?>>
<?php if (!$usuarios->isConfirm()) { ?>
<span id="el_usuarios_contrasenia">
<input type="text" data-table="usuarios" data-field="x_contrasenia" name="x_contrasenia" id="x_contrasenia" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($usuarios->contrasenia->getPlaceHolder()) ?>" value="<?php echo $usuarios->contrasenia->EditValue ?>"<?php echo $usuarios->contrasenia->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuarios_contrasenia">
<span<?php echo $usuarios->contrasenia->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($usuarios->contrasenia->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="usuarios" data-field="x_contrasenia" name="x_contrasenia" id="x_contrasenia" value="<?php echo HtmlEncode($usuarios->contrasenia->FormValue) ?>">
<?php } ?>
<?php echo $usuarios->contrasenia->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios->contrasenia->Visible) { // contrasenia ?>
	<div id="r_c_contrasenia" class="form-group row">
		<label id="elh_c_usuarios_contrasenia" for="c_contrasenia" class="<?php echo $register->LeftColumnClass ?>"><?php echo $Language->phrase("Confirm") ?> <?php echo $usuarios->contrasenia->caption() ?><?php echo ($usuarios->contrasenia->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuarios->contrasenia->cellAttributes() ?>>
<?php if (!$usuarios->isConfirm()) { ?>
<span id="el_c_usuarios_contrasenia">
<input type="text" data-table="usuarios" data-field="c_contrasenia" name="c_contrasenia" id="c_contrasenia" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($usuarios->contrasenia->getPlaceHolder()) ?>" value="<?php echo $usuarios->contrasenia->EditValue ?>"<?php echo $usuarios->contrasenia->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_c_usuarios_contrasenia">
<span<?php echo $usuarios->contrasenia->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($usuarios->contrasenia->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="usuarios" data-field="c_contrasenia" name="c_contrasenia" id="c_contrasenia" value="<?php echo HtmlEncode($usuarios->contrasenia->FormValue) ?>">
<?php } ?>
</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $register->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$usuarios->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("RegisterBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
</form>
<?php
$register->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$register->terminate();
?>