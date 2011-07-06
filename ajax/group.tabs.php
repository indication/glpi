<?php
/*
 * @version $Id$
 -------------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2011 by the INDEPNET Development Team.

 http://indepnet.net/   http://glpi-project.org
 -------------------------------------------------------------------------

 LICENSE

 This file is part of GLPI.

 GLPI is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 GLPI is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with GLPI; if not, write to the Free Software Foundation, Inc.,
 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 --------------------------------------------------------------------------
 */

// ----------------------------------------------------------------------
// Original Author of file: Julien Dombre
// Purpose of file:
// ----------------------------------------------------------------------

define('GLPI_ROOT', '..');
include (GLPI_ROOT . "/inc/includes.php");

header("Content-Type: text/html; charset=UTF-8");
header_nocache();

if (!isset($_POST["id"])) {
   exit();
}

checkRight("group", "r");

$group = new Group();

if ($_POST["id"]>0 && $group->can($_POST["id"],'r')) {

   switch($_REQUEST['glpi_tab']) {
      case -1 :
         Group_User::showForGroup($_POST['target'], $group);
         $group->showItems(false);
         $group->showItems(true);
         $group->showLDAPForm($_POST['target'], $_POST["id"]);
         Plugin::displayAction($group, $_REQUEST['glpi_tab']);
         break;

      case 2 :
         $group->showItems(false);
         break;

      case 3 :
         $group->showItems(true);
         break;

      case 4 :
         $group->showLDAPForm($_POST['target'], $_POST["id"]);
         break;

      default :
         if (!CommonGLPI::displayStandardTab($group,$_REQUEST['glpi_tab'])) {
            Group_User::showForGroup($_POST['target'], $group);
         }
   }
}

ajaxFooter();

?>
