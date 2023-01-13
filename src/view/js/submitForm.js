$('#order-form').submit(function (e) {
    e.preventDefault();

    $.ajax({
        type: 'POST',
        url: '/pizza-shop/order',
        data: $('#order-form').serialize(),
        dataType: 'json',
        success: function (response) {
            if (response.error !== undefined) {
                if (response.error.code === 666) {
                    $('#pizza-error').text(response.error.message).show();
                    return;
                }

                $('#pizza-error').hide();

                if (response.error.code === 13) {
                    $('#size-error').text(response.error.message).show();
                    return;
                }
            }

            $('#size-error').hide();

            $('#cheque').show();
            $('#pizza-name').text('Название: ' + response.pizza.name);
            $('#size-name').text('Размер: ' + response.size.size);
            if (response.sauce != null) {
                $('#sauce-name').text('Соус: ' + response.sauce.name);
            } else {
                $('#sauce-name').hide();
            }

        },
    });

    $.ajax({
        type: 'GET',
        url: 'https://www.nbrb.by/api/exrates/rates/431',
        dataType: 'json',
        success: function (response) {
            convert(response['Cur_OfficialRate'])
        },
        error: function (response) {
            console.log(response);
        }
    })
});