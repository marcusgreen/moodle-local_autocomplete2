<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


defined('MOODLE_INTERNAL') || die;


require_once("$CFG->libdir/externallib.php");
require_once("lib.php");

class local_autocomplete_external extends external_api {
    public static function search_user_parameters() {
        return new external_function_parameters(
			array(
				'search' => new external_value(PARAM_NOTAGS, 'search', VALUE_DEFAULT, 0)
			)
        );
    }


    public static function search_users($search) {
        global $DB;
        $records = $DB->get_records_sql("SELECT id,name FROM {user} WHERE username like  :username ".
            " ORDER BY name asc ", ['value' => $search . '%']);
        $users = [];
        foreach ($records as $user) {
            $users['id'] = $user->id;
            $users['name'] = $user->username;
        }
        return $users;
    }

  
    public static function search_users_returns() {
        return new external_multiple_structure(
			new external_single_structure(
				array(
					'id' => new external_value(PARAM_INT, 'id'),
					'name' => new external_value(PARAM_NOTAGS, 'Company')
				)
			)
        );
    }
    public static function search_contractors_returns() {
        return new external_multiple_structure(
			new external_single_structure(
				array(
					'id' => new external_value(PARAM_INT, 'Contractor ID'),
					'name' => new external_value(PARAM_NOTAGS, 'Company')
				)
			)
        );
	}
}