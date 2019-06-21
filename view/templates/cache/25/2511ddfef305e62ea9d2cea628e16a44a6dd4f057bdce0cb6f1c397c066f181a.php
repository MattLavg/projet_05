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

/* front.html */
class __TwigTemplate_7a64f62dc63895b519b657bdf35c4982c7a4bf1fcc320e72f65b9654ff069e31 extends \Twig\Template
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
            'HOST' => [$this, 'block_HOST'],
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

        <title>";
        // line 7
        $this->displayBlock('title', $context, $blocks);
        echo "</title>

        <!-- Bootstrap core CSS -->
        <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css\" integrity=\"sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA\" crossorigin=\"anonymous\">

        <!-- CSS -->
        <link href=\"";
        // line 13
        $this->displayBlock("ASSETS", $context, $blocks);
        echo "/css/style.css\" rel=\"stylesheet\">

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
        // line 38
        $this->displayBlock("HOST", $context, $blocks);
        echo "\">LISTaGAME</a>
            <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarsExampleDefault\" aria-controls=\"navbarsExampleDefault\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                <span class=\"navbar-toggler-icon\"></span>
            </button>

            <div class=\"collapse navbar-collapse\" id=\"navbarsExampleDefault\">
                <ul class=\"navbar-nav mr-auto\">
                    <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"";
        // line 46
        $this->displayBlock("HOST", $context, $blocks);
        echo "\">Accueil<span class=\"sr-only\">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    

        <!-- condition allows to modify padding-top if the image is on the page or not -->
        <main role=\"main\" class=\"container\">

            ";
        // line 56
        $this->displayBlock('content', $context, $blocks);
        // line 57
        echo "
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
        // line 81
        $this->displayBlock('HOST', $context, $blocks);
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
        // line 96
        $this->displayBlock("ASSETS", $context, $blocks);
        echo "/js/script.js\"></script>

</html>


";
    }

    // line 7
    public function block_title($context, array $blocks = [])
    {
    }

    // line 56
    public function block_content($context, array $blocks = [])
    {
    }

    // line 81
    public function block_HOST($context, array $blocks = [])
    {
    }

    public function getTemplateName()
    {
        return "front.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  173 => 81,  168 => 56,  163 => 7,  153 => 96,  135 => 81,  109 => 57,  107 => 56,  94 => 46,  83 => 38,  55 => 13,  46 => 7,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!doctype html>
<html lang=\"fr\">
    <head>
        <meta charset=\"utf-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">

        <title>{% block title %}{% endblock %}</title>

        <!-- Bootstrap core CSS -->
        <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css\" integrity=\"sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA\" crossorigin=\"anonymous\">

        <!-- CSS -->
        <link href=\"{{ block('ASSETS') }}/css/style.css\" rel=\"stylesheet\">

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
            <a class=\"navbar-brand logo\" href=\"{{ block('HOST') }}\">LISTaGAME</a>
            <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarsExampleDefault\" aria-controls=\"navbarsExampleDefault\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                <span class=\"navbar-toggler-icon\"></span>
            </button>

            <div class=\"collapse navbar-collapse\" id=\"navbarsExampleDefault\">
                <ul class=\"navbar-nav mr-auto\">
                    <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"{{ block('HOST') }}\">Accueil<span class=\"sr-only\">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    

        <!-- condition allows to modify padding-top if the image is on the page or not -->
        <main role=\"main\" class=\"container\">

            {% block content %}{% endblock %}

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
                <p><span class=\"text-light\">ListaGame - </span><a href=\"{% block HOST %}{% endblock %}connection\">Connexion</a></p>
            </footer>

        </main><!-- /.container -->

    </body>

    <!-- JQUERY -->
    <script src=\"https://code.jquery.com/jquery-3.3.1.min.js\" integrity=\"sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=\" crossorigin=\"anonymous\"></script>

    <!-- BOOSTRAP JS -->
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js\" integrity=\"sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1\" crossorigin=\"anonymous\"></script>
    <script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js\" integrity=\"sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp\" crossorigin=\"anonymous\"></script>

    <!-- SCRIPTS JS -->
    <script src=\"{{ block('ASSETS') }}/js/script.js\"></script>

</html>


", "front.html", "/Users/mathias/Sites/projet_05/view/templates/front.html");
    }
}
