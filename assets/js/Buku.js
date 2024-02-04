const rate = parseFloat($('#rate').text()) / 2;
$(".rate-book").rateYo({
    starWidth: "30px",
    readOnly: true,
    rating: rate
});

var rating = 0;

$(".rating-book").rateYo({
    starWidth: "30px",
    halfStar: true,
    rating: (rating / 2).toFixed(1),
    onSet: function (rating, rateYoInstance) {
        rating = rating * 2;
        if (rating > 0) {

            $('#BeriRating').css({
                'background': '#343a40',
                'color': 'white'
            })
            const id = $('#IdBuku').data('id');
            const data = {
                rating: rating,
                [GetTokenCsrfName()]: GetTokenCsrfValue()
            };

            $.ajax({
                url: `${BaseUrl}/buku/rating/${id}`,
                data: data,
                type: 'POST',
                dataType: 'json',
            }).done(function (response) {
                ResetTokenCsrf(response.token)
            })
        }
    }
});


$('.lama-pinjam').on('click', function (evt) {
    $('.lama-pinjam').removeAttr('style');
    $('.lama-pinjam').removeClass('active');

    $(this).attr('style', "background:#ffc107 !important; color:white")
    $(this).addClass('active');
})

$('#PinjamBuku').click(function (evt) {
    evt.preventDefault();
    const slug = $(this).data('slug');
    const waktuPinjam = $('.lama-pinjam.active').eq(0).data('value');
    if (waktuPinjam == undefined) {
        alert("Pilih lama pinjam");
        return false;
    }
    document.location = `${BaseUrl}/buku/${slug}/pinjam?waktu_pinjam=${waktuPinjam}`;
})