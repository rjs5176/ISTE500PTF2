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
                v.type,
                v.street,
                v.city,
                v.state,
                v.zip,
                v.approved
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

$(document).ready(function(){
    if(!document.getElementById("results"))
        return;

    restoreSearch('trsOrgSearch', search);
});