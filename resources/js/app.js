import './bootstrap';
import '@fortawesome/fontawesome-free/js/all.js';


import TomSelect from 'tom-select';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', function() {
    new TomSelect("select[multiple]",{
        plugins: {remove_button: {title: 'Delete'}}
    });
});



