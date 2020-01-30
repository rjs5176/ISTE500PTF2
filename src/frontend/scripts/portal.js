function loadBulletins()
{
    let bulletins = document.querySelector('#bulletin-list');

    apiRequest('GET', 'currentUser/bulletins', {}).done(function(json){
        if(json.code === 200)
        {
            $.each(json.data, function(i, v){
                let bulletin = document.createElement('div');

                let title = document.createElement('h2');
                title.appendChild(document.createTextNode(v.title));
                bulletin.appendChild(title);

                let message = document.createElement('div');
                message.appendChild(document.createTextNode(v.message));
                bulletin.appendChild(message);

                bulletin.classList.add('bulletin');
                bulletin.classList.add('bulletin-' + v.type);

                bulletins.appendChild(bulletin);
            });
        }
    });
}

$(document).ready(function(){
    if ($('#bulletin-list').length !== 0) {
        loadBulletins();
    }
});