function convert(money) {
    $.ajax({
        type: 'POST',
        url: '/pizza-shop/convert',
        data: {
            money: money,
        },
        success: function (response) {
            $('#cost').text('Цена: ' + response + 'BYN');
        }
    })
}