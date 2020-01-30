/**
 * DEPRECATED: use MAINX.js jQuery plugin .mlTable()
 * Create a table based on JSON and format it as a datatable
 */
function setupTable(data)
{
    let display = document.getElementById(data.target);

    let table = document.createElement('table');

    // Create header
    let header = document.createElement("thead");
    let headerRow = document.createElement("tr");

    for(let i = 0; i < data.header.length; i++)
    {
        let th = document.createElement("th");
        th.appendChild(document.createTextNode(data.header[i]));

        headerRow.appendChild(th);
    }
    header.appendChild(headerRow);

    table.appendChild(header);

    let body = document.createElement('tbody');

    // Create data rows
    for(let i = 0; i < data.rows.length; i++)
    {
        let row = document.createElement("tr");

        for(let j = 0; j < data.rows[i].length; j++)
        {
            let td = document.createElement("td");

            // Check for link column
            if(typeof(data.linkColumn) !== 'undefined')
            {
                if(data.linkColumn === j)
                {
                    let a = document.createElement("a");

                    if(typeof data.linkNewTab !== "undefined") //  Open in new tab if requested
                        a.setAttribute('target', '_blank');

                    a.appendChild(document.createTextNode(data.rows[i][j]));

                    let href = data.href;

                    if(data.usePlaceholder === true)
                    {
                        href = href.replace('{{%}}', data.refs[i]);
                    }
                    else
                    {
                        href += data.refs[i];
                    }

                    $(a).attr("href", href);

                    td.appendChild(a);
                }
                else
                {
                    let value = "";

                    if(data.rows[i][j] !== null)
                        value = data.rows[i][j];

                    td.appendChild(document.createTextNode(value));
                }
            }
            else
            {
                if(typeof(data.rawText) !== 'undefined' && data.rawText === true) // allow HTML tags to be present in the resulting table
                    td.innerHTML = data.rows[i][j];
                else
                    td.appendChild(document.createTextNode(data.rows[i][j]));
            }

            row.appendChild(td);
        }

        body.appendChild(row);
    }

    table.appendChild(body);

    // Remove loading image
    while(display.firstChild)
        display.removeChild(display.firstChild);

    display.appendChild(table);

    if(typeof(data.sortColumn) == 'undefined')
        data.sortColumn = 0;
    if(typeof(data.sortMethod) == 'undefined')
        data.sortMethod = 'desc';

    let settings = {
            'pageLength': 25,
            'order': [[data.sortColumn, data.sortMethod]],
            'oLanguage': {
                'sSearch': 'Filter:'
            }
        };

    if(typeof(data.checkboxes) !== 'undefined')
    {
        settings.columnDefs = [
            {
                'targets': data.checkboxColumn,
                'checkboxes': {
                    'selectRow': true
                }
            }
        ];

        settings.select = {
            'style': 'multi'
        };
    }

    $(table).DataTable(settings);
}

/**
 * Set up login page
 */
function loginSetup()
{
    let loginWindow = document.getElementById('login-window');

    if(!loginWindow)
        return;

    // Add listener to login button
    loginWindow.onsubmit = function () {
        document.getElementById('login-button').value = 'Logging in...';
    };

    // Set login page background

    loginWindow.parentNode.style.backgroundColor = '#38383d';
}

/**
 * Sets up the dismiss button for notifications
 */
function notificationSetup()
{
    $('#notifications-dismiss').click(function(){$('#notifications').fadeOut()});
}

/**
 * Initialize date pickers
 */
function datePickerSetup()
{
    $('.date-input').datepicker({dateFormat: 'yy-mm-dd'});
}

/**
 * Add veil effect to buttons
 */
function buttonSetup()
{
    $('.button').click(function(){
        veil();
    });
}

/**
 * Add listener to form submit buttons
 */
function formSubmitButtonSetup()
{
    $('.form-submit-button').click(function(){
        $('#' + $(this).attr('id') + '-form').submit();
    });

    // Allow enter to work
    $('.search-form').each(function() {
        $(this).find('input').keypress(function(e) {
            // Enter pressed?
            if(e.which === 10 || e.which === 13) {
                veil();
                this.form.onsubmit.call();
            }
        });
    });
}

/**
 * Veil the screen
 */
function veil()
{
    $('#veil').fadeIn(150);
}

/**
 * Un-veil the screen
 */
function unveil()
{
    $('#veil').fadeOut(150);
}

/**
 * Add confirm alert to all confirm-buttons
 */
function confirmButtonSetup()
{
    $('.confirm-button').click(function(e){
        if(!confirm('Are you sure?'))
        {
            e.preventDefault();
            window.location.reload();
        }
    });
}

/**
 * Set up any TinyMCE textareas
 */
function tinymceSetup()
{
    tinymce.init({
        selector: 'textarea#editor',
        height: 300,
        plugins: "lists link",
        toolbar: "formatselect | bold italic | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent link"
    });
}

/**
 * Perform a call to InfoCentral though the proxy page
 * @param type "GET"
 * @param path
 * @param data
 * @param base64
 * @returns {*|*|*|*}
 */
function apiRequest(type, path, data, base64 = false)
{
    let validTypes = ['DELETE', 'PUT', 'POST', 'GET'];

    if(!validTypes.includes(type))
        type = 'GET';

    return $.post(baseURI + '!api-request', {type:type, path: path, data:JSON.stringify(data)}, function(json){
        if(json.code === 401)
        {
            if(json.data.errors[0] === 'Session expired')
                location.reload(); // Reload, which will cause redirect to login
            else
                showNotifications('errors', json.data.errors); // Not caused by session expiration
            unveil();
        }
        else if(json.code === 500) // InfoCentral Errors
        {
            let errors = ['System did not provide a valid response'];

            if(json.data.errors !== 'undefined')
                errors = json.data.errors;

            showNotifications('error', errors);
            unveil();
        }
        else if(json.code === 409 || json.code === 400 || json.code === 404 || json.code === 403) // Form error, bad request, not found
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    }, 'json');
}

/**
 *
 * @param name
 * @param data
 */
function setSearchCookie(name, data)
{
    document.cookie = "ML_" + name + "=" + window.btoa(JSON.stringify(data)) + ";path=" + baseURI;
}

function setCookie(name, value)
{
    document.cookie = "ML_" + name + "=" + value + ";path=" + baseURI;
    return true;
}

/**
 * Returns the value of the cookie with the specified name
 * @param name
 *
 * @returns {string}
 */
function getCookie(name)
{
    name = "ML_" + name + "=";
    let decodedCookie = decodeURIComponent(document.cookie);

    let cookies = decodedCookie.split(';');

    for(let i = 0; i < cookies.length; i++)
    {
        let cookie = cookies[i];

        while(cookie.charAt(0) === ' ')
        {
            cookie = cookie.substring(1);
        }

        if(cookie.indexOf(name) === 0)
        {
            return cookie.substring(name.length, cookie.length);
        }
    }

    return "";
}

/**
 * Removes all cookies except those starting with 'ML_', which are used to save past search history/actions
 */
function clearCookies()
{
    let cookies = document.cookie.split(";");

    for(let i = 0; i < cookies.length; i++)
    {
        let equals = cookies[i].indexOf("=");
        let name = equals > -1 ? cookies[i].substr(0, equals) : cookies[i];

        if(name.indexOf("ML_") !== -1)
        {
            document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=" + baseURI;
        }
    }

    showNotifications('success', ['Session cache has been cleared']);
}

/**
 * Requests user's current notification count
 */
function loadUnreadNotificationCount()
{
    let unreadCount = document.querySelector("#unreadNotificationCount");

    // Make sure it exists
    if(unreadCount == null)
        return;

    // Remove existing contents
    while(unreadCount.firstChild)
    {
        unreadCount.removeChild(unreadCount.firstChild);
    }

    let loadingImage = document.createElement("img");
    $(loadingImage).attr('src', baseURI + 'media/animations/ajax.gif');
    $(loadingImage).attr('alt', '');

    unreadCount.appendChild(loadingImage);

    apiRequest("GET", "currentUser/unreadNotificationCount", {}).done(function(json){
        if(json.data.length !== 0)
        {
            // Remove loading animation
            unreadCount.removeChild(unreadCount.firstChild);
            unreadCount.appendChild(document.createTextNode(json.data.count));
        }
    });
}

/**
 * Adds the loading animation to 'wait' elements
 */
function setupLoadingImage()
{
    $('.wait').each(function(i,v){

        let loadingImage = document.createElement("img");
        $(loadingImage).attr('src', baseURI + 'media/animations/wait.gif');
        $(loadingImage).attr('alt', '');
        v.appendChild(loadingImage);

    });
}

function applyLoadingImage(id)
{
    let target = $('#' + id);
    let loadingImage = document.createElement("img");
    $(loadingImage).attr('src', baseURI + 'media/animations/wait.gif');
    $(loadingImage).attr('alt', '');

    target.empty();
    target.append(loadingImage);

}

/**
 * Set up the additional fields button for large search forms
 */
function setupSearchAdditionalFields()
{
    $('.search-additional-field-toggle').click(function(e){
        let additionalFields = $(this).parent().parent().find('.additional-fields');

        $.each(additionalFields, function(i, item)
        {
            if($(item).is(':hidden'))
            {
                $(item).show();
                $(e.target).html("Show Less");
            }
            else
            {
                $(item).hide();
                $(e.target).html("Show More");
            }
        });
    });
}

/**
 * Sets up these buttons to go up a directory
 */
function setupBackButtons()
{
    $('.back-button').click(function(){window.location.href='..';});
}

/**
 * Sets up these buttons to go back in browser history
 */
function setupHistoryBackButtons()
{
    $('.browser-back').click(function(){window.history.back();});
}

/**
 * Makes it so clicking region headers toggles the region display
 */
function setupExpandableRegions()
{
    // Add listeners to region expand buttons
    $('.region-expand').click(function(e){
        if($(this).hasClass("region-expand-collapsed"))
        {
            // Change indicator
            $(this).addClass("region-expand-expanded");
            $(this).removeClass("region-expand-collapsed");

            // Show region
            $(this).next().show();
        }
        else
        {
            $(this).removeClass("region-expand-expanded");
            $(this).addClass("region-expand-collapsed");

            $(this).next().hide();
        }
    });
}

/**
 * Causes the click of these buttons to display a dialog with the same id followed by '-dialog'
 */
function setupDialogButtons()
{
    $('.dialog-show-button').click(function(e){
        $('#' + $(this).attr('id') + '-dialog').dialog().dialog("option", {
            position: {
                my: 'top',
                at: 'right',
                of: event
            }
        });
    });
}

/**
 * Generate notifications/errors as if they had been added in template/URL
 * @param type
 * @param items
 */
function showNotifications(type, items)
{
    // Remove existing notifications
    let notifications = document.getElementById("notifications");

    if(notifications !== null)
    {
        notifications.remove();
    }

    notifications = document.createElement("div");
    notifications.id = "notifications";

    // Add type class
    switch(type)
    {
        case "error":
            $(notifications).addClass("notifications-error");
            break;
        case "success":
            $(notifications).addClass("notifications-success");
            break;
        default:
            $(notifications).addClass("notifications-notice");
    }

    // Add dismiss button
    let dismissButton = document.createElement("div");
    dismissButton.id = "notifications-dismiss";
    dismissButton.appendChild(document.createTextNode("X"));
    notifications.appendChild(dismissButton);

    // Add heading
    let heading = document.createElement("h3");
    let icon = document.createElement("i");
    icon.classList.add('icon');

    let title = "Notice";

    switch(type)
    {
        case "error":
            icon.appendChild(document.createTextNode("error"));
            title = "Error";
            break;
        case "success":
            icon.appendChild(document.createTextNode("check_circle"));
            title = "Success";
            break;
        default:
            icon.appendChild(document.createTextNode("info"));
    }

    heading.appendChild(icon);
    heading.appendChild(document.createTextNode(title));
    notifications.appendChild(heading);

    // Add notifications
    let notificationList = document.createElement("ul");

    $(items).each(function(i, v){
        let notification = document.createElement("li");
        notification.appendChild(document.createTextNode(v));
        notificationList.appendChild(notification);
    });

    notifications.appendChild(notificationList);

    // Add to 'view'
    document.getElementById("content").appendChild(notifications);

    // Show
    $(notifications).fadeIn();
    notificationSetup();
    unveil();
}

/**
 * Fetches information from the API and sets up an auto-complete list on an input
 * @param options
 */
function setupAutoCompleteList(options)
{
    $('#' + options.target).autocomplete({
        source: options.items,
        select: options.select,
        change: options.change
    });
}

function restoreSearch(cookieName, next)
{
    let last = getCookie(cookieName);

    if(last === '')
        return;

    veil();

    last = JSON.parse(window.atob(last));

    $.each(last, function(i, v){
        $('#' + i).val(v);
    });

    next();
}

function disableAutocomplete()
{
    $('input').attr('autocomplete', 'off');
}

/**
 * Setup document
 */
$(document).ready(function(){
    loginSetup();
    notificationSetup();
    formSubmitButtonSetup();
    confirmButtonSetup();
    buttonSetup();
    datePickerSetup();
    tinymceSetup();
    setupSearchAdditionalFields();
    setupBackButtons();
    setupHistoryBackButtons();
    setupExpandableRegions();
    setupDialogButtons();
    disableAutocomplete();

    setupLoadingImage();

    loadUnreadNotificationCount();

    // Fade in notifications if they are present
    $('#notifications').fadeIn();
});