$(document).ready(function () {

    // BOOTSTRAP MODAL
    $('#deleteModal').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var author = button.data('author'); // Extract info from data-* attributes
        var title = button.data('title');
        var url = button.data('url');

        var modal = $(this);

        if (author) {
            modal.find('.modal-text').text('le commentaire de ' + author);
        } else {
            modal.find('.modal-text').text('l\'article ' + title);
        }

        modal.find('#modalConfirmBtn').attr('href', url);
    })

    // LOGIN AJAX
    $('#login').click(function(e) {
        e.preventDefault();
        url = $(this).attr('data-url');
        console.log(url);
        $.post(
            url,
            {
                mail : $('#identificationEmail').val(),
                password : $('#identificationPassword').val()
            },
            function(data){
                console.log(data);
                if(data == 'Success'){
                    // Le membre est connecté. Ajoutons lui un message dans la page HTML.

                    $("#resultat").html("<p>Vous avez été connecté avec succès !</p>");
               }
               else{
                    // Le membre n'a pas été connecté. (data vaut ici "failed")

                    $("#resultat").html("<p>Erreur lors de la connexion...</p>");
               }
            },
            'text'
        );
    });

});
