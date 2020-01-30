function getForm()
{
    let name = $('#name').val();
    let permissions = $('#permissions').val();

    return {
        name: name,
        permissions: permissions
    };
}

function load()
{
    apiRequest('GET', 'secrets', {}).done(function(json){
        let refs = [];
        let rows = [];

        $.each(json.data, function(i, v){
            refs.push(v.id);
            rows.push([v.name]);
        });

        setupTable({
            target: 'results',
            header: ['Name'],
            linkColumn: 0,
            sortColumn: 0,
            sortMethod: 'asc',
            href: baseURI + 'admin/icadmin/',
            rows: rows,
            refs: refs
        });
    });
}

function create()
{
    apiRequest('POST', 'secrets', getForm()).done(function(json){
        if(json.code === 201)
            window.location.replace(baseURI + 'admin/icadmin/?SUCCESS=API Key created');
    });

    return false;
}

function save(id)
{
    apiRequest('PUT', 'secrets/' + id, getForm()).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'admin/icadmin?SUCCESS=API Key updated');
    });

    return false;
}

function remove(id)
{
    apiRequest('DELETE', 'secrets/' + id, {}).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'admin/icadmin?SUCCESS=API Key deleted');
    });

    return false;
}

$(document).ready(function(){
    if(document.getElementById("results"))
        load();
});