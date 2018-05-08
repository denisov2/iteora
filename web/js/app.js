/**
 * Created by denisov on 08.05.2018.
 */

$(document).ready(function () {

    $('#btn-clear-order').on('click', clearQueue );
    setInterval(checkQueue, 1000);

});

function updateDishes() {

    var checkbox_ids = [];

    $('input.product-checkbox').each(function () {

        if ($(this).val() == 1) {

            checkbox_ids.push($(this).attr('id'))
        }
    });

    $.ajax({
        url: '/ajax/update-dishes',
        dataType: "json",
        type: 'POST',
        data: {
            checkbox_ids: checkbox_ids
        },
        success: function (data) {

            if(data.success) {

                $('div.dishes-wrapper').html(data.content);
            }
        }
    });
}

function orderDish (id) {

    $.ajax({
        url: '/ajax/order-dish',
        dataType: "json",
        type: 'POST',
        data: {
            dish_id: id
        },
        success: function (data) {

            if(data.success == 1) {

                $('h2.queue-header').text('Очередь приготовления');

            } else {

                $('h2.queue-header').text('Максимум 2 блюда!');
            }

                $('div.queue-wrapper').html(data.content);
        }
    });
}

function clearQueue(){
    $.ajax({
        url: '/ajax/order-clear',
        dataType: "json",
        type: 'POST',
        success: function (data) {
            $('h2.queue-header').text('Очередь приготовления');

            $('div.queue-wrapper').html(data.content);
        }
    });
}

function checkQueue() {
    
    $.ajax({
        url: '/ajax/check-queue',
        dataType: "json",
        type: 'POST',
        success: function (data) {

            if(data.deleted) {

               $('h2.queue-header').text('Ваше блюдо готово!');
            }
            
            $('div.queue-wrapper').html(data.content);
        }
    });
}

function blockDishes() {
    //TODO:

}

function unblockDishes() {
    //TODO:

}