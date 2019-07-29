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

/* home.twig */
class __TwigTemplate_b451d0e9160a3b1e885bf1774ed1859e94a3b7cb43f94fc10a97a7bef07e44a9 extends \Twig\Template
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
        // line 2
        return "front.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent = $this->loadTemplate("front.twig", "home.twig", 2);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_title($context, array $blocks = [])
    {
        // line 5
        echo "    <title>Accueil | LISTaGAME</title>
";
    }

    // line 8
    public function block_content($context, array $blocks = [])
    {
        // line 9
        echo "
    ";
        // line 10
        $context["elementsOnPage"] = false;
        // line 11
        echo "
    ";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["games"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["game"]) {
            echo " 

        ";
            // line 14
            $context["elementsOnPage"] = true;
            // line 15
            echo "
        <div class=\"listGames\">
            
            <a href=\"";
            // line 18
            echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
            echo "game/id/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["game"], "getId", [], "any", false, false, false, 18), "html", null, true);
            echo "\" class=\"image-link\">
                <div class=\"background_game_image_home container\" style=\"background-image: url('";
            // line 19
            echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
            echo "public/images/covers/cover_game_id_";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["game"], "getId", [], "any", false, false, false, 19), "html", null, true);
            echo ".";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["game"], "getCover_extension", [], "any", false, false, false, 19), "html", null, true);
            echo "')\"></div>
            </a>
            <h3>
                <a href=\"";
            // line 22
            echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
            echo "game/id/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["game"], "getId", [], "any", false, false, false, 22), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["game"], "getName", [], "any", false, false, false, 22), "html", null, true);
            echo "</a>
            </h3>
            <p>
                ";
            // line 25
            echo twig_get_attribute($this->env, $this->source, $context["game"], "getContent", [], "any", false, false, false, 25);
            echo "<br>
                <a href=\"";
            // line 26
            echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
            echo "game/id/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["game"], "getId", [], "any", false, false, false, 26), "html", null, true);
            echo "\">Voir la suite</a>
            </p>

        </div>

        <hr>

    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['game'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 34
        echo "
    ";
        // line 35
        if ((($context["elementsOnPage"] ?? null) && ($context["renderPagination"] ?? null))) {
            // line 36
            echo "        ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["pagination"] ?? null), "render", [], "any", false, false, false, 36), "html", null, true);
            echo "
    ";
        } elseif ( !        // line 37
($context["elementsOnPage"] ?? null)) {
            // line 38
            echo "        <p>Il n'y a actuellement aucun article</p>
    ";
        }
        // line 40
        echo "
    ";
        // line 41
        if (($context["actionDone"] ?? null)) {
            // line 42
            echo "        <div class=\"alert alert-success alert-dismissible fade show actionErrorMessage fixed-bottom\" role=\"alert\">
            ";
            // line 43
            echo twig_escape_filter($this->env, ($context["actionDone"] ?? null), "html", null, true);
            echo "
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
            </button>
        </div>
    ";
        }
        // line 49
        echo "
    ";
        // line 50
        if (($context["errorMessage"] ?? null)) {
            // line 51
            echo "        <div class=\"alert alert-danger alert-dismissible fade show actionErrorMessage fixed-bottom\" role=\"alert\">
            ";
            // line 52
            echo twig_escape_filter($this->env, ($context["errorMessage"] ?? null), "html", null, true);
            echo "
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
            </button>
        </div>
    ";
        }
        // line 58
        echo "
";
    }

    public function getTemplateName()
    {
        return "home.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  174 => 58,  165 => 52,  162 => 51,  160 => 50,  157 => 49,  148 => 43,  145 => 42,  143 => 41,  140 => 40,  136 => 38,  134 => 37,  129 => 36,  127 => 35,  124 => 34,  108 => 26,  104 => 25,  94 => 22,  84 => 19,  78 => 18,  73 => 15,  71 => 14,  64 => 12,  61 => 11,  59 => 10,  56 => 9,  53 => 8,  48 => 5,  45 => 4,  35 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("
{% extends \"front.twig\" %}

{% block title %}
    <title>Accueil | LISTaGAME</title>
{% endblock %}

{% block content %}

    {% set elementsOnPage = false %}

    {% for game in games %} 

        {% set elementsOnPage = true %}

        <div class=\"listGames\">
            
            <a href=\"{{ HOST }}game/id/{{ game.getId }}\" class=\"image-link\">
                <div class=\"background_game_image_home container\" style=\"background-image: url('{{ HOST }}public/images/covers/cover_game_id_{{ game.getId }}.{{ game.getCover_extension }}')\"></div>
            </a>
            <h3>
                <a href=\"{{ HOST }}game/id/{{ game.getId }}\">{{ game.getName }}</a>
            </h3>
            <p>
                {{ game.getContent|raw }}<br>
                <a href=\"{{ HOST }}game/id/{{ game.getId }}\">Voir la suite</a>
            </p>

        </div>

        <hr>

    {% endfor %}

    {% if elementsOnPage and renderPagination %}
        {{ pagination.render }}
    {% elseif not elementsOnPage %}
        <p>Il n'y a actuellement aucun article</p>
    {% endif %}

    {% if actionDone %}
        <div class=\"alert alert-success alert-dismissible fade show actionErrorMessage fixed-bottom\" role=\"alert\">
            {{ actionDone }}
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
            </button>
        </div>
    {% endif %}

    {% if errorMessage %}
        <div class=\"alert alert-danger alert-dismissible fade show actionErrorMessage fixed-bottom\" role=\"alert\">
            {{ errorMessage }}
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
            </button>
        </div>
    {% endif %}

{% endblock %}
", "home.twig", "/Users/mathias/Sites/projet_05/view/frontend/home.twig");
    }
}
