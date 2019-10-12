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
 *
 * @package    local_autocomplete
 * @copyright  2019 Marcus Green
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
global $CFG, $PAGE;
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/formslib.php');

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/autocomplete.php');

class local_autocomplete_form extends moodleform {
    protected function definition() {
        $mform = $this->_form;
        $options = [];
        $options['multiple'] = optional_param('multiple',false,PARAM_BOOL);
        $options['tags'] = optional_param('tags',false,PARAM_BOOL);
        $options['placeholder'] = optional_param('placeholder','',PARAM_TEXT);
        $options['casesensitive'] = optional_param('casesensitive','',PARAM_TEXT);
        $options['noselectionstring'] = optional_param('noselectionstring','',PARAM_TEXT);
        $options['showsuggestions'] = optional_param('showsuggestions',true,PARAM_BOOL);
        $opts = 'options = '.var_export($options,true);

        $options['searchableselector'] = optional_param('searchableselector','',PARAM_BOOL);
        $data = ['1'=>'alpha','2'=>'bravo','3'=>'charlie','4'=>'delta','5'=>'zebra'];          
        $text = '
        <h3>Contact Moodle Partners Titus Learning at <a href=http://www.tituslearning.com>www.tituslearning.com</a> for consultancy and development</h3>
        This illustrates how the Moodle autocomplete form element can be used. The sample data is
        alpha,bravo,charlie etc. The source can be found here 
        <a href= https://github.com/marcusgreen/moodle-local_autocomplete2>https://github.com/marcusgreen/moodle-local_autocomplete2</a>
        The documentation for the autocomplete element can be found at 
        <a href=https://docs.moodle.org/dev/lib/formslib.php_Form_Definition#autocomplete>https://docs.moodle.org/dev/lib/formslib.php_Form_Definition#autocomplete</a>';
        $mform->addElement('html',$text);
        if ($options['searchableselector']) {
            $mform->addElement('searchableselector', 'autosearch', 'Search', $data, $options);
        } else {
            $mform->addElement('autocomplete', 'autosearch', 'Search', $data, $options);
        }
        $mform->addElement('html', $opts);
        $mform->addElement('advcheckbox','multiple','multiple');
        $mform->addHelpButton('multiple','multiple','local_autocomplete2');
        $mform->addElement('advcheckbox','tags','tags');
        $mform->addHelpButton('tags','tags','local_autocomplete2');
        $mform->addElement('advcheckbox','casesensitive','casesensitive');
        $mform->addHelpButton('casesensitive','casesensitive','local_autocomplete2');
        $mform->addElement('advcheckbox','showsuggestions','showsuggestions');
        $mform->addHelpButton('showsuggestions','showsuggestions','local_autocomplete2');
        $mform->setDefault('showsuggestions',true);
        $mform->addElement('advcheckbox','searchableselector','searchableselector');

        $mform->addElement('text','placeholder','placeholder');
        $mform->setType('placeholder',PARAM_TEXT);
        $mform->addElement('text','noselectionstring','noselectionstring');
        $mform->setType('noselectionstring',PARAM_TEXT);

        $this->add_action_buttons(true,'Go');
        $mform->addElement('html','Press the Go button to reset the configurations');


    }
}
$mform = new local_autocomplete_form();
echo $OUTPUT->header();
$mform->display();
echo $OUTPUT->footer();