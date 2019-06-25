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
    ";
        // line 9
        if (($context["game_id"] ?? null)) {
            // line 10
            echo "
        <h1>Modifier un jeu</h1>
        <hr>
            <form method=\"post\" action=\"";
            // line 13
            echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
            echo "update-game\">
                <div class=\"form-group\">
                    <label for=\"name\">Le titre du jeu :</label>
                    <input type=\"text\" class=\"form-control\" id=\"name\" name=\"name\" placeholder=\"";
            // line 16
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["game"] ?? null), "getName", [], "any", false, false, false, 16), "html", null, true);
            echo "\">
                </div>
        
                <div class=\"form-group\">
                    <label>Description du jeu :</label>
                    <textarea id=\"tinymcetextarea\" name=\"content\">";
            // line 21
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["game"] ?? null), "getContent", [], "any", false, false, false, 21), "html", null, true);
            echo "</textarea>
                </div>
        
                <hr>
                
                <h4>Le ou les développeur(s) du jeu :</h4>
                <div>
                    <div class=\"entity-group-game-edit\">
                        ";
            // line 29
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["developers"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["developer"]) {
                // line 30
                echo "                            <div class=\"form-group bloc-entity-game-edit pl-5\">
                                <a href=\"#\" class=\"cross-cancel-game-update\"><i class=\"fas fa-times-circle fa-2x cross-game-edit\"></i></a>
                                <select name=\"developer[";
                // line 32
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["developer"], "getName", [], "any", false, false, false, 32), "html", null, true);
                echo "]\" class=\"form-control developerList mb-2\">
                                        <option value=\"\">Choisissez un développeur</option>
                                    ";
                // line 34
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["allDevelopers"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["oneDeveloper"]) {
                    // line 35
                    echo "                                        <option ";
                    if ((twig_get_attribute($this->env, $this->source, $context["oneDeveloper"], "getId", [], "any", false, false, false, 35) == twig_get_attribute($this->env, $this->source, $context["developer"], "getId", [], "any", false, false, false, 35))) {
                        echo "selected ";
                    }
                    echo "value=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["oneDeveloper"], "getId", [], "any", false, false, false, 35), "html", null, true);
                    echo "\">
                                            ";
                    // line 36
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["oneDeveloper"], "getName", [], "any", false, false, false, 36), "html", null, true);
                    echo "
                                        </option>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['oneDeveloper'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 39
                echo "                                </select>
                            </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['developer'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 42
            echo "                    </div>
        
                    <button type=\"button\" class=\"btn btn-primary addEntityForm\">Ajouter un développeur</button>
                </div>
                <hr>
                
                <h4>Le ou les genre(s) du jeu :</h4>
                <div>
                    <div class=\"entity-group-game-edit\">
                        ";
            // line 51
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["genres"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["genre"]) {
                // line 52
                echo "                            <div class=\"form-group bloc-entity-game-edit pl-5\" >
                                <a href=\"#\" class=\"cross-cancel-game-update\"><i class=\"fas fa-times-circle fa-2x cross-game-edit\"></i></a>
                                <select name=\"genre[";
                // line 54
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["genre"], "getName", [], "any", false, false, false, 54), "html", null, true);
                echo "]\" class=\"form-control genreList mb-2\">
                                        <option value=\"\">Choisissez un genre</option>
                                    ";
                // line 56
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["allGenres"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["oneGenre"]) {
                    // line 57
                    echo "                                        <option ";
                    if ((twig_get_attribute($this->env, $this->source, $context["oneGenre"], "getId", [], "any", false, false, false, 57) == twig_get_attribute($this->env, $this->source, $context["genre"], "getId", [], "any", false, false, false, 57))) {
                        echo "selected ";
                    }
                    echo "value=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["oneGenre"], "getId", [], "any", false, false, false, 57), "html", null, true);
                    echo "\">
                                            ";
                    // line 58
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["oneGenre"], "getName", [], "any", false, false, false, 58), "html", null, true);
                    echo "
                                        </option>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['oneGenre'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 61
                echo "                                </select>
                            </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['genre'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 64
            echo "                    </div>
        
                    <button type=\"button\" class=\"btn btn-primary addEntityForm\">Ajouter un genre</button>
                </div>
                <hr>
        
                
                <h4>Le ou les mode(s) du jeu :</h4>
                <div>
                    <div class=\"entity-group-game-edit\">
                        ";
            // line 74
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["modes"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["mode"]) {
                // line 75
                echo "                            <div class=\"form-group bloc-entity-game-edit pl-5\" >
                                <a href=\"#\" class=\"cross-cancel-game-update\"><i class=\"fas fa-times-circle fa-2x cross-game-edit\"></i></a>
                                <select name=\"mode[";
                // line 77
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["mode"], "getName", [], "any", false, false, false, 77), "html", null, true);
                echo "]\" class=\"form-control modeList mb-2\">
                                        <option value=\"\">Choisissez un mode</option>
                                    ";
                // line 79
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["allModes"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["oneMode"]) {
                    // line 80
                    echo "                                        <option ";
                    if ((twig_get_attribute($this->env, $this->source, $context["oneMode"], "getId", [], "any", false, false, false, 80) == twig_get_attribute($this->env, $this->source, $context["mode"], "getId", [], "any", false, false, false, 80))) {
                        echo "selected ";
                    }
                    echo "value=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["oneMode"], "getId", [], "any", false, false, false, 80), "html", null, true);
                    echo "\">
                                            ";
                    // line 81
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["oneMode"], "getName", [], "any", false, false, false, 81), "html", null, true);
                    echo "
                                        </option>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['oneMode'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 84
                echo "                                </select>
                            </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['mode'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 87
            echo "                    </div>
        
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
            // line 101
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["platforms"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["platform"]) {
                // line 102
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["platform"], "getId", [], "any", false, false, false, 102), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["platform"], "getName", [], "any", false, false, false, 102), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['platform'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 104
            echo "                            </select>
                            <select name=\"releaseDate[0][publisher]\" class=\"form-control publisherList mb-2\">
                                    <option selected>Choisissez un éditeur</option>
                                ";
            // line 107
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["publishers"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["publisher"]) {
                // line 108
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["publisher"], "getId", [], "any", false, false, false, 108), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["publisher"], "getName", [], "any", false, false, false, 108), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['publisher'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 110
            echo "                            </select>
                                <select name=\"releaseDate[0][region]\" class=\"form-control regionList mb-2\">
                                    <option selected>Choisissez une région</option>
                                ";
            // line 113
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["regions"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["region"]) {
                // line 114
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["region"], "getId", [], "any", false, false, false, 114), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["region"], "getName", [], "any", false, false, false, 114), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['region'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 116
            echo "                            </select>
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
        } else {
            // line 131
            echo "
        <h1>Ajouter un jeu</h1>
        <hr>
            <form method=\"post\" action=\"";
            // line 134
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
            // line 154
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["developers"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["developer"]) {
                // line 155
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["developer"], "getId", [], "any", false, false, false, 155), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["developer"], "getName", [], "any", false, false, false, 155), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['developer'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 157
            echo "                            </select>
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
            // line 172
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["genres"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["genre"]) {
                // line 173
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["genre"], "getId", [], "any", false, false, false, 173), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["genre"], "getName", [], "any", false, false, false, 173), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['genre'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 175
            echo "                            </select>
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
            // line 191
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["modes"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["mode"]) {
                // line 192
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["mode"], "getId", [], "any", false, false, false, 192), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["mode"], "getName", [], "any", false, false, false, 192), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['mode'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 194
            echo "                            </select>
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
            // line 210
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["platforms"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["platform"]) {
                // line 211
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["platform"], "getId", [], "any", false, false, false, 211), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["platform"], "getName", [], "any", false, false, false, 211), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['platform'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 213
            echo "                            </select>
                            <select name=\"releaseDate[0][publisher]\" class=\"form-control publisherList mb-2\">
                                    <option selected>Choisissez un éditeur</option>
                                ";
            // line 216
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["publishers"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["publisher"]) {
                // line 217
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["publisher"], "getId", [], "any", false, false, false, 217), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["publisher"], "getName", [], "any", false, false, false, 217), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['publisher'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 219
            echo "                            </select>
                                <select name=\"releaseDate[0][region]\" class=\"form-control regionList mb-2\">
                                    <option selected>Choisissez une région</option>
                                ";
            // line 222
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["regions"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["region"]) {
                // line 223
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["region"], "getId", [], "any", false, false, false, 223), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["region"], "getName", [], "any", false, false, false, 223), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['region'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 225
            echo "                            </select>
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
        // line 240
        echo "
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
        return array (  529 => 240,  512 => 225,  501 => 223,  497 => 222,  492 => 219,  481 => 217,  477 => 216,  472 => 213,  461 => 211,  457 => 210,  439 => 194,  428 => 192,  424 => 191,  406 => 175,  395 => 173,  391 => 172,  374 => 157,  363 => 155,  359 => 154,  336 => 134,  331 => 131,  314 => 116,  303 => 114,  299 => 113,  294 => 110,  283 => 108,  279 => 107,  274 => 104,  263 => 102,  259 => 101,  243 => 87,  235 => 84,  226 => 81,  217 => 80,  213 => 79,  208 => 77,  204 => 75,  200 => 74,  188 => 64,  180 => 61,  171 => 58,  162 => 57,  158 => 56,  153 => 54,  149 => 52,  145 => 51,  134 => 42,  126 => 39,  117 => 36,  108 => 35,  104 => 34,  99 => 32,  95 => 30,  91 => 29,  80 => 21,  72 => 16,  66 => 13,  61 => 10,  59 => 9,  56 => 8,  53 => 7,  48 => 4,  45 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"back.twig\" %}

{% block title %}
    <title>Ajout et modification d'un jeu | LISTaGAME</title>
{% endblock %}

{% block content %}

    {% if game_id %}

        <h1>Modifier un jeu</h1>
        <hr>
            <form method=\"post\" action=\"{{ HOST }}update-game\">
                <div class=\"form-group\">
                    <label for=\"name\">Le titre du jeu :</label>
                    <input type=\"text\" class=\"form-control\" id=\"name\" name=\"name\" placeholder=\"{{ game.getName }}\">
                </div>
        
                <div class=\"form-group\">
                    <label>Description du jeu :</label>
                    <textarea id=\"tinymcetextarea\" name=\"content\">{{ game.getContent }}</textarea>
                </div>
        
                <hr>
                
                <h4>Le ou les développeur(s) du jeu :</h4>
                <div>
                    <div class=\"entity-group-game-edit\">
                        {% for developer in developers%}
                            <div class=\"form-group bloc-entity-game-edit pl-5\">
                                <a href=\"#\" class=\"cross-cancel-game-update\"><i class=\"fas fa-times-circle fa-2x cross-game-edit\"></i></a>
                                <select name=\"developer[{{ developer.getName }}]\" class=\"form-control developerList mb-2\">
                                        <option value=\"\">Choisissez un développeur</option>
                                    {% for oneDeveloper in allDevelopers %}
                                        <option {% if oneDeveloper.getId == developer.getId %}selected {% endif %}value=\"{{ oneDeveloper.getId }}\">
                                            {{ oneDeveloper.getName }}
                                        </option>
                                    {% endfor %}
                                </select>
                            </div>
                        {% endfor %}
                    </div>
        
                    <button type=\"button\" class=\"btn btn-primary addEntityForm\">Ajouter un développeur</button>
                </div>
                <hr>
                
                <h4>Le ou les genre(s) du jeu :</h4>
                <div>
                    <div class=\"entity-group-game-edit\">
                        {% for genre in genres %}
                            <div class=\"form-group bloc-entity-game-edit pl-5\" >
                                <a href=\"#\" class=\"cross-cancel-game-update\"><i class=\"fas fa-times-circle fa-2x cross-game-edit\"></i></a>
                                <select name=\"genre[{{ genre.getName }}]\" class=\"form-control genreList mb-2\">
                                        <option value=\"\">Choisissez un genre</option>
                                    {% for oneGenre in allGenres %}
                                        <option {% if oneGenre.getId == genre.getId %}selected {% endif %}value=\"{{ oneGenre.getId }}\">
                                            {{ oneGenre.getName }}
                                        </option>
                                    {% endfor %}
                                </select>
                            </div>
                        {% endfor %}
                    </div>
        
                    <button type=\"button\" class=\"btn btn-primary addEntityForm\">Ajouter un genre</button>
                </div>
                <hr>
        
                
                <h4>Le ou les mode(s) du jeu :</h4>
                <div>
                    <div class=\"entity-group-game-edit\">
                        {% for mode in modes %}
                            <div class=\"form-group bloc-entity-game-edit pl-5\" >
                                <a href=\"#\" class=\"cross-cancel-game-update\"><i class=\"fas fa-times-circle fa-2x cross-game-edit\"></i></a>
                                <select name=\"mode[{{ mode.getName }}]\" class=\"form-control modeList mb-2\">
                                        <option value=\"\">Choisissez un mode</option>
                                    {% for oneMode in allModes %}
                                        <option {% if oneMode.getId == mode.getId %}selected {% endif %}value=\"{{ oneMode.getId }}\">
                                            {{ oneMode.getName }}
                                        </option>
                                    {% endfor %}
                                </select>
                            </div>
                        {% endfor %}
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

    {% else %}

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

    {% endif %}

{% endblock %}", "gameEdit.twig", "/Users/mathias/Sites/projet_05/view/backend/gameEdit.twig");
    }
}
