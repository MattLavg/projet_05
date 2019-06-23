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

    // line 7
    public function block_content($context, array $blocks = [])
    {
        // line 8
        echo "
    <h1>";
        // line 9
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["game"] ?? null), "getName", [], "any", false, false, false, 9), "html", null, true);
        echo "</h1>

    <p>Développeur(s) :<br>
        ";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["developers"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["developer"]) {
            echo " 
            <p>- ";
            // line 13
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["developer"], "getName", [], "any", false, false, false, 13), "html", null, true);
            echo "</p>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['developer'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        echo "    </p>

    <p>Genre(s) :<br>
        ";
        // line 18
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["genres"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["genre"]) {
            echo " 
            <p>- ";
            // line 19
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["genre"], "getName", [], "any", false, false, false, 19), "html", null, true);
            echo "</p>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['genre'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 21
        echo "    </p>

    <p>Mode(s) de jeu :<br>
        ";
        // line 24
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["modes"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["mode"]) {
            echo " 
            <p>- ";
            // line 25
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["mode"], "getName", [], "any", false, false, false, 25), "html", null, true);
            echo "</p>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['mode'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 27
        echo "    </p>

    <p>Sorties :<br>
        ";
        // line 30
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["releases"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["release"]) {
            echo " 
            <p>- Sur ";
            // line 31
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["release"], "getPlatform", [], "any", false, false, false, 31), "html", null, true);
            echo ", édité par ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["release"], "getPublisher", [], "any", false, false, false, 31), "html", null, true);
            echo " - ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["release"], "getRegion", [], "any", false, false, false, 31), "html", null, true);
            echo " - ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["release"], "getReleaseDate", [], "any", false, false, false, 31), "html", null, true);
            echo "</p>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['release'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 33
        echo "    </p>

    <p>";
        // line 35
        echo twig_get_attribute($this->env, $this->source, ($context["game"] ?? null), "getContent", [], "any", false, false, false, 35);
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
        return array (  148 => 35,  144 => 33,  130 => 31,  124 => 30,  119 => 27,  111 => 25,  105 => 24,  100 => 21,  92 => 19,  86 => 18,  81 => 15,  73 => 13,  67 => 12,  61 => 9,  58 => 8,  55 => 7,  48 => 4,  45 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"front.twig\" %}

{% block title %}
    <title>{{ game.getName }} | LISTaGAME</title>
{% endblock %}

{% block content %}

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
