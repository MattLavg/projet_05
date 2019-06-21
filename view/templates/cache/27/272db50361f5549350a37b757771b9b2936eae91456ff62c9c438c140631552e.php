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

/* entityManagement.twig */
class __TwigTemplate_a0024513e9bfd5243f30232f5370c2325efbf95666a23bf4a72295fb85108824 extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "back.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 7
        $context["elementsOnPage"] = false;
        // line 1
        $this->parent = $this->loadTemplate("back.twig", "entityManagement.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        // line 4
        echo "    <title>Gestion des ";
        echo twig_escape_filter($this->env, ($context["entityFr"] ?? null), "html", null, true);
        echo "s | LISTaGAME</title>
";
    }

    // line 9
    public function block_content($context, array $blocks = [])
    {
        // line 10
        echo "
    <h1>Gestion - ";
        // line 11
        echo twig_escape_filter($this->env, ($context["entityFr"] ?? null), "html", null, true);
        echo "</h1>

    <form class=\"form-inline\">
        <div class=\"form-group mx-sm-3 mb-2\">
          <label for=\"entity\">Ajouter à la liste :&nbsp;</label>
          <input type=\"text\" class=\"form-control\" id=\"addEntityInput\" placeholder=\"";
        // line 16
        echo twig_escape_filter($this->env, ($context["entityFr"] ?? null), "html", null, true);
        echo "\">
        </div>
        <button type=\"submit\" id=\"addEntity\" class=\"btn btn-primary mb-2\" data-url=\"";
        // line 18
        echo twig_escape_filter($this->env, ($context["urlAddEntity"] ?? null), "html", null, true);
        echo "\">Ajouter</button>
    </form>

    <div id=\"resultat\">
        <!-- Nous allons afficher un retour en jQuery au visiteur -->
    </div>

    <h3>Liste des ";
        // line 25
        echo twig_escape_filter($this->env, ($context["entityFr"] ?? null), "html", null, true);
        echo "s disponibles</h3>

    <div class=\"table-responsive tableMargin\" id=\"table-dev\">
        <table class=\"table table-striped\">
            <thead class=\"thead-dark\">
                <tr>
                    <th scope=\"col\">Nom</th>
                    <th scope=\"col\">Modification</th>
                    <th scope=\"col\">Suppression</th>
                </tr>
            </thead>
            <tbody>
                
                ";
        // line 38
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["entities"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["entity"]) {
            // line 39
            echo "
                    ";
            // line 40
            $context["elementsOnPage"] = true;
            // line 41
            echo "
                    <tr>
                        <td class=\"entityName\">";
            // line 43
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["entity"], "getName", [], "any", false, false, false, 43), "html", null, true);
            echo "</td>
                        <td><a href=\"";
            // line 44
            echo twig_escape_filter($this->env, ($context["urlUpdateEntity"] ?? null), "html", null, true);
            echo "/id/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["entity"], "getId", [], "any", false, false, false, 44), "html", null, true);
            echo "\" class=\"updateEntity\">Modifier</a></td>
                        <td><a href=\"";
            // line 45
            echo twig_escape_filter($this->env, ($context["urlDeleteEntity"] ?? null), "html", null, true);
            echo "/id/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["entity"], "getId", [], "any", false, false, false, 45), "html", null, true);
            echo "\" class=\"deleteEntity\">Retirer</a></td>
                    </tr> 

                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['entity'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 49
        echo "                
            </tbody>
        </table>
    </div>

    ";
        // line 54
        if ( !($context["elementsOnPage"] ?? null)) {
            // line 55
            echo "        <p>Il n'y a actuellement aucun article</p>
    ";
        }
        // line 57
        echo "
";
    }

    public function getTemplateName()
    {
        return "entityManagement.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  151 => 57,  147 => 55,  145 => 54,  138 => 49,  126 => 45,  120 => 44,  116 => 43,  112 => 41,  110 => 40,  107 => 39,  103 => 38,  87 => 25,  77 => 18,  72 => 16,  64 => 11,  61 => 10,  58 => 9,  51 => 4,  48 => 3,  43 => 1,  41 => 7,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"back.twig\" %}

{% block title %}
    <title>Gestion des {{ entityFr }}s | LISTaGAME</title>
{% endblock %}

{% set elementsOnPage = false %}

{% block content %}

    <h1>Gestion - {{ entityFr }}</h1>

    <form class=\"form-inline\">
        <div class=\"form-group mx-sm-3 mb-2\">
          <label for=\"entity\">Ajouter à la liste :&nbsp;</label>
          <input type=\"text\" class=\"form-control\" id=\"addEntityInput\" placeholder=\"{{ entityFr }}\">
        </div>
        <button type=\"submit\" id=\"addEntity\" class=\"btn btn-primary mb-2\" data-url=\"{{ urlAddEntity }}\">Ajouter</button>
    </form>

    <div id=\"resultat\">
        <!-- Nous allons afficher un retour en jQuery au visiteur -->
    </div>

    <h3>Liste des {{ entityFr }}s disponibles</h3>

    <div class=\"table-responsive tableMargin\" id=\"table-dev\">
        <table class=\"table table-striped\">
            <thead class=\"thead-dark\">
                <tr>
                    <th scope=\"col\">Nom</th>
                    <th scope=\"col\">Modification</th>
                    <th scope=\"col\">Suppression</th>
                </tr>
            </thead>
            <tbody>
                
                {% for entity in entities %}

                    {% set elementsOnPage = true %}

                    <tr>
                        <td class=\"entityName\">{{ entity.getName }}</td>
                        <td><a href=\"{{ urlUpdateEntity }}/id/{{ entity.getId }}\" class=\"updateEntity\">Modifier</a></td>
                        <td><a href=\"{{ urlDeleteEntity }}/id/{{ entity.getId }}\" class=\"deleteEntity\">Retirer</a></td>
                    </tr> 

                {% endfor %}
                
            </tbody>
        </table>
    </div>

    {% if not elementsOnPage %}
        <p>Il n'y a actuellement aucun article</p>
    {% endif %}

{% endblock %}", "entityManagement.twig", "/Users/mathias/Sites/projet_05/view/backend/entityManagement.twig");
    }
}
