$(document).ready(function () {

    // BOOTSTRAP MODAL
    $('#deleteModal').on('shown.bs.modal', function (e) {

        var button = $(e.relatedTarget); // Button that triggered the modal
        var url = button.data('url'); // Extract info from data-* attributes
        var entityName = button.data('entity-name');
        var entityId = button.data('entity-id');
        var currentEntity = button.data('entity');
 
        var modal = $(this);

        if (currentEntity) {
            modal.find('.modal-text').text('le ' + currentEntity + ' : ' + entityName);
            modal.find('#modalConfirmBtn').attr('data-entity-id', entityId);
        } 

        modal.find('#modalConfirmBtn').attr('data-url', url);
    })

    // ADD ENTITY AJAX
    $('#addEntity').click(function(e) {
        e.preventDefault();
        // get url to add entity 
        url = $(this).attr('data-url');        
        
        $.post(
            url,
            {
                name : $('#addEntityInput').val() // get value of input
            },
            function(data){
                console.log(data.success, data.content, data);
                if(data.success){
                    // Le membre est connecté. Ajoutons lui un message dans la page HTML.
                    // $("#resultat").html("<p>Vous avez été connecté avec succès !</p>");

                    // create a row
                    var ligne = '<tr>' +
                                '<td class="entityName">' + data.name + '</td>'+
                                '<td><a href="' + data.urlUpdateEntity + '" class="updateEntity">Modifier</a></td>'+
                                '<td><a href="' + data.urlDeleteEntity + '">Supprimer</a></td>' + 
                                '</tr>';

                    // add the row in the body's table
                    $('#table-dev table tbody').prepend(ligne);

                    // allows to give the action for the new link "modifier"
                    $('#table-dev tbody tr:first .updateEntity').click(updateAction);

                    // remove the value in the input
                    $('#addEntityInput').val('');
               }
               else{
                    // Le membre n'a pas été connecté. (data vaut ici "failed")
                    $("#resultat").html("<p>Erreur lors de la connexion...</p>");
               }
            },
            'json'
        );
    });

    // put the update action in variable
    var updateAction = function(e) {
        e.preventDefault();
        // get the name of the entity on the row
        var value = $(this).parent().parent().find('.entityName').html();

        // get the update entity url
        var dataUrl = $(this).attr('href');
 
        var inlineForm = '<form class="form-inline updateEntityForm">' +
                         '<div class="form-group mx-sm-3 mb-2">' +
                         '<input type="text" class="form-control" class="updateEntityInput" placeholder="' + value + '">' +
                         '</div>' +
                         '<button type="submit" class="validUpdateEntity" class="btn btn-primary mb-2" ' + 
                         'data-url="' + dataUrl + '">Ajouter</button>' +
                         '</form>';

        // add the inline form 
        $(this).parent().parent().find('.entityName').html(inlineForm);

        // get the form button "add" of the row
        var addBtn = $(this).parent().parent().find('.validUpdateEntity');

        $(addBtn).click(function(e) {
            e.preventDefault();

            // get the update entity url
            url = $(this).attr('data-url'); 
            
            $.post(
                url,
                {
                    name : $(this).parent().find('input').val() // get value of input
                },
                function(data){
                    console.log(data.success, data.content, data);
                    if(data.success){
                        // Le membre est connecté. Ajoutons lui un message dans la page HTML.
                        // $("#resultat").html("<p>Vous avez été connecté avec succès !</p>");
    
                        // add the modified name in the td
                        $(addBtn).parent().parent().prepend(data.name);
        
                        // remove the add form
                        $(addBtn).parent().remove();
                        // $(this).parent().parent().find('.entityDeleteBtn').data('entity-name', data.name);
                   }
                   else{
                        // Le membre n'a pas été connecté. (data vaut ici "failed")
                        $("#resultat").html("<p>Erreur lors de la connexion...</p>");
                   }
                },
                'json'
            );
        });
    };

    // UPDATE ENTITY AJAX
    $('.updateEntity').click(updateAction);

    // put the delete action in variable
    var deleteAction = function(e) {

        // get the delete entity url
        url = $(this).data('url'); 
        console.log(url); 
        // entityId = $(this).data('entity-id'); 
        // console.log(entityId);
        $.post(
            url,
            function(data){
                console.log(data.success, data.content, data);
                if(data.success){
                    // Le membre est connecté. Ajoutons lui un message dans la page HTML.
                    // $("#resultat").html("<p>Vous avez été connecté avec succès !</p>");

                    $('tr#' + entityId).remove();
                    $('#deleteModal').modal('toggle');

               }
               else{
                    // Le membre n'a pas été connecté. (data vaut ici "failed")
                    $("#resultat").html("<p>Erreur lors de la connexion...</p>");
               }
            },
            'json'
        );
    };

    // DELETE ENTITY AJAX
    $('#modalConfirmBtn').click(deleteAction);

    // ADD DEVELOPER INPUT IN FORM
    $('#addDeveloperForm').click(function(e) {
        var select = $('<select>');
        select.addClass('form-control developerList mt-2');
        
        var developerList = select + '% for developer in developers %}'+
                            '<option id="developer{{ developer.getId }}">'+
                            '{{ developer.getName }}</option>{% endfor %}'+
                            '</select>';

        // select.appendTo('#developer-group');
        $(select).appendTo('#developer-group');

    });


});
