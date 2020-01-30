function search()
{
    let permission = $('#permission').val();

    apiRequest('POST', 'permissions/audit', {
        permission: permission
    }).done(function(json){
        let refs = [];
        let rows = [];

        $.each(json.data, function(i, v){
            refs.push(v.id);
            rows.push([v.username, v.name]);
        });

        setupTable({
            target: 'results',
            header: ['User', 'Name'],
            linkColumn: 0,
            href: "javascript: viewUser('{{%}}')",
            usePlaceholder: true,
            rows: rows,
            refs: refs,
            sortColumn: 0,
            sortMethod: 'asc'
        });

        unveil();
    });

    return false;
}

function viewUser(id)
{
    veil();
    let permission = $('#permission').val();

    apiRequest('POST', 'permissions/audit/' + id, {
        permission: permission
    }).done(function(json){
        if(json.code !== 200)
        {
            unveil();
            return;
        }

        let userDisplay = $('#user-display');
        $(userDisplay).html('');

        // Username link
        let userLink = document.createElement('a');
        $(userLink).attr('href', baseURI + 'admin/users/' + id);

        let userIcon = document.createElement('i');
        userIcon.classList.add('icon');
        userIcon.appendChild(document.createTextNode("account_circle"));

        userLink.appendChild(userIcon);
        userLink.appendChild(document.createTextNode(json.data.username));

        $(userDisplay).append(userLink);

        // Role list
        let roleTitle = document.createElement('p');
        roleTitle.appendChild(document.createTextNode('Roles that grant permission:'));
        $(userDisplay).append(roleTitle);

        let roleList = document.createElement('ul');

        $.each(json.data.roles, function(i, v){
            let role = document.createElement('li');

            let roleIcon = document.createElement('i');
            roleIcon.classList.add('icon');
            roleIcon.appendChild(document.createTextNode('group'));

            let roleLink = document.createElement('a');
            $(roleLink).attr('href', baseURI + 'admin/roles/' + v.id);

            roleLink.appendChild(roleIcon);
            roleLink.appendChild(document.createTextNode(v.name));
            role.appendChild(roleLink);

            roleList.appendChild(role);
        });

        $(userDisplay).append(roleList);
        userDisplay.dialog();

        unveil();
    });
}