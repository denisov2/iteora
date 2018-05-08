/**
 * Created by denisov on 08.05.2018.
 */


$(document).ready(function () {


});


function updateDishes() {

    var checkbox_ids = [];

    $('input.product-checkbox').each(function () {

        //console.log($(this).val());

        if ($(this).val() == 1) {


            checkbox_ids.push($(this).attr('id'))
        }
    });

    $.ajax({
        url: '/ajax/update-dishes',
        dataType: "json",
        type: 'POST',
        data: {
            checkbox_ids: checkbox_ids,
            keyword: [1, 2, 3]
        },
        success: function (data) {


            if(data.success) {

                console.log(data.content);

                $('div.dishes-wrapper').html(data.content);
            }

        }
    });

}

function orderDish (id) {

    alert (id);
}

function blockDishes() {

}

function unblockDishes() {


}