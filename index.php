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
/**
 * Run the code checker from the web.
 *
 * @package    local_autocomplete
 * @copyright  2019 Marcus Green
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
global $CFG, $PAGE;
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/formslib.php');
require_login();

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/autocomplete.php');

class local_autocomplete_form extends moodleform {
    protected function definition() {
        $mform = $this->_form;
        $multiple = optional_param('multiple',false,PARAM_BOOL);
        $data = ['1'=>'one','2'=>'two','3'=>'three'];          
        $options = [    
            'noselectionstring' => 'No selection'
            ]; 
        if($multiple){
            $options['multiple']=true;
        }           
        $mform->addElement('autocomplete', 'autosearch', 'Search', $data, $options);
        $mform->addElement('advcheckbox','multiple','multiple');
        $this->add_action_buttons(true,'Go');

    }
}
$mform = new local_autocomplete_form();
echo $OUTPUT->header();
$mform->display();
echo $OUTPUT->footer();