

function formatState(state) {
    if (!state.id) {
        return state.text;
    }
    const logo = $(state.element).data('image');
    var $state = $(
        `<div class='w-100'><img src="${BaseUrl}/assets/uploads/files/partner/${logo}" class='img-flag' width=50 height=30/>&nbsp; ${state.text} </div>`
    );
    return $state;
};
$(document).ready(function () {
    $(".partner-select2").select2({
        templateResult: formatState
    });
    $(".jurusan-select2").select2();
});


$(".js-range-slider").ionRangeSlider({
    type: "double",
    min: 0,
    max: 20000000,
    from: 5000000,
    to: 7000000,
    grid: true,
    skin: 'round',
    step: 100000,            // default 1 (set step)
    grid_num: 4,        // default 4 (set number of grid cells)
    grid_snap: false,    // default false (snap grid to step)
});

var picker = new Lightpick({
    field: document.getElementById('datepicker'),
    singleDate: false,
    numberOfColumns: 3,
    numberOfMonths: 6,
});

// The inline editor should be enabled on an element with "contenteditable" attribute set to "true".
// Otherwise CKEditor 4 will start in read-only mode.
var persyaratan = document.getElementById('persyaratan');
persyaratan.setAttribute('contenteditable', true);

CKEDITOR.inline('persyaratan', {
    // Allow some non-standard markup that we used in the introduction.
    extraAllowedContent: 'a(documentation);abbr[title];code',
    removePlugins: 'stylescombo',
    extraPlugins: 'sourcedialog',
    // Show toolbar on startup (optional).
    startupFocus: true
});

var description = document.getElementById('description');
description.setAttribute('contenteditable', true);
CKEDITOR.inline('description', {
    // Allow some non-standard markup that we used in the introduction.
    extraAllowedContent: 'a(documentation);abbr[title];code',
    removePlugins: 'stylescombo',
    extraPlugins: 'sourcedialog',
    // Show toolbar on startup (optional).
    startupFocus: true
});
