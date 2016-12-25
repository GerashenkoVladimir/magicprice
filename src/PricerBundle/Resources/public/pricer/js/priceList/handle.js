/**
 * Created by vladimir on 11.08.2016.
 */
$(function () {
    $('#p_handle_price_list').bind('click', function () {
        handlePriceList(true);
    });
    
});

function handlePriceList(toClean) {
    var url =$("#p_handle_price_list").data("loadURL");
    runSimpleAjax(url, {
        toClean: toClean
    }, function (obj) {
        $("#messageContent").html(obj.message);
        if (!obj.endOfFile) {
            handlePriceList(false);
        }

    });
}