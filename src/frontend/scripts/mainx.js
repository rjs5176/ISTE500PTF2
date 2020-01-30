/*
    MAINX.js
    Re-implemented functions from MAIN.js.
    Including functions converted to jQuery plugins.

    Generated 2019-10-30
    by lromero
 */

/**
 * Generates a DataTable with the supplied data and settings
 */
(function($){
    $.fn.mlTable = function(options){

        return this.each(function(){
            let $this = $(this);

            while(this.firstChild)
            {
                this.removeChild(this.firstChild);
            }

            let data = $.extend({
                header: [],

                checkboxColumn: null, //0-index integer or NULL

                sortColumn: 0, // 0-index integer
                sortMethod: 'desc', // 'asc' or 'desc'

                linkColumn: null, // 0-index integer or NULL
                linkNewTab: false,
                href: null, // Link or NULL
                refs: null, // Array of links or NULL
                usePlaceholder: false, //Placeholder is {{%}}

                rows: [], // Array of arrays of columns

                rawText: false, // should innerHTML be used instead of text node

                pageLength: 25,
                searchText: 'Filter:'
            }, options);

            // 'this' is the target div

            // Table
            let table = document.createElement('table');

            // Create header
            let thead = document.createElement('thead');
            let tr = document.createElement('tr');

            data.header.forEach(function(ele){
                let th = document.createElement('th');
                th.appendChild(document.createTextNode(ele));

                tr.appendChild(th);
            });

            thead.appendChild(tr);

            table.appendChild(thead);

            let tbody = document.createElement('tbody');

            // Create data rows
            for(let i = 0; i < data.rows.length; i++)
            {
                let tr = document.createElement('tr');

                // Add columns to row
                for(let j = 0; j < data.rows[i].length; j++)
                {
                    let td = document.createElement('td');

                    // Is this the link column?
                    if(data.linkColumn === j)
                    {
                        let a = document.createElement('a');

                        if(data.linkNewTab === true)
                            a.setAttribute('target', '_blank');

                        a.appendChild(document.createTextNode(data.rows[i][j]));

                        let href = data.href;

                        if(data.usePlaceholder === true)
                            href = href.replace('{{%}}', data.refs[i]);
                        else
                            href += data.refs[i];

                        a.setAttribute('href', href);

                        td.appendChild(a);
                    }
                    else if(data.rawText === true) // Use raw value, including HTML
                    {
                        td.innerHTML = data.rows[i][j];
                    }
                    else // Default to using text node
                    {
                        let value = '';

                        if(data.rows[i][j] !== null)
                            value = data.rows[i][j];

                        td.appendChild(document.createTextNode(value));
                    }

                    tr.appendChild(td);
                }

                tbody.appendChild(tr);
            }

            table.appendChild(tbody);

            // Remove existing contents of target
            while($this.firstChild)
            {
                $this.removeChild($this.firstChild);
            }

            $this.append(table);

            let dtSettings = {
                'pageLength': data.pageLength,
                'order': [[data.sortColumn, data.sortMethod]],
                'oLanguage': {
                    'sSearch': data.searchText
                }
            };

            if(typeof(data.checkboxColumn) == 'number')
            {
                dtSettings.columnDefs = [
                    {
                        'targets': data.checkboxColumn,
                        'checkboxes': {
                            'selectRow': true
                        }
                    }
                ];

                dtSettings.select = {
                    'style': 'multi'
                };
            }

            $(table).DataTable(dtSettings);

        });
    }
})(jQuery);