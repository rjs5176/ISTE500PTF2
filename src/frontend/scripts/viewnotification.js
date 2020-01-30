/**
 * Delete notification
 * @param id
 */
function deleteNotification(id)
{
    apiRequest("DELETE", "currentUser/notifications/" + id, {}).done(function(json){
        if(json.code === 204)
            window.location.replace("../inbox");
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });
}