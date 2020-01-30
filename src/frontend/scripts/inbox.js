/**
 * Load unread messages and display to screen
 */
function displayNotifications(includeOld = false)
{
    // Set the text to 'view'
    document.querySelector("#view-old-button-text").innerHTML = "View Old Notifications";
    $('#view-old-button').attr("href", "javascript: viewOldNotifications()");

    // Default to unread notifications
    let path = "currentUser/unreadNotifications";

    if(includeOld)
        path = "currentUser/notifications";

    // Display notifications
    apiRequest("GET", path, {}).done(function(json){

        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){
            refs.push(v.id);

            rows.push([
                v.title,
                v.time,
                v.data
            ]);
        });

        setupTable({
            target:'inbox',
            type:'table',
            header: ['Title', 'Time', 'Message'],
            sortColumn: 1,
            linkColumn: 0,
            href: baseURI + "inbox/",
            refs: refs,
            rows: rows
        });

    });

    // Unveil the screen
    unveil();
}

function viewOldNotifications()
{
    // Show old notifications
    displayNotifications(true);

    document.querySelector("#view-old-button-text").innerHTML = "Hide Old Notifications";
    $('#view-old-button').attr("href", "javascript: displayNotifications()");

    // Unveil window
    unveil();
}

$(document).ready(function(){
    displayNotifications();
});