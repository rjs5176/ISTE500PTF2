/**
 * Search API for Organizations
 */
function search()
{
    let form = document.getElementById('search-form');
    let search = formToJSON(form);
    apiRequest('POST', 'trs/commodities/categories/search', search).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){
            refs.push(v.id); // ComCat ID

            rows.push([
                v.name,
            ]);
        });

        $('#results').mlTable({
            header: ['Name'],
            linkColumn: 0,
            href: baseURI + 'trsbackoffice/commodities/categories/',
            refs: refs,
            rows: rows,
            sortMethod: 'asc'
        });

        setSearchCookie('trsComCatSearch', search);
        unveil();
    });

    return false;
}

/**
 * Create an organization
 */
function createCategory()
{
    let create = formToJSON(document.getElementById('org-form'));

    apiRequest('POST', 'trs/commodities/categories/', create).done(function(json){
        if(json.code === 201)
            window.location.replace(baseURI + 'trsbackoffice/commodities/categories/' + json.data.id + '?SUCCESS=Category Created')
    });

    return false;
}

/**
 * Update category details
 * @param id
 * @returns {boolean}
 */
function editCategory(id)
{
    let edit = formToJSON(document.getElementById('cat-form'));

    apiRequest('PUT', 'trs/commodities/categories/' + id, edit).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'trsbackoffice/commodities/categories/?SUCCESS=Category Updated')
    });

    return false;
}

/**
 * Delete category
 * @param id
 */
function deleteComCat(id)
{
    apiRequest('DELETE', 'trs/commodities/categories/' + id, {}).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'trsbackoffice/commodities/categories/?SUCCESS=Category Deleted');
    });
}

$(document).ready(function(){
    if(!document.getElementById("results"))
        return;

    restoreSearch('trsComCatSearch', search);
});