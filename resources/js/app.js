import './bootstrap';

import './menu.js';
import './load.js';
import './scroll-to-top.js';

import * as isvek from "bvi"

new isvek.Bvi()

import './accordion-script.js';
import './classie.js';
import './counter-script.js';
import './public-faculties.js';
// import './search-in-box.js';
import './uisearch.js';

import './aware-button-animaton.js';
import './btn-info-prog.js';
// import './custom-select-navigation.js';
import './filter-card.js';
import './more-prog-btn.js';
import './slider-bg.js';

import './modal-on-main-page.js'

import * as SearchSelect from './select-component.js';
window.SearchSelect = SearchSelect;
import * as Tabs from './admin/tabs.js';
window.Tabs = Tabs;

import './search/departments.js';

import * as Service from './service/fetch.js';
window.Service = Service;

import * as PublicAction from './public/actions.js';
window.PublicAction = PublicAction;

import {Accordion} from './public/accordion.js';
window.Accordion = Accordion;

import * as Filters from './public/filters.js';
window.Filters = Filters;

import * as Scrolls from './service/scrolls.js';
window.Scrolls = Scrolls;

import {specialitiesFilter} from './public/specialitiesFilter.js';
window.specialitiesFilter = specialitiesFilter;

import './public/regiments.js';
