function search()
{
    let username = $('#username').val();
    let ipAddress = $('#ipAddress').val();
    let startDate = $('#startDate').val();
    let endDate = $('#endDate').val();

    apiRequest('POST', 'tokens/search', {
        username: username,
        ipAddress: ipAddress,
        startDate: startDate,
        endDate: endDate
    }).done(function(json){
        let rows = [];

        $.each(json.data, function(i, v){
            rows.push([
                v.user,
                v.ipAddress,
                v.issueTime,
                v.expireTime,
                v.expired ? '✓' : ''
            ]);
        });

        setupTable({
            target: 'results',
            header: ['User', 'I.P. Address', 'Issue Time', 'Expire Time', 'Expired'],
            sortColumn: 2,
            rows: rows
        });

        unveil();
    });

    return false;
}