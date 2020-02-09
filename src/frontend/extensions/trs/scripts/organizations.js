let form = document.getElementById('search-form');

/**
 * Search API for Organizations
 */
function search()
{
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

$(document).ready(function(){
    if(!document.getElementById("results"))
        return;

    restoreSearch('trsOrgSearch', search);
});