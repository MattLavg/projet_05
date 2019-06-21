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

/* front.twig */
class __TwigTemplate_ff3bc88fb1563342fbcfbd72ef4059a68ee69e019acef32491551cd67dfb316c extends \Twig\Template
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

        <!-- CSS -->
        <link href=\"";
        // line 13
        echo twig_escape_filter($this->env, ($context["ASSETS"] ?? null), "html", null, true);
        echo "css/style.css\" rel=\"stylesheet\">

        <!-- FONT AWESOME -->
        <link href=\"";
        // line 16
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
        // line 41
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "\">LISTaGAME</a>
            <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarsExampleDefault\" aria-controls=\"navbarsExampleDefault\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                <span class=\"navbar-toggler-icon\"></span>
            </button>

            <div class=\"collapse navbar-collapse\" id=\"navbarsExampleDefault\">
                <ul class=\"navbar-nav mr-auto\">
                    <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"";
        // line 49
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "\">Accueil</a>
                    </li>
        
                    ";
        // line 52
        if (($context["connected"] ?? null)) {
            // line 53
            echo "                        <li class=\"nav-item dropdown\">
                            <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Administration</a>
                            <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
                                <a href=\"";
            // line 56
            echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
            echo "edit-game\" class=\"dropdown-item\">Ajouter un jeu</a>
                                <a href=\"";
            // line 57
            echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
            echo "game-management\" class=\"dropdown-item\">Gérer les jeux</a>
                                <a href=\"";
            // line 58
            echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
            echo "entity-management/entity/developer\" class=\"dropdown-item\">Gérer les développeurs</a>
                                <a href=\"";
            // line 59
            echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
            echo "entity-management/entity/publisher\" class=\"dropdown-item\">Gérer les éditeurs</a>
                                <a href=\"";
            // line 60
            echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
            echo "entity-management/entity/platform\" class=\"dropdown-item\">Gérer les supports</a>
                                <a href=\"";
            // line 61
            echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
            echo "entity-management/entity/genre\" class=\"dropdown-item\">Gérer les genres</a>
                                <a href=\"";
            // line 62
            echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
            echo "entity-management/entity/mode\" class=\"dropdown-item\">Gérer les modes</a>
                                <a href=\"";
            // line 63
            echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
            echo "entity-management/entity/region\" class=\"dropdown-item\">Gérer les régions</a>
                                <a href=\"";
            // line 64
            echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
            echo "reported-comments\" class=\"dropdown-item\">Modérer les commentaires</a>
                            </div>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"";
            // line 68
            echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
            echo "logout\">Déconnexion</a>
                        </li>
                    ";
        } else {
            // line 71
            echo "                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"";
            // line 72
            echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
            echo "connection\">Connexion</a>
                        </li>
                    ";
        }
        // line 75
        echo "                    
                </ul>
                <form class=\"form-inline\">
                    <input class=\"form-control mr-sm-2\" type=\"search\" placeholder=\"Chercher un jeu...\" aria-label=\"Search\">
                    <button class=\"btn btn-outline-light my-2 my-sm-0\" type=\"submit\">Chercher</button>
                </form>
            </div>

            
        </nav>
    

        <main role=\"main\" class=\"mainContainer container\">

            ";
        // line 89
        $this->displayBlock('content', $context, $blocks);
        // line 90
        echo "
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
                            <a id=\"modalConfirmBtn\" href=\"\">
                                <button type=\"button\" class=\"btn btn-primary\">Effacer</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <footer class=\"container-fluid fixed-bottom d-flex justify-content-center align-items-center p-2 footer-bg\">
                <p><span class=\"text-light\">ListaGame - </span><a href=\"";
        // line 115
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "connection\">Connexion</a></p>
            </footer>

        </main><!-- /.container -->

    </body>

    <!-- JQUERY -->
    <script src=\"https://code.jquery.com/jquery-3.3.1.min.js\" integrity=\"sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=\" crossorigin=\"anonymous\"></script>

    <!-- BOOSTRAP JS -->
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js\" integrity=\"sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1\" crossorigin=\"anonymous\"></script>
    <script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js\" integrity=\"sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp\" crossorigin=\"anonymous\"></script>

    <!-- SCRIPTS JS -->
    <script src=\"";
        // line 130
        echo twig_escape_filter($this->env, ($context["ASSETS"] ?? null), "html", null, true);
        echo "js/script.js\"></script>

</html>


";
    }

    // line 7
    public function block_title($context, array $blocks = [])
    {
    }

    // line 89
    public function block_content($context, array $blocks = [])
    {
    }

    public function getTemplateName()
    {
        return "front.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  244 => 89,  239 => 7,  229 => 130,  211 => 115,  184 => 90,  182 => 89,  166 => 75,  160 => 72,  157 => 71,  151 => 68,  144 => 64,  140 => 63,  136 => 62,  132 => 61,  128 => 60,  124 => 59,  120 => 58,  116 => 57,  112 => 56,  107 => 53,  105 => 52,  99 => 49,  88 => 41,  60 => 16,  54 => 13,  47 => 8,  45 => 7,  37 => 1,);
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
        
                    {% if connected %}
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
                    {% else %}
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"{{ HOST }}connection\">Connexion</a>
                        </li>
                    {% endif %}
                    
                </ul>
                <form class=\"form-inline\">
                    <input class=\"form-control mr-sm-2\" type=\"search\" placeholder=\"Chercher un jeu...\" aria-label=\"Search\">
                    <button class=\"btn btn-outline-light my-2 my-sm-0\" type=\"submit\">Chercher</button>
                </form>
            </div>

            
        </nav>
    

        <main role=\"main\" class=\"mainContainer container\">

            {% block content %}{% endblock %}

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
                            <a id=\"modalConfirmBtn\" href=\"\">
                                <button type=\"button\" class=\"btn btn-primary\">Effacer</button>
                            </a>
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

    <!-- BOOSTRAP JS -->
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js\" integrity=\"sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1\" crossorigin=\"anonymous\"></script>
    <script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js\" integrity=\"sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp\" crossorigin=\"anonymous\"></script>

    <!-- SCRIPTS JS -->
    <script src=\"{{ ASSETS }}js/script.js\"></script>

</html>


", "front.twig", "/Users/mathias/Sites/projet_05/view/templates/front.twig");
    }
}
