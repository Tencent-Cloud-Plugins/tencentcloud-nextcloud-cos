$("#save-config").click(function () {
    var baseUrl = OC.generateUrl('/apps/tencentcloudcosconfig/configs');
    var config = {
        key: $("#secretId").val(),
        secret: $("#secretKey").val(),
        bucket: $("#bucket").val(),
        hostname: $("#hostname").val(),
    };

    $.ajax({
        url: baseUrl,
        type: 'POST',
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(config)
    }).done(function (response) {
        alert(response.msg);
    }).fail(function (response, code) {
        alert('Network Error');
    });
});

$("#toggle-secretId").click(function () {
    changeInputType($("#secretId"));
});

$("#toggle-secretKey").click(function () {
    changeInputType($("#secretKey"));
});

function changeInputType(obj) {
    if (obj.attr("type") === 'password') {
        obj.attr("type","text");
    } else {
        obj.attr("type","password");
    }

}