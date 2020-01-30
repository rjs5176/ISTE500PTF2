function search()
{
    let username = $('#username').val();
    let ipAddress = $('#ipAddress').val();
    let timeStart = $('#timeStart').val();
    let timeEnd = $('#timeEnd').val();

    apiRequest('POST', 'badlogins/search', {
        username: username,
        ipAddress: ipAddress,
        timeStart: timeStart,
        timeEnd: timeEnd
    }).done(function(json){
        let rows = [];

        $.each(json.data, function(i, v){
            console.log(v);
            rows.push([
                v.time,
                v.username,
                v.suppliedIP,
                v.sourceIP
            ]);
        });

        setupTable({
            target: 'results',
            header: ['Time', 'Username', 'Supplied I.P.', 'Source I.P.'],
            sortColumn: 0,
            sortMethod: 'desc',
            rows: rows
        });

        unveil();
    });

    return false;
}