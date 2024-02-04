
const app = (window.location.pathname).split('/')[1];
const BaseUrl = window.location.origin + '/' + app + '/admin';

function ResetTokenCsrf(NewToken) {
    if (NewToken == null || NewToken == '') return false;
    $('#csrf').attr('content', NewToken);
}

function GetTokenCsrfValue() {
    return $('#csrf').attr('content');
}
function GetTokenCsrfName() {
    return $('#csrf').attr('name');;
}

function EnableLoadingButton(name) {
    $(`button[name=${name}]`).html(`<img src='${BaseUrl}/assets/img/etc/loading.svg' height='25'>`);
    $(`button[name=${name}]`).attr('disabled', 'true');
}

function DisableLoadingButton(name, value) {
    $(`button[name=${name}]`).html(value);
    $(`button[name=${name}]`).removeAttr('disabled');
}

function ObjectLength(object) {
    return Object.keys(object).length;
}
function Base64UrlToSvg(base64) {
    // split[0] => tipe gambar
    // split[1] => base64
    const base64Encode = base64.split(',');
    const ContentSvg = atob(base64Encode[1]);

    return ContentSvg;
}
function Rupiah(number) {
    var reverse = number.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join('.').split('').reverse().join('');
    return ribuan
}

function SuccessMessage(title, text, icon = 'success') {
    swal({
        title: title,
        text: text.replace("'", ""),
        icon: icon,
        buttons: {
            confirm: {
                text: "OKE",
                className: "btn btn-primary",
                closeModal: true
            }
        }
    });
}

function WarningMessage(title, text, icon = 'warning') {
    swal(title, text.replace("'", ""), {
        icon: icon,
        buttons: {
            confirm: {
                className: 'btn btn-warning '
            }
        },
    });
}

function ErrorMessage(title, text, icon = 'error') {
    swal(title, text, {
        icon: "error",
        buttons: {
            confirm: {
                text: 'Saya mengerti',
                className: 'btn btn-danger'
            }
        },
    });
}
function ConfirmMessage(title, text, confirmText = 'Ya, saya yakin') {
    return swal({
        title: title,
        text: text ?? '',
        type: 'warning',
        buttons: {
            confirm: {
                text: confirmText,
                className: 'btn btn-primary'
            },
            cancel: {
                visible: true,
                text: 'Kembali',
                className: 'btn btn-light'
            }
        }
    })
}

function ObjToGet(obj) {
    let tampung = '?';
    if (obj != null) {
        Object.keys(obj).forEach(function (key) {
            if (obj[key] != '')
                tampung += `${key}=${obj[key]}&`;
        });
    }
    return tampung;
}

function ReloadTable(url = '') {
    if (typeof table.ajax === 'undefined')
        table.api().ajax.url(url).load();
    else
        table.ajax.url(url).load();


}
function isEmptySelector(el) {
    return !$.trim(el.html())
}

function FieldRequired(label = ` <img class='text-danger text-size--1 fweight-600'>*) Wajib diisi</img>`) {
    const field = $('label.field-required');

    for (let x = 0; x < field.length; x++) {
        field.eq(x).append(label);
    }
}

function FormatErrorMessage(jqXHR, exception,) {
    let message;
    if (jqXHR.status === 0) {
        message = ('silahkan periksa koneksi internet anda');
    } else if (jqXHR.status == 404) {
        message = ('Sedang terjadi masalah, silahkan coba beberapa saat lagi. (NOT FOUND)');
    } else if (jqXHR.status == 500) {
        message = ('Server kami sedang sibuk, silahkan coba beberapa saat lagi. (INTERNAL SERVER ERROR)');
    } else if (exception === 'parsererror') {
        message = ('Data tidak terkirim, silahkan muat ulang halaman ini');
    } else if (exception === 'timeout') {
        message = ('Time out error.');
    } else if (exception === 'abort') {
        message = ('Permintaan dibatalkan. (ABORTED)');
    } else {
        message = ('Sedang terjadi masalah, silahkan coba beberapa saat lagi.\n' + jqXHR.responseText);
    }
    ErrorMessage('Mohon maaf', message);

}

function LoadingOn() {
    $('body').append(`
    <div id='loading-page' class="bg-dark position-absolute" style="z-index:9999999999999999; opacity:0.5; position:absolute; width:100%; height:100vh; top:0;">
        <div class=" position-absolute" style=" top: 50%; left: 50%; transform: translate(-50%, -50%);">
           <img src="${BaseUrl}/assets/img/etc/loading.svg">
        </div>
    </div>`);
}

function LoadingInner() {
    return `
    <div class='w-100 h-100 text-center'>
        <img src="${BaseUrl}/assets/img/etc/loading.svg" width='100'>
    </div>`;
}

function ErrorInner() {
    return `
    <div class="row margin-top-3">
        <div class="col text-center d-flex flex-column text-muted">
            <h1 class='fweight-600'>UPPPSSS.</h1>
            <span class="material-icons-outlined " style="font-size:100px; opacity:0.7">
                sentiment_dissatisfied
            </span>
            <div class='text-muted text-size-4 mt-2'>
                Sedang terjadi masalah<br/>silahkan coba beberapa saat lagi
            </div>
        </div>
    </div>
    `;
}

function LoadingOff() {
    $('#loading-page').remove();
}
function EmptyValue() {
    $('input').val('');
    $('select').val('');
}

function DataApi(name) {
    return `<API>${name}</API>`;
}



function CloseSidenav() {
    $(".sidenav").css({
        'width': '0px',
        'visibility': 'hidden'
    });
    // $('.page-inner').css('padding-right', '2rem');
}

$(document).delegate('#CloseSidenav', 'click', function (evt) {
    CloseSidenav();
})

// format select2
function FormatState(state) {
    if (!state.id)
        return state.text;

    var $state = $(
        `<span><img src="${BaseUrl}/assets/img/logo_sm.png" class="img-flag" />${state.text}</span>`
    );

    return $state;
};

function FormatStateSelection(state) {
    if (!state.id)
        return state.text;

    var $state = $(
        '<span><img class="img-flag" /> <span></span></span>'
    );
    // Use .text() instead of HTML string concatenation to avoid script injection issues
    $state.find("span").addClass(['text-size-1', 'fweight-600']);
    $state.find("span").text(state.text);
    $state.find("img").attr("src", `${BaseUrl}/assets/img/logo_sm.png`);
    $state.find("img").attr("style", "width:25px; height:25px");
    $state.find("img").addClass("my-1");

    return $state;
}

Array.prototype.remove = function () {
    var what, a = arguments, L = a.length, ax;
    while (L && this.length) {
        what = a[--L];
        while ((ax = this.indexOf(what)) !== -1) {
            this.splice(ax, 1);
        }
    }
    return this;
};

function Select2Request(element, url, placeholder = '', fixed = false) {
    if (typeof $(`${element}`).select2 == "undefined") return false;

    return $(`${element}`).select2({
        dropdownCssClass: fixed == true ? 'increasezindex' : '',
        templateResult: FormatState,
        templateSelection: FormatStateSelection,
        placeholder: placeholder,
        ajax: {
            url: `${url}`,
            dataType: 'json',
            data: function (params) {
                var query = {
                    search: params.term,
                    page: params.page || 1
                }
                // Query parameters will be ?search=[term]&type=public
                return query;
            },

            // hasil dari request 
            processResults: function (data, params) {
                params.page = params.page || 1;

                return {
                    results: data.results,
                    pagination: {
                        more: (params.page * 10) < data.count_filtered
                    }
                };
            }
        }
    });
}

function CleanArray(arr) {
    return arr.filter(function (item, index) {
        if (item != '' || item != null)
            return true;

        return false;

    });
}
function IsMobile() {
    let check = false;
    (function (a) { if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = true; })(navigator.userAgent || navigator.vendor || window.opera);
    return check;
}
// kalo buat seurat keluar ada

$('.pilihan-keluar').on('click', function (evt) {
    PilihSurat('pilihan-keluar', this)
})

$('.pilihan-keluar-eksternal').on('click', function (evt) {
    PilihSurat('pilihan-keluar-eksternal', this);

    $('#GunakanSurat').attr('disabled', 'disabled')

    if ($(`.pilihan-keluar-eksternal`).hasClass('active'))
        $('#GunakanSurat').removeAttr('disabled')

})

function PilihSurat(element, that) {
    $(`.${element}-checked`).remove();
    $(`.${element}`).removeClass('active');

    $(that).addClass('active');

    if ($(`.${element}`).hasClass('active')) {
        $(that).children().after(`
            <div class="${element}-checked position-absolute" style="top:20px; right:35px">
                <span class=" material-icons text-success">
                    check_circle
                </span>
            </div>`);
    }
}

$('#LanjutPilihan').on('click', function (evt) {
    // ambil data choose
    const TipeSurat = $('.pilihan-keluar.active').attr('data-choose');

    if (TipeSurat == 'eksternal') {
        $('#BuatSuratKeluar').modal('hide');
        $('#ModalEksternal').modal('show');
    }
    else if (TipeSurat == 'internal')
        $('#ModalInternal').modal('show')
});

$('#GunakanSurat').on('click', function (evt) {
    // ambil data choose
    const TipeSurat = $('.pilihan-keluar.active').attr('data-choose');
    // ambil data choose
    const JenisSurat = $('.pilihan-keluar-eksternal.active').attr('data-choose');

    // kalo takah
    if (TipeSurat == 'eksternal') {
        if (JenisSurat == 'takah')
            document.location = `${BaseUrl}/surat/keluar/add/takah`;
        else if (JenisSurat == 'non-takah')
            document.location = `${BaseUrl}/surat/keluar/add/non-takah`;

    }
})

$('.BackSuratKeluar').on('click', function (evt) {
    $('#ModalEksternal').modal('hide');
    $('#ModalInternal').modal('hide')
    $('#BuatSuratKeluar').modal('show')
})

function DrawTable(props) {

    // kolom tabel 
    let columns = [props.columns];

    // kalo ada tambahan kolom
    if (typeof props.addColumn != 'undefined')
        columns.push(props.addColumn);

    // untuk callback default
    let DrawCallBack = function (settings) {
        var api = this.api();
        var $table = $(api.table().node());

        if ($table.hasClass('cards')) {
            var labels = [];
            $('thead th', $table).each(function () {
                const RemoveLabel = [''];
                const value = $(this).text();
                if (RemoveLabel.indexOf(value) != -1)
                    labels.push(value);

            });

            // Add data-label attribute to each cell
            $('tbody tr', $table).each(function () {
                $(this).find('td').each(function (column) {
                    $(this).attr('data-label', labels[column]);
                });
            });

            var max = 0;
            $('tbody tr', $table).each(function () {
                max = Math.max($(this).height(), max);
            }).height(max);

        } else {
            // Remove data-label attribute from each cell
            $('tbody td', $table).each(function () {
                $(this).removeAttr('data-label');
            });

            $('tbody tr', $table).each(function () {
                $(this).height('auto');
            });
        }
    };

    $(`#${props.element}`).DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength": 50,
        "pagingType": "simple",
        "language": {
            "search": "",
            "info": "_START_ - _END_ of _TOTAL_ entries",
            "infoFiltered": "",
            "paginate": {
                "previous": `<span class="material-icons-outlined">keyboard_arrow_left</span>`,
                "next": `<span class="material-icons-outlined">keyboard_arrow_right</span>`
            }
        },

        "ajax": {
            "url": props.url + ObjToGet(props.param),
        },
        "fnServerParams": function (aoData) {
            const limit = aoData.length;
            const offset = aoData.start;
            if (offset <= 0)
                aoData.page = 1;
            else
                aoData.page = offset / limit + 1;


        },
        "createdRow": function (row, data, dataIndex) {
            $(row).addClass(['thumb', 'my-2', 'ml-0']);
            $(row).attr('data-id', data['id']);

            $(row).addClass('bg-white');

            if (typeof props.classRow != 'undefined')
                $(row).addClass(props.classRow)
            // lebar    card untuk mobile dan browser
            if (IsMobile())
                $(row).css('width', '100%')
            else
                $(row).css({ 'min-width': `${props.width_items ?? '32%'}`, 'margin-right': '20px' })

        },

        // posisi fitur datatable
        "dom": props.dom ?? `<'d-flex justify-content-between'<'#table_search_${props.element}'f><'#fitur.text-size-2'>><t><'d-flex justify-content-between'ip>`,
        'drawCallback': props.DrawCallBack ?? DrawCallBack,
        "columns": columns,

    });
    $(`#table_search_${props.element} input`).attr({
        'placeholder': 'Cari',
        'style': 'height:34px; margin-left:0px',
    })

    if (typeof props.fitur != 'undefined')
        // fitur data
        $('#fitur').html(props.fitur);

    $('.dataTables_wrapper').removeClass('container-fluid');
}