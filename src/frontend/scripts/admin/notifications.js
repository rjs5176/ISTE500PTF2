function send()
{
    let title = $('#title').val();
    let important = $('#important').val();
    let data = $('#data').val();
    let roles = $('#roles').val();
    let email = 0;

    if($("#email").is(":checked"))
        email = 1;

    apiRequest('POST', 'notifications', {
        title: title,
        important: important,
        data: data,
        roles: roles,
        email: email
    }).done(function(json){
        if(json.code === 201)
            showNotifications('success', ['Notification sent to ' + json.data.count + ' users']);
        unveil();
    });

    return false;
}