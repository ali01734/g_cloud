import sidebar from './ui/sidebar';
import ajaxify from './ui/ajaxify';
import highlight from './ui/highlight';
import $ from 'jquery';

window.$ = window.jQuery = $;

import {Foundation} from  'foundation-sites/js/foundation.core';
import {OffCanvas} from 'foundation-sites/js/foundation.offcanvas';
import {Reveal} from 'foundation-sites/js/foundation.reveal';
import {DropdownMenu} from 'foundation-sites/js/foundation.dropdownMenu';
import {Dropdown} from 'foundation-sites/js/foundation.dropdown';
import {Equalizer} from 'foundation-sites/js/foundation.equalizer';


Foundation.plugin(OffCanvas, 'OffCanvas');
Foundation.plugin(Reveal, 'Reveal');
Foundation.plugin(DropdownMenu, 'DropdownMenu');
Foundation.plugin(Dropdown, 'Dropdown');
Foundation.plugin(Equalizer, 'Equalizer');
Foundation.addToJquery($);

$(() => {
    $(document).foundation();
});

sidebar();
ajaxify();
highlight();

