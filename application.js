$(function(){ //DOM Ready
    $(".gridster ul").gridster({
        widget_margins: [10, 10],
        widget_base_dimensions: [140, 140]
        
    });
});

/*$(function(){ //DOM Ready
 
    $(".gridster ul").gridster(function () {
        widget_margins: [10, 10],
        widget_base_dimensions: [140, 140]
        min_cols: 3, max_cols:5;
    });
 
});*/
/*
$(function () {
    $("button").click(function () {
        window.alert(gridster.serialize());
        //post_to_url(zoo.php, gridster.serialize(), "post"); //check what gridster's actual output is before trusting this
    });
});
*/
/* code from http://stackoverflow.com/questions/133925/javascript-post-request-like-a-form-submit */
/*
function post_to_url(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
         }
    }

    document.body.appendChild(form);
    form.submit();
}
*/