function getSearch()
{
    let title = $('#title').val();
    let startDate = $('#startDate').val();
    let endDate = $('#endDate').val();
    //let inactiveYes = $('#inactiveYes');
    //let inactiveNo = ($('#inactiveNo'));

    //let inactive = [];

    /*
    if($(inactiveYes).is(":checked"))
        inactive.push(1);
    if($(inactiveNo).is(":checked"))
        inactive.push(0);

    inactiveYes = $(inactiveYes).val();
    inactiveNo = $(inactiveNo).val();
    */

    return {
        title: title,
        startDate: startDate,
        endDate: endDate,
        //inactiveYes: inactiveYes,
        //inactiveNo: inactiveNo,
        //inactive: inactive
    };
}

function getForm()
{
    let title = $('#title').val();
    let startDate = $('#startDate').val();
    let endDate = $('#endDate').val();
    let inactive = $('#inactive').val();
    let message = $('#message').val();
    let type = $('#type').val();
    let roles = $('#roles').val();

    return {
        title: title,
        startDate: startDate,
        endDate: endDate,
        inactive: inactive,
        message: message,
        type: type,
        roles: roles
    };
}

function search()
{
    apiRequest('POST', 'bulletins/search', getSearch()).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){
            refs.push(v.id);

            rows.push([
                v.title,
                v.startDate,
                v.endDate === '9999-12-31' ? '' : v.endDate,
                v.type === 'i' ? 'Info' : 'Alert',
                v.inactive ? "✓" : ""
            ]);
        });

        setupTable({
            target: 'results',
            header: ['Title', 'Start Date', 'End Date', 'Type', 'Disabled'],
            linkColumn: 0,
            href: baseURI + 'admin/bulletins/',
            sortColumn: 2,
            refs: refs,
            rows: rows
        });

        setSearchCookie('bulletinSearch', getSearch());
        unveil();
    });

    return false;
}

function create()
{
    apiRequest('POST', 'bulletins', getForm()).done(function(json){
        if(json.code === 201)
            window.location.replace(baseURI + 'admin/bulletins/?SUCCESS=Bulletin created');
    });

    return false;
}

function save(id)
{
    apiRequest('PUT', 'bulletins/' + id, getForm()).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'admin/bulletins?SUCCESS=Bulletin updated');
    });

    return false;
}

function remove(id)
{
    apiRequest('DELETE', 'bulletins/' + id, {}).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'admin/bulletins?SUCCESS=Bulletin deleted');
    });
}

$(document).ready(function(){
    if(document.getElementById("results"))
        restoreSearch('bulletinSearch', search);
});