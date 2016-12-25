/**
 * Created by vladimir on 08.08.2016.
 */

$(function () {
    $("#p_load_price_list").bind('click', function () {
        loadPriceList(true);
    });
});

function loadPriceList(toClean) {
    var url =$("#p_load_price_list").data("loadURL");
    runSimpleAjax(url, {
        toClean: toClean
    }, function (obj) {
        $("#testContent").html(obj.message);
        if (!obj.endOfFile) {
            loadPriceList(false);
        }

    });
}