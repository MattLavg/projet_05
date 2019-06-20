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
                if(data.success){
                    // Success
                    // $("#resultat").html("<p>Un élément a été ajouté.</p>");

                    // create a row
                    var ligne = '<tr>' +
                                '<td class="entityName">' + data.name + '</td>'+
                                '<td><a href="' + data.urlUpdateEntity + '" class="updateEntity">Modifier</a></td>'+
                                '<td><a href="' + data.urlDeleteEntity + '" class="deleteEntity">Supprimer</a></td>' + 
                                '</tr>';

                    // add the row in the body's table
                    $('#table-dev table tbody').prepend(ligne);

                    // allows to give the action for the new create link "modifier"
                    $('#table-dev tbody tr:first .updateEntity').click(updateAction);

                    // allows to give the action for the new created link "supprimer"
                    $('#table-dev tbody tr:first .deleteEntity').click(deleteAction);

                    // remove the value in the input
                    $('#addEntityInput').val('');
               }
               else{
                    // Failed
                    $("#resultat").html("<p>Impossible d'ajouter un élément.</p>");
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
 
        var inlineForm = '<form class="form-inline">' +
                         '<div class="form-group mx-sm-3 mb-2">' +
                         '<input type="text" class="form-control" class="updateEntityInput" value="' + value + '">' +
                         '</div>' +
                         '<button type="submit" class="btn btn-primary mb-2 validUpdateEntity" ' + 
                         'data-url="' + dataUrl + '">Modifier</button>' +
                         '<button type="button" class="btn btn-secondary ml-1 mb-2 cancelUpdateEntity" data-default-value="' + value + '">Annuler</button>'+
                         '</form>';

        // add the inline form 
        $(this).parent().parent().find('.entityName').html(inlineForm);

        // get the form button "modifier" of the row
        var updateBtn = $(this).parent().parent().find('.validUpdateEntity');

        // get the form button "annuler" of the row
        var cancelBtn = $(updateBtn).parent().find('.cancelUpdateEntity');

        $(updateBtn).click(function(e) {
            e.preventDefault();

            // get the update entity url
            url = $(this).attr('data-url'); 
            
            $.post(
                url,
                {
                    name : $(this).parent().find('input').val() // get value of input
                },
                function(data){
                    if(data.success){
                        // Success
                        // $("#resultat").html("<p>Vous avez modifié l'élément.</p>");
    
                        // add the modified name in the td
                        $(updateBtn).parent().parent().prepend(data.name);
        
                        // remove the add form
                        $(updateBtn).parent().remove();
                   }
                   else{
                        // Failed
                        $("#resultat").html("<p>Impossible de modifier l'élément.</p>");
                   }
                },
                'json'
            );
        });

        $(cancelBtn).click(function(e) {

            // get the value of row'input
            var defaultValue = $(this).data('default-value');

            // put the original value in tr
            $(this).parent().parent().html(defaultValue);

            // remove the add form
            $(this).parent().remove();
        });
    };

    // UPDATE ENTITY AJAX
    $('.updateEntity').click(updateAction);

    // put the delete action in variable
    var deleteAction = function(e) {
        e.preventDefault();
        // get the delete entity url
        url = $(this).attr('href'); 

        var deleteBtn = $(this);
        
        $.post(
            url,
            function(data){
                if(data.success){
                    // Success
                    // $("#resultat").html("<p>Vous avez supprimé l'élément.</p>");

                    $(deleteBtn).parent().parent().remove();
               }
               else{
                    // Failed
                    $("#resultat").html("<p>Impossible de supprimer l'élément.</p>");
               }
            },
            'json'
            );
    };

    // DELETE ENTITY AJAX
    $('.deleteEntity').click(deleteAction);



    // ADD and DELETE DEVELOPER INPUT IN FORM GAME EDIT
    var nbDeveloper = 1;
    // ADD DEVELOPER INPUT 
    $('#addDeveloperForm').click(function(e) {
        nbDeveloper++;
        $('.developerList:first').clone().appendTo('#developer-group-game-edit');
        $('.developerList:last').attr('name', 'developer' + nbDeveloper);
    });

    // DELETE DEVELOPER INPUT 
    $('#deleteDeveloperForm').click(function(e) {

        if (nbDeveloper > 1) {
            nbDeveloper--;
        }
        
        if ($('.developerList').length > 1) {
            $('.developerList:last').remove();
        }

    });



    // ADD and DELETE GENRE INPUT IN FORM GAME EDIT
    var nbGenre = 1;
    // ADD GENRE INPUT 
    $('#addGenreForm').click(function(e) {
        nbGenre++;
        $('.genreList:first').clone().appendTo('#genre-group-game-edit');
        $('.genreList:last').attr('name', 'genre' + nbGenre);

    });

    // DELETE GENRE INPUT 
    $('#deleteGenreForm').click(function(e) {

        if (nbGenre > 1) {
            nbGenre--;
        }

        if ($('.genreList').length > 1) {
            $('.genreList:last').remove();
        }

    });

    

    // ADD and DELETE GENRE INPUT IN FORM GAME EDIT
    var nbMode = 1;
    // ADD MODE INPUT IN FORM GAME EDIT
    $('#addModeForm').click(function(e) {
        nbMode++;
        $('.modeList:first').clone().appendTo('#mode-group-game-edit');
        $('.modeList:last').attr('name', 'mode' + nbMode);
        

    });

    // DELETE MODE INPUT IN FORM GAME EDIT
    $('#deleteModeForm').click(function(e) {

        if (nbMode > 1) {
            nbMode--;
        }

        if ($('.modeList').length > 1) {
            $('.modeList:last').remove();
        }

    });


});
