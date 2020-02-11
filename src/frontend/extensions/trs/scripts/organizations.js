/**
 * Search API for Organizations
 */
function search()
{
    let form = document.getElementById('search-form');
    let search = formToJSON(form);
    apiRequest('POST', 'trs/organizations/search', search).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){
            refs.push(v.id); // Org ID

            rows.push([
                v.name,
                v.type.toUpperCase(),
                v.street,
                v.city,
                v.state,
                v.zip,
                v.approved === '1' ? '✓' : ''
            ]);
        });

        $('#results').mlTable({
            header: ['Name', 'Type', 'Street', 'City', 'State', 'Zip', 'Approved'],
            linkColumn: 0,
            href: baseURI + 'trsbackoffice/organizations/',
            refs: refs,
            rows: rows,
            sortMethod: 'asc'
        });

        setSearchCookie('trsOrgSearch', search);
        unveil();
    });

    return false;
}

/**
 * Create an organization
 */
function createOrganization()
{
    let create = formToJSON(document.getElementById('org-form'));

    apiRequest('POST', 'trs/organizations', create).done(function(json){
        if(json.code === 201)
            window.location.replace(baseURI + 'trsbackoffice/organizations/' + json.data.id + '?SUCCESS=Organization Created')
    });

    return false;
}

/**
 * Update organization details
 * @param id
 * @returns {boolean}
 */
function editOrganization(id)
{
    let edit = formToJSON(document.getElementById('org-form'));

    apiRequest('PUT', 'trs/organizations/' + id, edit).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'trsbackoffice/organizations/?SUCCESS=Organization Updated')
    });

    return false;
}

/**
 * Delete organization
 * @param id
 */
function deleteOrg(id)
{
    apiRequest('DELETE', 'trs/organizations/' + id, {}).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'trsbackoffice/organizations?SUCCESS=Organization Deleted');
    });
}

let repsLoaded = false; // Has the following function been run?

/**
 * Load representatives for this organization
 * @param id
 * @param override Force the rep list to be re-loaded?
 */
function loadReps(id, override = false)
{
    let result = document.getElementById('representative-region');

    if(repsLoaded && !override)
        return;

    apiRequest('GET', 'trs/organizations/' + id + '/representatives', {}).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){
            rows.push([
                v.username,
                v.firstName,
                v.lastName,
                v.email,
                'REMOVE'
            ]);

            refs.push(v.username);
        });

        $(result).mlTable({
            header: ['Username', 'First Name', 'Last Name', 'E-Mail Address', ''],
            href: "javascript: removeRepresentative('" + id + "', '{{%}}')",
            usePlaceholder: true,
            linkColumn: 4,
            refs: refs,
            rows: rows,
        });

        repsLoaded = true;
    });
}

function addRepresentative(id)
{
    let username = document.getElementById('addRepresentativeUsername').value;

    apiRequest('POST', 'trs/organizations/' + id + '/representatives', {username: username}).done(function(json){
        if(json.code === 204)
        {
            showNotifications('success', ['Representative added']);
            loadReps(id, true); // Force load of reps list
        }
    });
}

function removeRepresentative(id, username)
{
    apiRequest('DELETE', 'trs/organizations/' + id + '/representatives', {username: username}).done(function(json){
        if(json.code === 204)
        {
            showNotifications('success', ['Representative removed']);
            loadReps(id, true); // Force load of reps list
        }
    });
}

$(document).ready(function(){
    if(!document.getElementById("results"))
        return;

    restoreSearch('trsOrgSearch', search);
});