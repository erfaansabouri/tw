var CIPSelect2 = function() {
    var innerSelect2 = function() {
        $('.simple-select-2').select2({
            placeholder: 'انتخاب کنید',
            allowClear: true,
            width: '100%',
        });


    }
    return {
        init: function() {
            innerSelect2();
        }
    };
}();

var CIPSwitch = function() {
    var demos = function() {
        $('[data-switch=true]').bootstrapSwitch();
    };
    return {
        init: function() {
            demos();
        },
    };
}();


jQuery(document).ready(function() {
    CIPSelect2.init();
    CIPSwitch.init();
    jalaliDatepicker.startWatch({
        minDate: 'today',
    });
});


