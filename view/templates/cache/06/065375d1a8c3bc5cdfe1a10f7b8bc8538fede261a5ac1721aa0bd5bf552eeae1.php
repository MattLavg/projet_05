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

/* home.html */
class __TwigTemplate_8c90ed94e84a6d693a0d0bc35720b7eac7049d15cf5b3e4ec1eaa4b744f603c1 extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 2
        return "front.html";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 4
        $context["title"] = "Accueil | LISTaGAME";
        // line 2
        $this->parent = $this->loadTemplate("front.html", "home.html", 2);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    public function getTemplateName()
    {
        return "home.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 2,  39 => 4,  33 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("
{% extends \"front.html\" %}

{% set title = 'Accueil | LISTaGAME' %}

{# {% set elementsOnPage = false %}

{% for game in games %} 

    {% set elementsOnPage = true %}


    <div class=\"listPosts\">

        <h3>
            <a href=\"{ HOST }post/id/{ game.getId }\">{ game.getName }</a>
        </h3>
        <p>
            { game.getContent }<br>
            <a href=\"{ HOST }post/id/{ game.getId }\">Voir la suite</a>
        </p>

    </div>

    <hr>

{% endfor %}

{% if not elementsOnPage %}
    <p>Il n'y a actuellement aucun article</p>
{% endif %} #}
", "home.html", "/Users/mathias/Sites/projet_05/view/frontend/home.html");
    }
}
