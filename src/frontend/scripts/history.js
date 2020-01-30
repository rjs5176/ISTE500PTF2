function loadHistory(object, index)
{
    apiRequest('GET', 'history', {
        object: object,
        index: index
    }).done(function(json){
        if(json.code === 200)
        {
            let historyItems = document.querySelector('#historyItems');
            let rows = [];
            let refs = [];

            $.each(json.data, function(i, v){
                refs.push(v.id);

                rows.push([
                    v.username,
                    v.action,
                    v.time
                ]);

                let changeDiv = document.createElement("div");
                $(changeDiv).attr('id', 'history-' + v.id).attr('title', 'View Changes').hide();

                let changeTable = document.createElement("table");
                $(changeTable).addClass('dialog-table');
                let row = document.createElement("tr");

                let header = document.createElement("th");
                header.appendChild(document.createTextNode("Parameter"));
                row.appendChild(header);

                header = document.createElement("th");
                header.appendChild(document.createTextNode("Old Value"));
                row.appendChild(header);

                header = document.createElement("th");
                header.appendChild(document.createTextNode("New Value"));
                row.appendChild(header);

                changeTable.appendChild(row);

                $.each(v.changes, function(j, w){

                    row = document.createElement("tr");

                    let cell = document.createElement("td");
                    cell.appendChild(document.createTextNode(w.column));
                    row.appendChild(cell);

                    cell = document.createElement("td");
                    cell.appendChild(document.createTextNode(w.oldValue));
                    row.appendChild(cell);

                    cell = document.createElement("td");
                    cell.appendChild(document.createTextNode(w.newValue));
                    row.appendChild(cell);

                    changeTable.appendChild(row);
                });

                changeDiv.appendChild(changeTable);

                historyItems.appendChild(changeDiv);
            });

            setupTable({
                target: 'results',
                header: ['Operator', 'Action', 'Time'],
                linkColumn: 2,
                href: "javascript: viewHistory('{{%}}')",
                usePlaceholder: true,
                refs: refs,
                sortColumn: 2,
                rows: rows
            });
        }
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });
}

function viewHistory(id)
{
    $('#history-' + id).dialog();
}