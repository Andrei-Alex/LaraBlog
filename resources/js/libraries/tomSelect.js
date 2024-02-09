import TomSelect from 'tom-select';
document.addEventListener('DOMContentLoaded', function() {
    new TomSelect("select[multiple]",{
        plugins: {remove_button: {title: 'Delete'}}
    });
});
