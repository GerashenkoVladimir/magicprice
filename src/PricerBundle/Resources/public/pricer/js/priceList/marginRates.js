/**
 * Created by vladimir on 26.08.2016.
 */

$(function () {
    $('#p_add_margin_field').bind('click', function (event) {
        if (!isInputsEmpty('#p_margin_rates_container')) {
            alert('Заполните все поля!');
            return;
        }
        var button = $(event.target);
        var index = + button.parent('p').data('index');
        var previousToValue = $('#p_to_' + index).val();
        index++;
        var nextField = $('<p id="p_margin_field_container_' + index + '">' +
            'от <span id="p_from_' + index + '">' + previousToValue + '</span>' +

            '<label for="p_to_' + index + '">до</label>' +
            '<input class="p_to_field" type="number" id="p_to_' + index + '" min="' + previousToValue +
            '" value="' + previousToValue + '" max="999999" required="required">' +

            '<input type="number" id="p_margin_rate_' + index + '" max="1000" required="required">' +
            '<label for="p_margin_rate_' + index + '">%</label>' +
            '</p>');
        $('#p_margin_rates_container').append(nextField);
        button.detach();
        var inputTo = $('#p_to_' + index);
        inputTo.bind('input', changeMarginFields);
        inputTo.bind('change', validateMarginFields);
        var removeButton = $('#p_remove_button');
        if (!removeButton.length) {
            removeButton = $('<button id="p_remove_button">-</button>')
            removeButton.bind('click', handleRemove);
            nextField.prepend(removeButton);
        } else {
            removeButton.detach();
            nextField.prepend(removeButton);
        }
        nextField.append(button);
        button.parent('p').data('index', index);
    });
    var inputToFields = $('.p_to_field');
    console.log(inputToFields);
    for (var i = 0; i < inputToFields.length; i++) {
        inputToFields.eq(i).bind('input', changeMarginFields);
        inputToFields.eq(i).bind('change', validateMarginFields);
    }

    $('#p_remove_button').bind('click', handleRemove);
    $('#p_save_button').bind('click', function (event) {
        var saveButton = $(event.target);
        if (!isInputsEmpty('#p_margin_rates_container')) {
            alert('Заполните все поля!');
            return;
        }
        validateMarginFields();
        var fieldsCounter = $('p', '#p_margin_rates_container').length;
        var marginRatesData = {};
        for (var i = 0; i < fieldsCounter; i++) {
            marginRatesData[i] = {
                from: +$('#p_from_' + i).text(),
                to: +$('#p_to_' + i).val(),
                rate: +$('#p_margin_rate_' + i).val()
            }
        }
        $.ajax(saveButton.data('url'),{
            method: 'POST',
            data: {
                marginRatesData: marginRatesData
            },
            success: function (response) {
                console.log(response);
            }
        });

    });
});
function isInputsEmpty(context) {
    var inputList = $("input[required='required']", $(context));
    for (var i = 0; i < inputList.length; i++) {
        if (!inputList.eq(i).val()){
            return false;
        }
    }
    return true;
}

function changeMarginFields(event) {
    var input = $(event.target);
    var inputVal = +input.val();
    var previousIndex = input.parent('p').data('index');
    var nextIndex = previousIndex + 1;
    changeNextField(nextIndex, inputVal);

}

function changeNextField(index, inputVal) {
    var inputsCount = $('.p_to_field').length;
    if (index <= inputsCount - 1) {
        var spanFrom = $('#p_from_' + index);
        var fromVal = +spanFrom.text();
        var inputTo = $('#p_to_' + index);

        if (fromVal != inputVal) {
            spanFrom.text(inputVal);
            fromVal = inputVal;
            inputTo.attr('min', fromVal);
        }

        var toVal = inputTo.val();
        if (fromVal > toVal) {
            inputTo.val(fromVal);
            toVal = fromVal;
            inputTo.attr('min', toVal);
        }

        changeNextField(index + 1, toVal);
    }
    return false;
}

function validateMarginFields() {
    var fieldsCount = $('p', '#p_margin_rates_container').length;
    for (var i = 0; i < fieldsCount; i++) {
        var fromVal = +$('#p_from_' + i).text();
        var toVal = +$('#p_to_' + i).val();
        var errorMessage = $('#error_message');
        if (fromVal > toVal) {
            errorMessage.html('Заполните все поля коректно!');
            return false;
        }
        errorMessage.html('');
    }
    return true;
}

function handleRemove(event) {
    var removeButton = $(event.target);
    var addButton = $('#p_add_margin_field').detach();
    var containerForRemove = removeButton.parent('p');
    removeButton.detach();
    containerForRemove.remove();
    var fieldsContainers = $('p', $('#p_margin_rates_container'));
    if (fieldsContainers.length > 1) {
        fieldsContainers.eq(fieldsContainers.length - 1).prepend(removeButton);
    }
    fieldsContainers.eq(fieldsContainers.length - 1).append(addButton);
}