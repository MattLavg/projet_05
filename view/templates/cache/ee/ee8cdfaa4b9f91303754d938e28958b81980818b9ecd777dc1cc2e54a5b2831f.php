<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* back.twig */
class __TwigTemplate_d9cf388c4795b2b480d1dcf94aba4b59acb7c8b0d794f6301f836367aef057ab extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<!doctype html>
<html lang=\"fr\">
    <head>
        <meta charset=\"utf-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">

        ";
        // line 7
        $this->displayBlock('title', $context, $blocks);
        // line 8
        echo "
        <!-- Bootstrap core CSS -->
        <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css\" integrity=\"sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA\" crossorigin=\"anonymous\">

        <!-- JQUERY UI CSS -->
        <link href=\"";
        // line 13
        echo twig_escape_filter($this->env, ($context["ASSETS"] ?? null), "html", null, true);
        echo "css/jquery-ui.min.css\" rel=\"stylesheet\">
        <link href=\"";
        // line 14
        echo twig_escape_filter($this->env, ($context["ASSETS"] ?? null), "html", null, true);
        echo "css/jquery-ui.theme.min.css\" rel=\"stylesheet\">

        <!-- CSS -->
        <link href=\"";
        // line 17
        echo twig_escape_filter($this->env, ($context["ASSETS"] ?? null), "html", null, true);
        echo "css/style.css\" rel=\"stylesheet\">

        <!-- FONT AWESOME -->
        <link href=\"";
        // line 20
        echo twig_escape_filter($this->env, ($context["VENDOR"] ?? null), "html", null, true);
        echo "fontawesome/webfonts/all.css\" rel=\"stylesheet\">

        <!-- Google Fonts -->
        <link href=\"https://fonts.googleapis.com/css?family=Kanit:700&display=swap\" rel=\"stylesheet\">

        <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
        </style>
        
    </head>
    <body>
        <nav class=\"navbar navbar-expand-md navbar-dark fixed-top navbar-bg\">
            <a class=\"navbar-brand logo\" href=\"";
        // line 45
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "\">LISTaGAME</a>
            <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarsExampleDefault\" aria-controls=\"navbarsExampleDefault\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                <span class=\"navbar-toggler-icon\"></span>
            </button>

            <div class=\"collapse navbar-collapse\" id=\"navbarsExampleDefault\">
                <ul class=\"navbar-nav mr-auto\">
                    <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"";
        // line 53
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "\">Accueil</a>
                    </li>
                    <li class=\"nav-item dropdown\">
                        <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Administration</a>
                        <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
                            <a href=\"";
        // line 58
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "edit-game\" class=\"dropdown-item\">Ajouter un jeu</a>
                            <a href=\"";
        // line 59
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "game-management\" class=\"dropdown-item\">Gérer les jeux</a>
                            <a href=\"";
        // line 60
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "entity-management/entity/developer\" class=\"dropdown-item\">Gérer les développeurs</a>
                            <a href=\"";
        // line 61
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "entity-management/entity/publisher\" class=\"dropdown-item\">Gérer les éditeurs</a>
                            <a href=\"";
        // line 62
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "entity-management/entity/platform\" class=\"dropdown-item\">Gérer les supports</a>
                            <a href=\"";
        // line 63
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "entity-management/entity/genre\" class=\"dropdown-item\">Gérer les genres</a>
                            <a href=\"";
        // line 64
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "entity-management/entity/mode\" class=\"dropdown-item\">Gérer les modes</a>
                            <a href=\"";
        // line 65
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "entity-management/entity/region\" class=\"dropdown-item\">Gérer les régions</a>
                            <a href=\"";
        // line 66
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "reported-comments\" class=\"dropdown-item\">Modérer les commentaires</a>
                        </div>
                    </li>
                    <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"";
        // line 70
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "logout\">Déconnexion</a>
                    </li>   
                </ul>
                <form class=\"form-inline\">
                    <input class=\"form-control mr-sm-2\" type=\"search\" placeholder=\"Chercher un jeu...\" aria-label=\"Search\">
                    <button class=\"btn btn-outline-light my-2 my-sm-0\" type=\"submit\">Chercher</button>
                </form>
            </div>

            
        </nav>
    

        <main role=\"main\" class=\"mainContainer container-fluid\">

            <div class=\"container-fluid\">

                <div class=\"row\">

                    <div class=\"col-lg-4 leftMenu\">
                        <ul class=\"list-group\">
                            <a href=\"";
        // line 91
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "edit-game\"><li class=\"list-group-item\">Ajouter un jeu</li></a>
                            <a href=\"";
        // line 92
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "game-management\"><li class=\"list-group-item\">Gérer les jeux</li></a>
                            <a href=\"";
        // line 93
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "entity-management/entity/developer\"><li class=\"list-group-item\">Gérer les développeurs</li></a>
                            <a href=\"";
        // line 94
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "entity-management/entity/publisher\"><li class=\"list-group-item\">Gérer les éditeurs</li></a>
                            <a href=\"";
        // line 95
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "entity-management/entity/platform\"><li class=\"list-group-item\">Gérer les supports</li></a>
                            <a href=\"";
        // line 96
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "entity-management/entity/genre\"><li class=\"list-group-item\">Gérer les genres</li></a>
                            <a href=\"";
        // line 97
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "entity-management/entity/mode\"><li class=\"list-group-item\">Gérer les modes</li></a>
                            <a href=\"";
        // line 98
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "entity-management/entity/region\"><li class=\"list-group-item\">Gérer les régions</li></a>
                            <a href=\"";
        // line 99
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "reported-comments\"><li class=\"list-group-item\">Modérer les commentaires</li></a>
                        </ul>
                    </div>

                    <div class=\"col-lg-8\">

                        ";
        // line 105
        $this->displayBlock('content', $context, $blocks);
        // line 106
        echo "
                    </div>
                </div>
            </div>

            <!-- DELETE MODAL -->
            <div class=\"modal fade\" id=\"deleteModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"deleteModalLabel\" aria-hidden=\"true\">
                <div class=\"modal-dialog modal-dialog-centered\" role=\"document\">
                    <div class=\"modal-content\">
                        <div class=\"modal-header\">
                            <h5 class=\"modal-title\">Suppression</h5>
                            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                            </button>
                        </div>
                        <div class=\"modal-body\">
                            <p>Souhaitez-vous vraiment effacer <span class=\"modal-text\"></span> ?</p>
                        </div>
                        <div class=\"modal-footer\">
                            <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Annuler</button>
                            <button type=\"button\" class=\"btn btn-primary\" id=\"modalConfirmBtn\">Effacer</button>
                        </div>
                    </div>
                </div>
            </div>

            <footer class=\"container-fluid fixed-bottom d-flex justify-content-center align-items-center p-2 footer-bg\">
                <p><span class=\"text-light\">ListaGame - </span><a href=\"";
        // line 133
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "connection\">Connexion</a></p>
            </footer>

        </main><!-- /.container -->

    </body>

    <!-- JQUERY -->
    <script src=\"https://code.jquery.com/jquery-3.3.1.min.js\" integrity=\"sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=\" crossorigin=\"anonymous\"></script>

    <!-- JQUERY UI -->
    <script src=\"";
        // line 144
        echo twig_escape_filter($this->env, ($context["ASSETS"] ?? null), "html", null, true);
        echo "js/jquery-ui.min.js\"></script>
    <script src=\"";
        // line 145
        echo twig_escape_filter($this->env, ($context["ASSETS"] ?? null), "html", null, true);
        echo "js/datepickerFrench.js\"></script>

    <!-- BOOSTRAP JS -->
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js\" integrity=\"sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1\" crossorigin=\"anonymous\"></script>
    <script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js\" integrity=\"sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp\" crossorigin=\"anonymous\"></script>

    <!-- SCRIPTS JS -->
    <script src=\"";
        // line 152
        echo twig_escape_filter($this->env, ($context["ASSETS"] ?? null), "html", null, true);
        echo "js/script.js\"></script>

    <!-- TINYMCE -->
    <script src=\"";
        // line 155
        echo twig_escape_filter($this->env, ($context["VENDOR"] ?? null), "html", null, true);
        echo "tinymce/js/tinymce/tinymce.min.js\"></script>
    <script type=\"text/javascript\">
        tinymce.init({
            selector: '#tinymcetextarea',  // change this value according to your HTML
            plugins: [
                'advlist autolink autoresize link image lists charmap print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'save table directionality emoticons template paste'
            ],
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
            });
    </script>

    

</html>


";
    }

    // line 7
    public function block_title($context, array $blocks = [])
    {
    }

    // line 105
    public function block_content($context, array $blocks = [])
    {
    }

    public function getTemplateName()
    {
        return "back.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  314 => 105,  309 => 7,  286 => 155,  280 => 152,  270 => 145,  266 => 144,  252 => 133,  223 => 106,  221 => 105,  212 => 99,  208 => 98,  204 => 97,  200 => 96,  196 => 95,  192 => 94,  188 => 93,  184 => 92,  180 => 91,  156 => 70,  149 => 66,  145 => 65,  141 => 64,  137 => 63,  133 => 62,  129 => 61,  125 => 60,  121 => 59,  117 => 58,  109 => 53,  98 => 45,  70 => 20,  64 => 17,  58 => 14,  54 => 13,  47 => 8,  45 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!doctype html>
<html lang=\"fr\">
    <head>
        <meta charset=\"utf-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">

        {% block title %}{% endblock %}

        <!-- Bootstrap core CSS -->
        <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css\" integrity=\"sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA\" crossorigin=\"anonymous\">

        <!-- JQUERY UI CSS -->
        <link href=\"{{ ASSETS }}css/jquery-ui.min.css\" rel=\"stylesheet\">
        <link href=\"{{ ASSETS }}css/jquery-ui.theme.min.css\" rel=\"stylesheet\">

        <!-- CSS -->
        <link href=\"{{ ASSETS }}css/style.css\" rel=\"stylesheet\">

        <!-- FONT AWESOME -->
        <link href=\"{{ VENDOR }}fontawesome/webfonts/all.css\" rel=\"stylesheet\">

        <!-- Google Fonts -->
        <link href=\"https://fonts.googleapis.com/css?family=Kanit:700&display=swap\" rel=\"stylesheet\">

        <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
        </style>
        
    </head>
    <body>
        <nav class=\"navbar navbar-expand-md navbar-dark fixed-top navbar-bg\">
            <a class=\"navbar-brand logo\" href=\"{{ HOST }}\">LISTaGAME</a>
            <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarsExampleDefault\" aria-controls=\"navbarsExampleDefault\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                <span class=\"navbar-toggler-icon\"></span>
            </button>

            <div class=\"collapse navbar-collapse\" id=\"navbarsExampleDefault\">
                <ul class=\"navbar-nav mr-auto\">
                    <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"{{ HOST }}\">Accueil</a>
                    </li>
                    <li class=\"nav-item dropdown\">
                        <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Administration</a>
                        <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
                            <a href=\"{{ HOST }}edit-game\" class=\"dropdown-item\">Ajouter un jeu</a>
                            <a href=\"{{ HOST }}game-management\" class=\"dropdown-item\">Gérer les jeux</a>
                            <a href=\"{{ HOST }}entity-management/entity/developer\" class=\"dropdown-item\">Gérer les développeurs</a>
                            <a href=\"{{ HOST }}entity-management/entity/publisher\" class=\"dropdown-item\">Gérer les éditeurs</a>
                            <a href=\"{{ HOST }}entity-management/entity/platform\" class=\"dropdown-item\">Gérer les supports</a>
                            <a href=\"{{ HOST }}entity-management/entity/genre\" class=\"dropdown-item\">Gérer les genres</a>
                            <a href=\"{{ HOST }}entity-management/entity/mode\" class=\"dropdown-item\">Gérer les modes</a>
                            <a href=\"{{ HOST }}entity-management/entity/region\" class=\"dropdown-item\">Gérer les régions</a>
                            <a href=\"{{ HOST }}reported-comments\" class=\"dropdown-item\">Modérer les commentaires</a>
                        </div>
                    </li>
                    <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"{{ HOST }}logout\">Déconnexion</a>
                    </li>   
                </ul>
                <form class=\"form-inline\">
                    <input class=\"form-control mr-sm-2\" type=\"search\" placeholder=\"Chercher un jeu...\" aria-label=\"Search\">
                    <button class=\"btn btn-outline-light my-2 my-sm-0\" type=\"submit\">Chercher</button>
                </form>
            </div>

            
        </nav>
    

        <main role=\"main\" class=\"mainContainer container-fluid\">

            <div class=\"container-fluid\">

                <div class=\"row\">

                    <div class=\"col-lg-4 leftMenu\">
                        <ul class=\"list-group\">
                            <a href=\"{{ HOST }}edit-game\"><li class=\"list-group-item\">Ajouter un jeu</li></a>
                            <a href=\"{{ HOST }}game-management\"><li class=\"list-group-item\">Gérer les jeux</li></a>
                            <a href=\"{{ HOST }}entity-management/entity/developer\"><li class=\"list-group-item\">Gérer les développeurs</li></a>
                            <a href=\"{{ HOST }}entity-management/entity/publisher\"><li class=\"list-group-item\">Gérer les éditeurs</li></a>
                            <a href=\"{{ HOST }}entity-management/entity/platform\"><li class=\"list-group-item\">Gérer les supports</li></a>
                            <a href=\"{{ HOST }}entity-management/entity/genre\"><li class=\"list-group-item\">Gérer les genres</li></a>
                            <a href=\"{{ HOST }}entity-management/entity/mode\"><li class=\"list-group-item\">Gérer les modes</li></a>
                            <a href=\"{{ HOST }}entity-management/entity/region\"><li class=\"list-group-item\">Gérer les régions</li></a>
                            <a href=\"{{ HOST }}reported-comments\"><li class=\"list-group-item\">Modérer les commentaires</li></a>
                        </ul>
                    </div>

                    <div class=\"col-lg-8\">

                        {% block content %}{% endblock %}

                    </div>
                </div>
            </div>

            <!-- DELETE MODAL -->
            <div class=\"modal fade\" id=\"deleteModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"deleteModalLabel\" aria-hidden=\"true\">
                <div class=\"modal-dialog modal-dialog-centered\" role=\"document\">
                    <div class=\"modal-content\">
                        <div class=\"modal-header\">
                            <h5 class=\"modal-title\">Suppression</h5>
                            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                            </button>
                        </div>
                        <div class=\"modal-body\">
                            <p>Souhaitez-vous vraiment effacer <span class=\"modal-text\"></span> ?</p>
                        </div>
                        <div class=\"modal-footer\">
                            <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Annuler</button>
                            <button type=\"button\" class=\"btn btn-primary\" id=\"modalConfirmBtn\">Effacer</button>
                        </div>
                    </div>
                </div>
            </div>

            <footer class=\"container-fluid fixed-bottom d-flex justify-content-center align-items-center p-2 footer-bg\">
                <p><span class=\"text-light\">ListaGame - </span><a href=\"{{ HOST }}connection\">Connexion</a></p>
            </footer>

        </main><!-- /.container -->

    </body>

    <!-- JQUERY -->
    <script src=\"https://code.jquery.com/jquery-3.3.1.min.js\" integrity=\"sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=\" crossorigin=\"anonymous\"></script>

    <!-- JQUERY UI -->
    <script src=\"{{ ASSETS }}js/jquery-ui.min.js\"></script>
    <script src=\"{{ ASSETS }}js/datepickerFrench.js\"></script>

    <!-- BOOSTRAP JS -->
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js\" integrity=\"sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1\" crossorigin=\"anonymous\"></script>
    <script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js\" integrity=\"sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp\" crossorigin=\"anonymous\"></script>

    <!-- SCRIPTS JS -->
    <script src=\"{{ ASSETS }}js/script.js\"></script>

    <!-- TINYMCE -->
    <script src=\"{{ VENDOR }}tinymce/js/tinymce/tinymce.min.js\"></script>
    <script type=\"text/javascript\">
        tinymce.init({
            selector: '#tinymcetextarea',  // change this value according to your HTML
            plugins: [
                'advlist autolink autoresize link image lists charmap print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'save table directionality emoticons template paste'
            ],
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
            });
    </script>

    

</html>


", "back.twig", "/Users/mathias/Sites/projet_05/view/templates/back.twig");
    }
}
