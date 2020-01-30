function getForm()
{
    let name = $('#name').val();
    let permissions = $('#permissions').val();

    return {
        name: name,
        permissions: permissions
    }
}

function search()
{
    apiRequest('POST', 'roles/search', getForm()).done(function(json){
        let refs = [];
        let rows = [];

        $.each(json.data, function(i, v){
            refs.push(v.id);
            rows.push([v.name]);
        });

        setupTable({
            target: 'results',
            header: ['Name'],
            href: baseURI + 'admin/roles/',
            linkColumn: 0,
            sortColumn: 0,
            sortMethod: 'asc',
            refs: refs,
            rows: rows
        });

        setSearchCookie('roleSearch', getForm());
        unveil();
    });

    return false;
}

function create()
{
    apiRequest('POST', 'roles', getForm()).done(function(json){
        if(json.code === 201)
            window.location.replace(baseURI + 'admin/roles/?SUCCESS=Role created');
    });

    return false;
}

function save(id)
{
    apiRequest('PUT', 'roles/' + id, getForm()).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'admin/roles?SUCCESS=Role updated');
    });

    return false;
}

function remove(id)
{
    apiRequest('DELETE', 'roles/' + id, {}).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'admin/roles?SUCCESS=Role deleted');
    });
}

$(document).ready(function(){
    if(document.getElementById("results"))
        restoreSearch('roleSearch', search);
});