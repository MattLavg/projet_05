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

/* gameManagement.twig */
class __TwigTemplate_0308943c8a89b9247d4616661a37b92d48ee7d6ce13b0b3488d39ff4e546e15d extends \Twig\Template
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
        $this->parent = $this->loadTemplate("back.twig", "gameManagement.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        // line 4
        echo "    <title>Gestion des jeux | LISTaGAME</title>
";
    }

    // line 9
    public function block_content($context, array $blocks = [])
    {
        // line 10
        echo "
    <h1>Gestion - jeux</h1>

    <h3>Liste des jeux disponibles</h3>

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
        // line 26
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["games"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["game"]) {
            // line 27
            echo "
                    ";
            // line 28
            $context["elementsOnPage"] = true;
            // line 29
            echo "
                    <tr>
                        <td>";
            // line 31
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["game"], "getName", [], "any", false, false, false, 31), "html", null, true);
            echo "</td>
                        <td><a href=\"";
            // line 32
            echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
            echo "update-game/id/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["game"], "getId", [], "any", false, false, false, 32), "html", null, true);
            echo "\" id=\"updateGame\">Modifier</a></td>
                        <td><a href=\"#\" data-url-delete-game=\"";
            // line 33
            echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
            echo "delete-game/id/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["game"], "getId", [], "any", false, false, false, 33), "html", null, true);
            echo "\" id=\"gameDeleteBtn\" data-game-name=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["game"], "getName", [], "any", false, false, false, 33), "html", null, true);
            echo "\" data-toggle=\"modal\" data-target=\"#deleteModal\">Supprimer</a></td>
                    </tr> 

                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['game'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 37
        echo "                
            </tbody>
        </table>
    </div>

    ";
        // line 42
        if ( !($context["elementsOnPage"] ?? null)) {
            // line 43
            echo "        <p>Il n'y a actuellement aucun article</p>
    ";
        }
        // line 45
        echo "
";
    }

    public function getTemplateName()
    {
        return "gameManagement.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  127 => 45,  123 => 43,  121 => 42,  114 => 37,  100 => 33,  94 => 32,  90 => 31,  86 => 29,  84 => 28,  81 => 27,  77 => 26,  59 => 10,  56 => 9,  51 => 4,  48 => 3,  43 => 1,  41 => 7,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"back.twig\" %}

{% block title %}
    <title>Gestion des jeux | LISTaGAME</title>
{% endblock %}

{% set elementsOnPage = false %}

{% block content %}

    <h1>Gestion - jeux</h1>

    <h3>Liste des jeux disponibles</h3>

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
                
                {% for game in games %}

                    {% set elementsOnPage = true %}

                    <tr>
                        <td>{{ game.getName }}</td>
                        <td><a href=\"{{ HOST }}update-game/id/{{ game.getId }}\" id=\"updateGame\">Modifier</a></td>
                        <td><a href=\"#\" data-url-delete-game=\"{{ HOST }}delete-game/id/{{ game.getId }}\" id=\"gameDeleteBtn\" data-game-name=\"{{ game.getName }}\" data-toggle=\"modal\" data-target=\"#deleteModal\">Supprimer</a></td>
                    </tr> 

                {% endfor %}
                
            </tbody>
        </table>
    </div>

    {% if not elementsOnPage %}
        <p>Il n'y a actuellement aucun article</p>
    {% endif %}

{% endblock %}", "gameManagement.twig", "/Users/mathias/Sites/projet_05/view/backend/gameManagement.twig");
    }
}
