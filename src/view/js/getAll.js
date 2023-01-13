$.ajax({
    type:'GET',
    url: '/pizza-shop/getAllSauces',
    dataType: 'json',
    success: function (response) {
        $.each(response, function (i, element) {
            createOption(element.id, element.name, '#sauces');
        })
    }
})

$.ajax({
    type: 'GET',
    url: '/pizza-shop/getAllSizes',
    dataType: 'json',
    success: function (response) {
        $.each(response, function (i, element) {
            createOption(element.id, element.size, '#sizes');
        })
    }
})

$.ajax({
    type: 'GET',
    url: '/pizza-shop/getAllPizzas',
    dataType: 'json',
    success: function (response) {
        $.each(response, function (i, element) {
            createOption(element.id, element.name, '#pizzas');
        })
    }
})

function createOption(id, name, idAppend) {
    let o = new Option(name, id);
    $(o).html(name);
    $(idAppend).append(o);
}