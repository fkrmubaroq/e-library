$('#StoreLogin').submit(function (evt) {
    evt.preventDefault();

    const data = new FormData(this);
    data.append(GetTokenCsrfName(), GetTokenCsrfValue());

    $.ajax({
        url: `${BaseUrl}/login/store`,
        type: 'POST',
        processData: false,
        contentType: false,
        data: data,
        dataType: 'json',
        beforeSend: function () {
            EnableLoadingButton('login')
        }
    }).done(function (response) {
        console.log(response.status_code);
        ResetTokenCsrf(response.token)

        if (response.status_code == 200) {
            document.location = response.action;
            return true;
        }

        // kalo error
        $('#error-message').text(response.message);

        DisableLoadingButton('login', 'Masuk')
    })
})