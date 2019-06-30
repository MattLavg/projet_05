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

/* game.twig */
class __TwigTemplate_c52af23f4a45cafc95078f2918eedb7947de7d3f3d077032e78713542f4bff62 extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'cover' => [$this, 'block_cover'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "front.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 7
        $context["cover"] = true;
        // line 1
        $this->parent = $this->loadTemplate("front.twig", "game.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        // line 4
        echo "    <title>";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["game"] ?? null), "getName", [], "any", false, false, false, 4), "html", null, true);
        echo " | LISTaGAME</title>
";
    }

    // line 9
    public function block_cover($context, array $blocks = [])
    {
        // line 10
        echo "    <div class=\"background_game_image container-fluid\" style=\"background-image: url('";
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "public/images/covers/";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["game"] ?? null), "getCover", [], "any", false, false, false, 10), "html", null, true);
        echo "')\"></div>
";
    }

    // line 13
    public function block_content($context, array $blocks = [])
    {
        // line 14
        echo "
 
    <!-- <img src=\"";
        // line 16
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "public/images/covers/";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["game"] ?? null), "getCover", [], "any", false, false, false, 16), "html", null, true);
        echo "\" alt=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["game"] ?? null), "getName", [], "any", false, false, false, 16), "html", null, true);
        echo " image\" class=\"game_image\"> -->

    <h1>";
        // line 18
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["game"] ?? null), "getName", [], "any", false, false, false, 18), "html", null, true);
        echo "</h1>

    <p>Développeur(s) :<br>
        ";
        // line 21
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["developers"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["developer"]) {
            echo " 
            <p>- ";
            // line 22
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["developer"], "getName", [], "any", false, false, false, 22), "html", null, true);
            echo "</p>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['developer'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 24
        echo "    </p>

    <p>Genre(s) :<br>
        ";
        // line 27
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["genres"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["genre"]) {
            echo " 
            <p>- ";
            // line 28
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["genre"], "getName", [], "any", false, false, false, 28), "html", null, true);
            echo "</p>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['genre'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        echo "    </p>

    <p>Mode(s) de jeu :<br>
        ";
        // line 33
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["modes"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["mode"]) {
            echo " 
            <p>- ";
            // line 34
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["mode"], "getName", [], "any", false, false, false, 34), "html", null, true);
            echo "</p>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['mode'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        echo "    </p>

    <p>Sorties :<br>
        ";
        // line 39
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["releases"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["release"]) {
            echo " 
            <p>- Sur ";
            // line 40
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["release"], "getPlatform", [], "any", false, false, false, 40), "html", null, true);
            echo ", édité par ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["release"], "getPublisher", [], "any", false, false, false, 40), "html", null, true);
            echo " - ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["release"], "getRegion", [], "any", false, false, false, 40), "html", null, true);
            echo " - ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["release"], "getReleaseDate", [], "any", false, false, false, 40), "html", null, true);
            echo "</p>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['release'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 42
        echo "    </p>

    <p>";
        // line 44
        echo twig_get_attribute($this->env, $this->source, ($context["game"] ?? null), "getContent", [], "any", false, false, false, 44);
        echo "</p>
    <hr>
";
    }

    public function getTemplateName()
    {
        return "game.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  174 => 44,  170 => 42,  156 => 40,  150 => 39,  145 => 36,  137 => 34,  131 => 33,  126 => 30,  118 => 28,  112 => 27,  107 => 24,  99 => 22,  93 => 21,  87 => 18,  78 => 16,  74 => 14,  71 => 13,  62 => 10,  59 => 9,  52 => 4,  49 => 3,  44 => 1,  42 => 7,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"front.twig\" %}

{% block title %}
    <title>{{ game.getName }} | LISTaGAME</title>
{% endblock %}

{% set cover = true %}

{% block cover %}
    <div class=\"background_game_image container-fluid\" style=\"background-image: url('{{ HOST }}public/images/covers/{{ game.getCover }}')\"></div>
{% endblock %}

{% block content %}

 
    <!-- <img src=\"{{ HOST }}public/images/covers/{{ game.getCover }}\" alt=\"{{ game.getName }} image\" class=\"game_image\"> -->

    <h1>{{ game.getName }}</h1>

    <p>Développeur(s) :<br>
        {% for developer in developers %} 
            <p>- {{ developer.getName }}</p>
        {% endfor %}
    </p>

    <p>Genre(s) :<br>
        {% for genre in genres %} 
            <p>- {{ genre.getName }}</p>
        {% endfor %}
    </p>

    <p>Mode(s) de jeu :<br>
        {% for mode in modes %} 
            <p>- {{ mode.getName }}</p>
        {% endfor %}
    </p>

    <p>Sorties :<br>
        {% for release in releases %} 
            <p>- Sur {{ release.getPlatform }}, édité par {{ release.getPublisher }} - {{ release.getRegion }} - {{  release. getReleaseDate }}</p>
        {% endfor %}
    </p>

    <p>{{ game.getContent|raw }}</p>
    <hr>
{% endblock %}", "game.twig", "/Users/mathias/Sites/projet_05/view/frontend/game.twig");
    }
}
