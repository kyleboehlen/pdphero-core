<?php

namespace App\View\Components\Settings;

use Illuminate\View\Component;

class OptionsSetting extends Component
{
    // Holds the ID of the corresponding setting
    public $settings_id;

    // The text to be displayed before the select input
    public $text_part_one;

    // The text to be displayed after the select input
    public $text_part_two;

    // The select options
    public $options;

    // The user's current selected option
    public $selected_option_key;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $text)
    {
        $this->settings_id = $id;

        // Split text
        $text_array = explode('|', $text);
        $this->text_part_one = $text_array[0];
        $this->text_part_two = $text_array[1];

        // Set options
        $this->options = config('settings.options')[$this->settings_id];

        // Get user and determine the current setting
        $user = \Auth::user();
        $this->selected_option_key = $user->getSettingValue($this->settings_id);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.settings.options-setting');
    }
}
