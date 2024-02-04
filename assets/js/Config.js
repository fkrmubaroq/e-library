
const BaseUrl = window.location.origin;

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
    $(`button[name=${name}]`).html(`<img src='${BaseUrl}/assets/img/loading.svg' width='25' height='25'>`);
    $(`button[name=${name}]`).attr('disabled', 'true');
}

function DisableLoadingButton(name, value) {
    $(`button[name=${name}]`).html(value);
    $(`button[name=${name}]`).removeAttr('disabled');
}

function ObjectLength(object) {
    return Object.keys(object).length;
}

function Message(text, action = 'OKE') {
    Snackbar.show({ text: text.replace("/\'/", ""), actionText: action, pos: 'top-center' });
}