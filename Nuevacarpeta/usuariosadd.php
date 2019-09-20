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
$usuarios_add = new usuarios_add();

// Run the page
$usuarios_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuarios_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fusuariosadd = currentForm = new ew.Form("fusuariosadd", "add");

// Validate form
fusuariosadd.validate = function() {
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
		<?php if ($usuarios_add->nombrecompleto->Required) { ?>
			elm = this.getElements("x" + infix + "_nombrecompleto");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios->nombrecompleto->caption(), $usuarios->nombrecompleto->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($usuarios_add->correo->Required) { ?>
			elm = this.getElements("x" + infix + "_correo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios->correo->caption(), $usuarios->correo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($usuarios_add->contrasenia->Required) { ?>
			elm = this.getElements("x" + infix + "_contrasenia");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios->contrasenia->caption(), $usuarios->contrasenia->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($usuarios_add->userlevel_id->Required) { ?>
			elm = this.getElements("x" + infix + "_userlevel_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios->userlevel_id->caption(), $usuarios->userlevel_id->RequiredErrorMessage)) ?>");
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
fusuariosadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fusuariosadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fusuariosadd.lists["x_userlevel_id"] = <?php echo $usuarios_add->userlevel_id->Lookup->toClientList() ?>;
fusuariosadd.lists["x_userlevel_id"].options = <?php echo JsonEncode($usuarios_add->userlevel_id->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $usuarios_add->showPageHeader(); ?>
<?php
$usuarios_add->showMessage();
?>
<form name="fusuariosadd" id="fusuariosadd" class="<?php echo $usuarios_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($usuarios_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $usuarios_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuarios">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$usuarios_add->IsModal ?>">
<!-- Fields to prevent google autofill -->
<input class="d-none" type="text" name="<?php echo Encrypt(Random()) ?>">
<input class="d-none" type="password" name="<?php echo Encrypt(Random()) ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($usuarios->nombrecompleto->Visible) { // nombrecompleto ?>
	<div id="r_nombrecompleto" class="form-group row">
		<label id="elh_usuarios_nombrecompleto" for="x_nombrecompleto" class="<?php echo $usuarios_add->LeftColumnClass ?>"><?php echo $usuarios->nombrecompleto->caption() ?><?php echo ($usuarios->nombrecompleto->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_add->RightColumnClass ?>"><div<?php echo $usuarios->nombrecompleto->cellAttributes() ?>>
<span id="el_usuarios_nombrecompleto">
<input type="text" data-table="usuarios" data-field="x_nombrecompleto" name="x_nombrecompleto" id="x_nombrecompleto" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($usuarios->nombrecompleto->getPlaceHolder()) ?>" value="<?php echo $usuarios->nombrecompleto->EditValue ?>"<?php echo $usuarios->nombrecompleto->editAttributes() ?>>
</span>
<?php echo $usuarios->nombrecompleto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios->correo->Visible) { // correo ?>
	<div id="r_correo" class="form-group row">
		<label id="elh_usuarios_correo" for="x_correo" class="<?php echo $usuarios_add->LeftColumnClass ?>"><?php echo $usuarios->correo->caption() ?><?php echo ($usuarios->correo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_add->RightColumnClass ?>"><div<?php echo $usuarios->correo->cellAttributes() ?>>
<span id="el_usuarios_correo">
<input type="text" data-table="usuarios" data-field="x_correo" name="x_correo" id="x_correo" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($usuarios->correo->getPlaceHolder()) ?>" value="<?php echo $usuarios->correo->EditValue ?>"<?php echo $usuarios->correo->editAttributes() ?>>
</span>
<?php echo $usuarios->correo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios->contrasenia->Visible) { // contrasenia ?>
	<div id="r_contrasenia" class="form-group row">
		<label id="elh_usuarios_contrasenia" for="x_contrasenia" class="<?php echo $usuarios_add->LeftColumnClass ?>"><?php echo $usuarios->contrasenia->caption() ?><?php echo ($usuarios->contrasenia->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_add->RightColumnClass ?>"><div<?php echo $usuarios->contrasenia->cellAttributes() ?>>
<span id="el_usuarios_contrasenia">
<input type="text" data-table="usuarios" data-field="x_contrasenia" name="x_contrasenia" id="x_contrasenia" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($usuarios->contrasenia->getPlaceHolder()) ?>" value="<?php echo $usuarios->contrasenia->EditValue ?>"<?php echo $usuarios->contrasenia->editAttributes() ?>>
</span>
<?php echo $usuarios->contrasenia->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios->userlevel_id->Visible) { // userlevel_id ?>
	<div id="r_userlevel_id" class="form-group row">
		<label id="elh_usuarios_userlevel_id" for="x_userlevel_id" class="<?php echo $usuarios_add->LeftColumnClass ?>"><?php echo $usuarios->userlevel_id->caption() ?><?php echo ($usuarios->userlevel_id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_add->RightColumnClass ?>"><div<?php echo $usuarios->userlevel_id->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_usuarios_userlevel_id">
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($usuarios->userlevel_id->EditValue) ?>">
</span>
<?php } else { ?>
<span id="el_usuarios_userlevel_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="usuarios" data-field="x_userlevel_id" data-value-separator="<?php echo $usuarios->userlevel_id->displayValueSeparatorAttribute() ?>" id="x_userlevel_id" name="x_userlevel_id"<?php echo $usuarios->userlevel_id->editAttributes() ?>>
		<?php echo $usuarios->userlevel_id->selectOptionListHtml("x_userlevel_id") ?>
	</select>
</div>
<?php echo $usuarios->userlevel_id->Lookup->getParamTag("p_x_userlevel_id") ?>
</span>
<?php } ?>
<?php echo $usuarios->userlevel_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$usuarios_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $usuarios_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $usuarios_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$usuarios_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$usuarios_add->terminate();
?>