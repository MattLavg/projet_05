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
        url = $(this).attr('data-url');        
        
        $.post(
            url,
            {
                name : $('#entity').val()
            },
            function(data){
                console.log(data.success, data.content, data);
                if(data.success){
                    // Le membre est connecté. Ajoutons lui un message dans la page HTML.
                    // $("#resultat").html("<p>Vous avez été connecté avec succès !</p>");

                    var ligne = '<tr>' +
                                '<td>' + data.name + '</td>'+
                                '<td><a href="' + data.urlUpdateEntity + '" id="updateEntity">Modifier</a></td>'+
                                '<td><a href="' + data.urlDeleteEntity + '">Supprimer</a></td>' + 
                                '</tr>';

                    $('#table-dev table tbody').prepend(ligne);
                    $('#entity').val('');
               }
               else{
                    // Le membre n'a pas été connecté. (data vaut ici "failed")
                    $("#resultat").html("<p>Erreur lors de la connexion...</p>");
               }
            },
            'json'
        );
    });


    // UPDATE ENTITY AJAX
    $('#updateEntity').click(function(e) {
        e.preventDefault();
        var value = $('#entityName').html();
        var dataUrl = $(this).attr('href');
 
        var inlineForm = '<form class="form-inline">' +
                         '<div class="form-group mx-sm-3 mb-2">' +
                         '<input type="text" class="form-control" id="updateEntityInput" placeholder="' + value + '">' +
                         '</div>' +
                         '<button type="submit" id="validUpdateEntity" class="btn btn-primary mb-2" ' + 
                         'data-url="' + dataUrl + '">Ajouter</button>' +
                         '</form>';

        $('#entityName').html(inlineForm);
        
        $('#validUpdateEntity').click(function(e) {
            e.preventDefault();
            url = $(this).attr('data-url'); 
            
            $.post(
                url,
                {
                    name : $('#entityName input').val()
                },
                function(data){
                    console.log(data.success, data.content, data);
                    if(data.success){
                        // Le membre est connecté. Ajoutons lui un message dans la page HTML.
                        // $("#resultat").html("<p>Vous avez été connecté avec succès !</p>");
    
                        $('#entityName').html(data.name);
                        $('#entityDeleteBtn').attr('data-entity-name', data.name);
                   }
                   else{
                        // Le membre n'a pas été connecté. (data vaut ici "failed")
                        $("#resultat").html("<p>Erreur lors de la connexion...</p>");
                   }
                },
                'json'
            );
        });
    });


    // DELETE ENTITY AJAX
    $('#modalConfirmBtn').click(function(e) {
        url = $(this).data('url');  
        entityId = $(this).data('entity-id'); 
        console.log(entityId);
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
    });


});
