function getSearch()
{
    let username = $('#username').val();
    let firstName = $('#firstName').val();
    let lastName = $('#lastName').val();
    let disabled = $('#disabled').val();

    return {
        username: username,
        firstName: firstName,
        lastName: lastName,
        disabled: disabled
    };
}

function getForm()
{
    let username = $('#username').val();
    let authType = $('#authType').val();
    let firstName = $('#firstName').val();
    let lastName = $('#lastName').val();
    let email = $('#email').val();
    let disabled = $('#disabled').val();
    let password = $('#password').val();
    let roles = $('#roles').val();

    return {
        username: username,
        authType: authType,
        firstName: firstName,
        lastName: lastName,
        email: email,
        disabled: disabled,
        password: password,
        roles: roles
    };
}

function search()
{
    apiRequest('POST', 'users/search', getSearch()).done(function(json){
        let refs = [];
        let rows = [];

        $.each(json.data, function(i, v){
            refs.push(v.id);

            rows.push([
                v.username,
                v.firstName,
                v.lastName,
                v.email,
                v.disabled ? '✓' : ''
            ]);
        });

        setupTable({
            target: 'results',
            header: ['Username', 'First Name', 'Last Name', 'E-Mail Address', 'Disabled'],
            linkColumn: 0,
            sortColumn: 0,
            sortMethod: 'asc',
            href: baseURI + 'admin/users/',
            rows: rows,
            refs: refs
        });

        setSearchCookie('userSearch', getSearch());
        unveil();
    });
    return false;
}

function create()
{
    apiRequest('POST', 'users', getForm()).done(function(json){
        if(json.code === 201)
            window.location.replace(baseURI + 'admin/users/?SUCCESS=User created');
    });

    return false;
}

function save(id)
{
    apiRequest('PUT', 'users/' + id, getForm()).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'admin/users?SUCCESS=User updated');
    });

    return false;
}

function remove(id)
{
    apiRequest('DELETE', 'users/' + id, {}).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'admin/users?SUCCESS=User deleted');
    });
}

/**
 * Disabled attributes only needed for local accounts
 */
function updateForm()
{
    let authType = $('#authType').val();
    let localInputs = $('.localOnly');

    if(authType === 'ldap')
    {
        $(localInputs).attr('disabled', 'disabled');
    }
    else
    {
        $(localInputs).removeAttr('disabled');
    }
}

$(document).ready(function(){
    updateForm();
    if(document.getElementById("results"))
        restoreSearch('userSearch', search);
});

// Change form when auth type is changed
$('#authType').change(function(){updateForm()});