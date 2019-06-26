$(document).ready(function () {

    // BOOTSTRAP MODAL
    $('#deleteModal').on('shown.bs.modal', function (e) {

        var button = $(e.relatedTarget); // Button that triggered the modal
        var urlDeleteGame = button.data('url-delete-game'); // Extract info from data-* attributes
        var gameName = button.data('game-name');
 
        var modal = $(this);

        if (gameName) {
            modal.find('.modal-text').text('le jeu : ' + gameName);
            modal.find('#modalConfirmBtn').parent().attr('href', urlDeleteGame);
        } 

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



    // On update (game-edit) page with informations already set
    // get the first element and do not display delete cross
    $('.entity-group-game-edit').find('.bloc-entity-game-edit:first').find('.cross-cancel-game-update').css('display', 'none');
    $('.entity-group-game-edit').find('.bloc-entity-game-edit:first').removeClass('pl-5');

    $('.entity-group-game-edit').find('.bloc-entity-game-edit:first').find('.cross-cancel-release-game-update').css('display', 'none');
    $('.entity-group-game-edit').find('.bloc-entity-game-edit:first').removeClass('background-release-game-update');



    // put the delete entity list in variable
    var deleteEntityList = function(e) {
        e.preventDefault();
        $(this).parent().remove();
    };

    // DELETE DEVELOPER INPUT 
    $('.cross-cancel-game-update').click(deleteEntityList);

    // ADD and DELETE entity list INPUT IN FORM GAME EDIT
    var nbList = 0;
    // var nbDatepicker = 1;

    $('.addEntityForm').click(function(e) {
        nbList++;

        // get the bloc where list of entities are duplicated
        var blocEntityList = $(this).parent().find('.entity-group-game-edit');

        // clone the entity list
        $(this).parent().find('.bloc-entity-game-edit:first').clone().appendTo(blocEntityList);

        // if cross with cross-cancel-game-update class exists
        if ($(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel-game-update')) {
            // console.log('pliiiiip');
            $(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel-game-update').css('display', 'block');
            // apply the delete function to the new cross icon on form game update
            $(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel-game-update').click(deleteEntityList);

        } 
        
        // if cross with cross-cancel class exists
        if ($(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel')) {
// console.log('plop');
            // display cross
            $(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel').css('display', 'block');
            // apply the delete function to the new cross icon
            $(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel').click(deleteEntityList);

        }
 
        // add the padding class
        $(this).parent().find('.bloc-entity-game-edit:last').addClass('pl-5');

        if ($(this).parent().find('select:last').hasClass('developerList')) {

            $(this).parent().find('select:last').attr('name', 'developer[' + nbList + ']');

        } else if ($(this).parent().find('select:last').hasClass('genreList')) {

            $(this).parent().find('select:last').attr('name', 'genre[' + nbList + ']');

        } else if ($(this).parent().find('select:last').hasClass('modeList')) {

            $(this).parent().find('select:last').attr('name', 'mode[' + nbList + ']');

        }
    });

    // $( ".date" ).datepicker( $.datepicker.regional[ "fr" ] );


    // $( ".date" ).datepicker( 
    //     $.extend({ 
    //         changeMonth: true,
    //         changeYear: true,
    //         showButtonPanel: true,
    //         yearRange: "1980:c+2", // c is current selected year
    //         altFormat: 'yy-mm-dd',
    //         altField: $('.date').next()
    //      },
    //     $.datepicker.regional[ "fr" ])
    // );

    // function modifyDatepickerUpdateGame() {
    //     nbList++;

    //     $('.datpicker-update-game').removeData('datepicker');
    //     $('.datpicker-update-game').removeClass('hasDatepicker');

    //     $('.datpicker-update-game').attr('id', 'datepicker-update-game' + nbList);
    //     $('.datpicker-update-game').next().attr('id', 'altDatepicker-update-game' + nbList);
    //     $('.datpicker-update-game').datepicker($.extend({ 
    //         altFormat: 'yy-mm-dd',
    //         altField: '#altDatepicker-update-game' + nbList
    //      },
    //     $.datepicker.regional[ "fr" ]));
    // }

//     $('.datpicker-update-game').each(function(i) {
//         var count = i;
// console.log(i);
//         $('.datpicker-update-game').removeClass('hasDatepicker');
//         console.log('je compte');
//         $('.datpicker-update-game').attr('id', 'datepicker-update-game' + count);
//         // $('.datpicker-update-game').next().attr('id', 'altDatepicker-update-game' + nbList);
//         $('.datpicker-update-game').datepicker($.extend({ 
//             altFormat: 'yy-mm-dd',
//             altField: $('.datpicker-update-game').next()
//          },
//         $.datepicker.regional[ "fr" ]));
//       });
    // var nbDatepickerUpdategame = $('.datpicker-update-game').length;
    // for (var i = 0; i < nbDatepickerUpdategame; i++) {

    // }

    $('.date').each(function(index) {
        nbList++;

        $(this).datepicker($.extend({ 
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            yearRange: "1980:2023", // c is current selected year
            altFormat: 'yy-mm-dd',
            altField: $(this).next()
        },
        $.datepicker.regional[ "fr" ]));

        $(this).datepicker('option', 'altField', $(this).next());

        // apply the delete function to the cross icon available
        $(this).parent().find('.cross-cancel-release-game-update').click(deleteEntityList);

        if ($(this).parent().find('.platformList')) {
            $(this).parent().find('.platformList').attr('name', 'releaseDate[' + nbList + '][platform]');
        }

        if ($(this).parent().find('.publisherList')) {
            $(this).parent().find('.publisherList').attr('name', 'releaseDate[' + nbList + '][publisher]');
        }

        if ($(this).parent().find('.regionList')) {
            $(this).parent().find('.regionList').attr('name', 'releaseDate[' + nbList + '][region]');
        }

        if ($(this).parent().find('.altDate')) {
            $(this).parent().find('.altDate').attr('name', 'releaseDate[' + nbList + '][date]');
        }

    });



    //   $('.datpicker-update-game').removeClass('hasDatepicker');
    //   $('.datpicker-update-game').datepicker($.extend({ 
    //     altFormat: 'yy-mm-dd',
    //     altField: $('.datpicker-update-game').next()
    //  },
    // $.datepicker.regional[ "fr" ]));

    //   $( '.date' ).datepicker( 'option', 'altFormat', 'yy-mm-dd' );

    $('#addReleaseDateForm').click(function(e) {
        nbList++;
        // nbDatepicker++;

        // get the bloc where list of entities are duplicated
        var blocEntityList = $(this).parent().find('.entity-group-game-edit');
        // clone the entity list
        $(this).parent().find('.bloc-entity-game-edit:first').clone().appendTo(blocEntityList);

        // if delete cross 
        if ($(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel-release')) {
            // display the first cross
            $(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel-release').css('display', 'block');
            // apply the delete function to the new cross icon
            $(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel-release').click(deleteEntityList);
        }

        // iff delete cross on update page
        if ($(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel-release-game-update')) {
            // display the first cross
            $(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel-release-game-update').css('display', 'block');
            // apply the delete function to the new cross icon
            $(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel-release-game-update').click(deleteEntityList);
        }

        
        // add a background color, border-radius and padding
        $(this).parent().find('.bloc-entity-game-edit:last').css({'background-color': '#F2F2F2', 'border-radius': '10px', 'padding': '10px'});
        // add the padding class
        $(this).parent().find('.bloc-entity-game-edit:last').addClass('pl-5');

        $(this).parent().find('.bloc-entity-game-edit:last').find('.platformList').attr('name', 'releaseDate[' + nbList + '][platform]');
        $(this).parent().find('.bloc-entity-game-edit:last').find('.publisherList').attr('name', 'releaseDate[' + nbList + '][publisher]');
        $(this).parent().find('.bloc-entity-game-edit:last').find('.regionList').attr('name', 'releaseDate[' + nbList + '][region]');

        $(this).parent().find('.bloc-entity-game-edit:last').find('.date').removeAttr('id');
        $(this).parent().find('.bloc-entity-game-edit:last').find('.date').removeClass('hasDatepicker');

        // $(this).parent().find('.bloc-entity-game-edit:last').find('.date').attr('id', 'datepicker' + nbList);
        $(this).parent().find('.bloc-entity-game-edit:last').find('.altDate').attr('name', 'releaseDate[' + nbList + '][date]');
        

        // $(this).parent().find('.bloc-entity-game-edit:last').find('.date').datepicker($.extend({ 
        //     altFormat: 'yy-mm-dd',
        //     altField: '#altDatepicker' + nbList
        //  },
        // $.datepicker.regional[ "fr" ]));
// console.log($(this).parent().find('.bloc-entity-game-edit:last').find('.date'));
// console.log($(this).parent().find('.bloc-entity-game-edit:last').find('.date').next());

        $(this).parent().find('.bloc-entity-game-edit:last').find('.date').datepicker($.extend({ 
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            yearRange: "1980:2023", // c is current selected year
            altFormat: 'yy-mm-dd',
            altField: $(this).parent().find('.bloc-entity-game-edit:last').find('.date').next()
         },
        $.datepicker.regional[ "fr" ]));

        // $(this).parent().find('.bloc-entity-game-edit:last').find('.altDate').attr('id', 'altDatepicker' + nbList);

    });
    
    
    


});
