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

/* developerManagement.twig */
class __TwigTemplate_ba69433cbc7284fb1a8153f093ab37f91a7c2db752573e2f898d3356b18dc74a extends \Twig\Template
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
        $this->parent = $this->loadTemplate("back.twig", "developerManagement.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        // line 4
        echo "    <title>Gestion des développeurs | LISTaGAME</title>
";
    }

    // line 9
    public function block_content($context, array $blocks = [])
    {
        // line 10
        echo "
    <h1>Modifier / supprimer un développeur</h1>

    <h3>Ajout de développeur</h3>

    <form class=\"form-inline\">
        <div class=\"form-group mx-sm-3 mb-2\">
          <label for=\"developer\">Ajouter un développeur : </label>
          <input type=\"text\" class=\"form-control\" id=\"developer\" placeholder=\"Développeur\">
        </div>
        <button type=\"submit\" id=\"addDeveloper\" class=\"btn btn-primary mb-2\" data-url=\"";
        // line 20
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "add-developer\">Ajouter</button>
    </form>

    <div id=\"resultat\">
        <!-- Nous allons afficher un retour en jQuery au visiteur -->
    </div>

    <h3>Liste des développeurs disponibles</h3>

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
        // line 40
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["developers"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["developer"]) {
            // line 41
            echo "
                    ";
            // line 42
            $context["elementsOnPage"] = true;
            // line 43
            echo "
                    <tr>
                        <td>";
            // line 45
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["developer"], "getName", [], "any", false, false, false, 45), "html", null, true);
            echo "</td>
                        <td><a href=\"<?= HOST; ?>edit/id/<?= \$post->getId(); ?>\">Modifier</a></td>
                        <td><a href=\"\" class=\"deletePostBtn\" data-toggle=\"modal\" data-target=\"#deleteModal\" data-title=\"<?= htmlspecialchars(\$post->getTitle()); ?>\" data-url=\"<?= HOST; ?>delete-post/id/<?= \$post->getId(); ?>/post-management/\">Supprimer</a></td>
                    </tr> 

                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['developer'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 51
        echo "                
            </tbody>
        </table>
    </div>

    ";
        // line 56
        if ( !($context["elementsOnPage"] ?? null)) {
            // line 57
            echo "        <p>Il n'y a actuellement aucun article</p>
    ";
        }
        // line 59
        echo "
";
    }

    public function getTemplateName()
    {
        return "developerManagement.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  132 => 59,  128 => 57,  126 => 56,  119 => 51,  107 => 45,  103 => 43,  101 => 42,  98 => 41,  94 => 40,  71 => 20,  59 => 10,  56 => 9,  51 => 4,  48 => 3,  43 => 1,  41 => 7,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"back.twig\" %}

{% block title %}
    <title>Gestion des développeurs | LISTaGAME</title>
{% endblock %}

{% set elementsOnPage = false %}

{% block content %}

    <h1>Modifier / supprimer un développeur</h1>

    <h3>Ajout de développeur</h3>

    <form class=\"form-inline\">
        <div class=\"form-group mx-sm-3 mb-2\">
          <label for=\"developer\">Ajouter un développeur : </label>
          <input type=\"text\" class=\"form-control\" id=\"developer\" placeholder=\"Développeur\">
        </div>
        <button type=\"submit\" id=\"addDeveloper\" class=\"btn btn-primary mb-2\" data-url=\"{{ HOST }}add-developer\">Ajouter</button>
    </form>

    <div id=\"resultat\">
        <!-- Nous allons afficher un retour en jQuery au visiteur -->
    </div>

    <h3>Liste des développeurs disponibles</h3>

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
                
                {% for developer in developers %}

                    {% set elementsOnPage = true %}

                    <tr>
                        <td>{{ developer.getName }}</td>
                        <td><a href=\"<?= HOST; ?>edit/id/<?= \$post->getId(); ?>\">Modifier</a></td>
                        <td><a href=\"\" class=\"deletePostBtn\" data-toggle=\"modal\" data-target=\"#deleteModal\" data-title=\"<?= htmlspecialchars(\$post->getTitle()); ?>\" data-url=\"<?= HOST; ?>delete-post/id/<?= \$post->getId(); ?>/post-management/\">Supprimer</a></td>
                    </tr> 

                {% endfor %}
                
            </tbody>
        </table>
    </div>

    {% if not elementsOnPage %}
        <p>Il n'y a actuellement aucun article</p>
    {% endif %}

{% endblock %}", "developerManagement.twig", "/Users/mathias/Sites/projet_05/view/backend/developerManagement.twig");
    }
}
