/**
 * Runs ajax request
 * 
 * @param url
 * @param dataObject
 * @param successAction
 * @param method Equals POST if default 
 * 
 * @return void
 */
function runSimpleAjax(url, dataObject, successAction, method) {
    if(!method){
        method = "POST"
    }
    $.ajax({
        method: method,
        url: url,
        cache: false,
        data: dataObject,
        success: successAction
    });
}