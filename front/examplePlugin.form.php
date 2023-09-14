<?php

/**
 * ---------------------------------------------------------------------
 * ITSM-NG
 * Copyright (C) 2022 ITSM-NG and contributors.
 *
 * https://www.itsm-ng.org
 *
 * ---------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of ITSM-NG.
 *
 * ITSM-NG is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * ITSM-NG is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ITSM-NG. If not, see <http://www.gnu.org/licenses/>.
 * ---------------------------------------------------------------------
 */

include_once('../../../inc/includes.php');

Html::header(__("Example Plugin", "exampleplugin"), $_SERVER['PHP_SELF'], 'admin', PluginExamplepluginConfig::class);
?>
<div class="center">
  <h1>Welcome to my cool plugin ! it was interacted with <? echo 1 ?> time<? echo 1 > 1 ? 's' : '' ?> !</h1>
    <form>
    <label for="addOne">Add </label>
    <button name="addOne" type="submit">+1</button>
    <input type="hidden" name="add" value="1"></input>
    <input type="hidden" name="_glpi_csrf_token" value="<?php Session::getNewCSRFToken() ?>"></input>
  </form>
</div>

<?php Html::footer() ?>
