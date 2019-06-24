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

/* gameEdit.twig */
class __TwigTemplate_685eed9286e1f81b5d5dea55744ef3997ca748ef84b78c80ce7d470be5f85202 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("back.twig", "gameEdit.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        // line 4
        echo "    <title>Ajout et modification d'un jeu | LISTaGAME</title>
";
    }

    // line 7
    public function block_content($context, array $blocks = [])
    {
        // line 8
        echo "
<h1>Ajouter un jeu</h1>
<hr>
    <form method=\"post\" action=\"";
        // line 11
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "add-game\">
        <div class=\"form-group\">
            <label for=\"name\">Le titre du jeu :</label>
            <input type=\"text\" class=\"form-control\" id=\"name\" name=\"name\" placeholder=\"Titre\">
        </div>

        <div class=\"form-group\">
            <label>Description du jeu :</label>
            <textarea id=\"tinymcetextarea\" name=\"content\"></textarea>
        </div>

        <hr>
        
        <h4>Le ou les développeur(s) du jeu :</h4>
        <div>
            <div class=\"entity-group-game-edit\">
                <div class=\"form-group bloc-entity-game-edit\" >
                    <a href=\"#\" class=\"cross-cancel\"><i class=\"fas fa-times-circle fa-2x cross-game-edit\"></i></a>
                    <select name=\"developer[0]\" class=\"form-control developerList mb-2\">
                            <option selected>Choisissez un développeur</option>
                        ";
        // line 31
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["developers"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["developer"]) {
            // line 32
            echo "                            <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["developer"], "getId", [], "any", false, false, false, 32), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["developer"], "getName", [], "any", false, false, false, 32), "html", null, true);
            echo "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['developer'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 34
        echo "                    </select>
                </div>
            </div>

            <button type=\"button\" class=\"btn btn-primary addEntityForm\">Ajouter un développeur</button>
        </div>
        <hr>
        
        <h4>Le ou les genre(s) du jeu :</h4>
        <div>
            <div class=\"entity-group-game-edit\">
                <div class=\"form-group bloc-entity-game-edit\" >
                    <a href=\"#\" class=\"cross-cancel\"><i class=\"fas fa-times-circle fa-2x cross-game-edit\"></i></a>
                    <select name=\"genre[0]\" class=\"form-control genreList mb-2\">
                            <option selected>Choisissez un genre</option>
                        ";
        // line 49
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["genres"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["genre"]) {
            // line 50
            echo "                            <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["genre"], "getId", [], "any", false, false, false, 50), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["genre"], "getName", [], "any", false, false, false, 50), "html", null, true);
            echo "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['genre'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 52
        echo "                    </select>
                </div>
            </div>

            <button type=\"button\" class=\"btn btn-primary addEntityForm\">Ajouter un genre</button>
        </div>
        <hr>

        
        <h4>Le ou les mode(s) du jeu :</h4>
        <div>
            <div class=\"entity-group-game-edit\">
                <div class=\"form-group bloc-entity-game-edit\" >
                    <a href=\"#\" class=\"cross-cancel\"><i class=\"fas fa-times-circle fa-2x cross-game-edit\"></i></a>
                    <select name=\"mode[0]\" class=\"form-control modeList mb-2\">
                            <option selected>Choisissez un mode</option>
                        ";
        // line 68
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["modes"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["mode"]) {
            // line 69
            echo "                            <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["mode"], "getId", [], "any", false, false, false, 69), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["mode"], "getName", [], "any", false, false, false, 69), "html", null, true);
            echo "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['mode'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 71
        echo "                    </select>
                </div>
            </div>

            <button type=\"button\" class=\"btn btn-primary addEntityForm\">Ajouter un mode</button>
        </div>
        <hr>

        <h4>La ou les dates de sorties :</h4>
        <p>Pour valider une date vous devez sélectionner un support, un éditeur, une région et une date.</p>
        <div>
            <div class=\"entity-group-game-edit\">
                <div class=\"form-group bloc-entity-game-edit\" >
                    <a href=\"#\" class=\"cross-cancel-release\"><i class=\"fas fa-times-circle fa-2x cross-game-edit\"></i></a>
                    <select name=\"releaseDate[0][platform]\" class=\"form-control platformList mb-2\">
                            <option selected>Choisissez un support</option>
                        ";
        // line 87
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["platforms"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["platform"]) {
            // line 88
            echo "                            <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["platform"], "getId", [], "any", false, false, false, 88), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["platform"], "getName", [], "any", false, false, false, 88), "html", null, true);
            echo "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['platform'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 90
        echo "                    </select>
                    <select name=\"releaseDate[0][publisher]\" class=\"form-control publisherList mb-2\">
                            <option selected>Choisissez un éditeur</option>
                        ";
        // line 93
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["publishers"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["publisher"]) {
            // line 94
            echo "                            <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["publisher"], "getId", [], "any", false, false, false, 94), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["publisher"], "getName", [], "any", false, false, false, 94), "html", null, true);
            echo "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['publisher'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 96
        echo "                    </select>
                        <select name=\"releaseDate[0][region]\" class=\"form-control regionList mb-2\">
                            <option selected>Choisissez une région</option>
                        ";
        // line 99
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["regions"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["region"]) {
            // line 100
            echo "                            <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["region"], "getId", [], "any", false, false, false, 100), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["region"], "getName", [], "any", false, false, false, 100), "html", null, true);
            echo "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['region'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 102
        echo "                    </select>
                    <input type=\"text\" class=\"form-control date\"  id=\"datepicker0\" placeholder=\"Choisissez une date\" readonly>
                    <input type=\"hidden\" class=\"form-control date altDate\" name=\"releaseDate[0][date]\" id=\"altDatepicker0\" readonly>
                </div>
            </div>

            <button type=\"button\" class=\"btn btn-primary\" id=\"addReleaseDateForm\">Ajouter une date</button>
        </div>
        <hr>

        <button type=\"submit\" class=\"btn btn-primary\">Valider</button>

    </form>

";
    }

    public function getTemplateName()
    {
        return "gameEdit.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  237 => 102,  226 => 100,  222 => 99,  217 => 96,  206 => 94,  202 => 93,  197 => 90,  186 => 88,  182 => 87,  164 => 71,  153 => 69,  149 => 68,  131 => 52,  120 => 50,  116 => 49,  99 => 34,  88 => 32,  84 => 31,  61 => 11,  56 => 8,  53 => 7,  48 => 4,  45 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"back.twig\" %}

{% block title %}
    <title>Ajout et modification d'un jeu | LISTaGAME</title>
{% endblock %}

{% block content %}

<h1>Ajouter un jeu</h1>
<hr>
    <form method=\"post\" action=\"{{ HOST }}add-game\">
        <div class=\"form-group\">
            <label for=\"name\">Le titre du jeu :</label>
            <input type=\"text\" class=\"form-control\" id=\"name\" name=\"name\" placeholder=\"Titre\">
        </div>

        <div class=\"form-group\">
            <label>Description du jeu :</label>
            <textarea id=\"tinymcetextarea\" name=\"content\"></textarea>
        </div>

        <hr>
        
        <h4>Le ou les développeur(s) du jeu :</h4>
        <div>
            <div class=\"entity-group-game-edit\">
                <div class=\"form-group bloc-entity-game-edit\" >
                    <a href=\"#\" class=\"cross-cancel\"><i class=\"fas fa-times-circle fa-2x cross-game-edit\"></i></a>
                    <select name=\"developer[0]\" class=\"form-control developerList mb-2\">
                            <option selected>Choisissez un développeur</option>
                        {% for developer in developers %}
                            <option value=\"{{ developer.getId }}\">{{ developer.getName }}</option>
                        {% endfor %}
                    </select>
                </div>
            </div>

            <button type=\"button\" class=\"btn btn-primary addEntityForm\">Ajouter un développeur</button>
        </div>
        <hr>
        
        <h4>Le ou les genre(s) du jeu :</h4>
        <div>
            <div class=\"entity-group-game-edit\">
                <div class=\"form-group bloc-entity-game-edit\" >
                    <a href=\"#\" class=\"cross-cancel\"><i class=\"fas fa-times-circle fa-2x cross-game-edit\"></i></a>
                    <select name=\"genre[0]\" class=\"form-control genreList mb-2\">
                            <option selected>Choisissez un genre</option>
                        {% for genre in genres %}
                            <option value=\"{{ genre.getId }}\">{{ genre.getName }}</option>
                        {% endfor %}
                    </select>
                </div>
            </div>

            <button type=\"button\" class=\"btn btn-primary addEntityForm\">Ajouter un genre</button>
        </div>
        <hr>

        
        <h4>Le ou les mode(s) du jeu :</h4>
        <div>
            <div class=\"entity-group-game-edit\">
                <div class=\"form-group bloc-entity-game-edit\" >
                    <a href=\"#\" class=\"cross-cancel\"><i class=\"fas fa-times-circle fa-2x cross-game-edit\"></i></a>
                    <select name=\"mode[0]\" class=\"form-control modeList mb-2\">
                            <option selected>Choisissez un mode</option>
                        {% for mode in modes %}
                            <option value=\"{{ mode.getId }}\">{{ mode.getName }}</option>
                        {% endfor %}
                    </select>
                </div>
            </div>

            <button type=\"button\" class=\"btn btn-primary addEntityForm\">Ajouter un mode</button>
        </div>
        <hr>

        <h4>La ou les dates de sorties :</h4>
        <p>Pour valider une date vous devez sélectionner un support, un éditeur, une région et une date.</p>
        <div>
            <div class=\"entity-group-game-edit\">
                <div class=\"form-group bloc-entity-game-edit\" >
                    <a href=\"#\" class=\"cross-cancel-release\"><i class=\"fas fa-times-circle fa-2x cross-game-edit\"></i></a>
                    <select name=\"releaseDate[0][platform]\" class=\"form-control platformList mb-2\">
                            <option selected>Choisissez un support</option>
                        {% for platform in platforms %}
                            <option value=\"{{ platform.getId }}\">{{ platform.getName }}</option>
                        {% endfor %}
                    </select>
                    <select name=\"releaseDate[0][publisher]\" class=\"form-control publisherList mb-2\">
                            <option selected>Choisissez un éditeur</option>
                        {% for publisher in publishers %}
                            <option value=\"{{ publisher.getId }}\">{{ publisher.getName }}</option>
                        {% endfor %}
                    </select>
                        <select name=\"releaseDate[0][region]\" class=\"form-control regionList mb-2\">
                            <option selected>Choisissez une région</option>
                        {% for region in regions %}
                            <option value=\"{{ region.getId }}\">{{ region.getName }}</option>
                        {% endfor %}
                    </select>
                    <input type=\"text\" class=\"form-control date\"  id=\"datepicker0\" placeholder=\"Choisissez une date\" readonly>
                    <input type=\"hidden\" class=\"form-control date altDate\" name=\"releaseDate[0][date]\" id=\"altDatepicker0\" readonly>
                </div>
            </div>

            <button type=\"button\" class=\"btn btn-primary\" id=\"addReleaseDateForm\">Ajouter une date</button>
        </div>
        <hr>

        <button type=\"submit\" class=\"btn btn-primary\">Valider</button>

    </form>

{% endblock %}", "gameEdit.twig", "/Users/mathias/Sites/projet_05/view/backend/gameEdit.twig");
    }
}
