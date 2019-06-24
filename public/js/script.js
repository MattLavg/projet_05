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






    // put the delete entity in variable
    var deleteEntityList = function(e) {
        e.preventDefault();
        $(this).parent().remove();
    };

    // ADD and DELETE DEVELOPER INPUT IN FORM GAME EDIT
    var nbList = 0;
    // var nbDatepicker = 1;

    $('.addEntityForm').click(function(e) {
        nbList++;

        // get the bloc where list of entities are duplicated
        var blocEntityList = $(this).parent().find('.entity-group-game-edit');
        // clone the entity list
        $(this).parent().find('.bloc-entity-game-edit:first').clone().appendTo(blocEntityList);
        // display cross
        $(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel').css('display', 'block');
        // apply the delete function to the new cross icon
        $(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel').click(deleteEntityList);
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

    // ADD and DELETE entities on game edit
    $('.addEntityFormGameEdit').click(function(e) {
        nbList++;

        // get the bloc where list of entities are duplicated
        var blocEntityList = $(this).parent().find('.entity-group-game-edit');
        // clone the entity list
        $(this).parent().find('.bloc-entity-game-edit:first').clone().appendTo(blocEntityList);
        // display cross
        $(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel').css('display', 'block');
        // apply the delete function to the new cross icon
        $(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel').click(deleteEntityList);
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


    $( ".date" ).datepicker( 
        $.extend({ 
            altFormat: 'yy-mm-dd',
            altField: '#altDatepicker0'
         },
        $.datepicker.regional[ "fr" ])
    );

    //   $( '.date' ).datepicker( 'option', 'altFormat', 'yy-mm-dd' );

    $('#addReleaseDateForm').click(function(e) {
        nbList++;
        // nbDatepicker++;

        // get the bloc where list of entities are duplicated
        var blocEntityList = $(this).parent().find('.entity-group-game-edit');
        // clone the entity list
        $(this).parent().find('.bloc-entity-game-edit:first').clone().appendTo(blocEntityList);
        // display the first cross
        $(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel-release').css('display', 'block');
        // apply the delete function to the new cross icon
        $(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel-release').click(deleteEntityList);
        // add a background color, border-radius and padding
        $(this).parent().find('.bloc-entity-game-edit:last').css({'background-color': '#F2F2F2', 'border-radius': '10px', 'padding': '10px'});
        // add the padding class
        $(this).parent().find('.bloc-entity-game-edit:last').addClass('pl-5');

        $(this).parent().find('.bloc-entity-game-edit:last').find('.platformList').attr('name', 'releaseDate[' + nbList + '][platform]');
        $(this).parent().find('.bloc-entity-game-edit:last').find('.publisherList').attr('name', 'releaseDate[' + nbList + '][publisher]');
        $(this).parent().find('.bloc-entity-game-edit:last').find('.regionList').attr('name', 'releaseDate[' + nbList + '][region]');


        // $(this).parent().find('.bloc-entity-game-edit:last').find('.date').removeAttr('id');
        $(this).parent().find('.bloc-entity-game-edit:last').find('.date').removeData('datepicker');
        $(this).parent().find('.bloc-entity-game-edit:last').find('.date').removeClass('hasDatepicker');

        $(this).parent().find('.bloc-entity-game-edit:last').find('.date').attr('id', 'datepicker' + nbList);
        $(this).parent().find('.bloc-entity-game-edit:last').find('.altDate').attr('name', 'releaseDate[' + nbList + '][date]');
        

        $(this).parent().find('.bloc-entity-game-edit:last').find('.date').datepicker($.extend({ 
            altFormat: 'yy-mm-dd',
            altField: '#altDatepicker' + nbList
         },
        $.datepicker.regional[ "fr" ]));

        $(this).parent().find('.bloc-entity-game-edit:last').find('.altDate').attr('id', 'altDatepicker' + nbList);
// console.log($(this).parent().find('.bloc-entity-game-edit:last').find('.date'));
        // $('#table-dev tbody tr:first .updateEntity').click(updateAction);
    });
    
    
    // DELETE DEVELOPER INPUT 
    // $('.cross-cancel').click();


    // /* French initialisation for the jQuery UI date picker plugin. */
    // /* Written by Keith Wood (kbwood{at}iinet.com.au),
    //             Stéphane Nahmani (sholby@sholby.net),
    //             Stéphane Raimbault <stephane.raimbault@gmail.com> */
    // ( function( factory ) {
    //     if ( typeof define === "function" && define.amd ) {

    //         // AMD. Register as an anonymous module.
    //         define( [ "../widgets/datepicker" ], factory );
    //     } else {

    //         // Browser globals
    //         factory( jQuery.datepicker );
    //     }
    // }( function( datepicker ) {

    // datepicker.regional.fr = {
    //     closeText: "Fermer",
    //     prevText: "Précédent",
    //     nextText: "Suivant",
    //     currentText: "Aujourd'hui",
    //     monthNames: [ "janvier", "février", "mars", "avril", "mai", "juin",
    //         "juillet", "août", "septembre", "octobre", "novembre", "décembre" ],
    //     monthNamesShort: [ "janv.", "févr.", "mars", "avr.", "mai", "juin",
    //         "juil.", "août", "sept.", "oct.", "nov.", "déc." ],
    //     dayNames: [ "dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi" ],
    //     dayNamesShort: [ "dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam." ],
    //     dayNamesMin: [ "D","L","M","M","J","V","S" ],
    //     weekHeader: "Sem.",
    //     dateFormat: "dd/mm/yy",
    //     firstDay: 1,
    //     isRTL: false,
    //     showMonthAfterYear: false,
    //     yearSuffix: "" };
    // datepicker.setDefaults( datepicker.regional.fr );

    // return datepicker.regional.fr;

    // } ) );

});
