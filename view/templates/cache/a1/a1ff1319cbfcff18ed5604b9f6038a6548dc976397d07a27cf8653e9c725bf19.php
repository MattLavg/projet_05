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
            
            <div class=\"background_game_image_home container\" style=\"background-image: url('";
            // line 18
            echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
            echo "public/images/covers/cover_game_id_";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["game"], "getId", [], "any", false, false, false, 18), "html", null, true);
            echo ".";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["game"], "getCover_extension", [], "any", false, false, false, 18), "html", null, true);
            echo "')\"></div>
            <h3>
                <a href=\"";
            // line 20
            echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
            echo "game/id/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["game"], "getId", [], "any", false, false, false, 20), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["game"], "getName", [], "any", false, false, false, 20), "html", null, true);
            echo "</a>
            </h3>
            <p>
                ";
            // line 23
            echo twig_get_attribute($this->env, $this->source, $context["game"], "getContent", [], "any", false, false, false, 23);
            echo "<br>
                <a href=\"";
            // line 24
            echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
            echo "game/id/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["game"], "getId", [], "any", false, false, false, 24), "html", null, true);
            echo "\">Voir la suite</a>
            </p>

        </div>

        <hr>

    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['game'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 32
        echo "
    ";
        // line 33
        if ( !($context["elementsOnPage"] ?? null)) {
            // line 34
            echo "        <p>Il n'y a actuellement aucun article</p>
    ";
        }
        // line 36
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
        return array (  126 => 36,  122 => 34,  120 => 33,  117 => 32,  101 => 24,  97 => 23,  87 => 20,  78 => 18,  73 => 15,  71 => 14,  64 => 12,  61 => 11,  59 => 10,  56 => 9,  53 => 8,  48 => 5,  45 => 4,  35 => 2,);
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
            
            <div class=\"background_game_image_home container\" style=\"background-image: url('{{ HOST }}public/images/covers/cover_game_id_{{ game.getId }}.{{ game.getCover_extension }}')\"></div>
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

    {% if not elementsOnPage %}
        <p>Il n'y a actuellement aucun article</p>
    {% endif %}

{% endblock %}
", "home.twig", "/Users/mathias/Sites/projet_05/view/frontend/home.twig");
    }
}
