<?php
namespace PHPMaker2019\project5;

// Menu Language
if ($Language && $Language->LanguageFolder == $LANGUAGE_FOLDER)
	$MenuLanguage = &$Language;
else
	$MenuLanguage = new Language();

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(1, "mi_usuarios", $MenuLanguage->MenuPhrase("1", "MenuText"), "usuarioslist.php", -1, "", AllowListMenu('{7D17B05A-1E09-4241-BCB8-DFDB2802E5B9}usuarios'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(2, "mi_inscripcion", $MenuLanguage->MenuPhrase("2", "MenuText"), "inscripcionlist.php", -1, "", AllowListMenu('{7D17B05A-1E09-4241-BCB8-DFDB2802E5B9}inscripcion'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(3, "mi_userlevelpermissions", $MenuLanguage->MenuPhrase("3", "MenuText"), "userlevelpermissionslist.php", -1, "", AllowListMenu('{7D17B05A-1E09-4241-BCB8-DFDB2802E5B9}userlevelpermissions'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(4, "mi_userlevels", $MenuLanguage->MenuPhrase("4", "MenuText"), "userlevelslist.php", -1, "", AllowListMenu('{7D17B05A-1E09-4241-BCB8-DFDB2802E5B9}userlevels'), FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>