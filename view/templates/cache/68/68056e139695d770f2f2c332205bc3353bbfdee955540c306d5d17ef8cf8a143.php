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
                        ";
            // line 97
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["releaseDates"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["releaseDate"]) {
                // line 98
                echo "                            <div class=\"form-group bloc-entity-game-edit\" >
                                <a href=\"#\" class=\"cross-cancel-release\"><i class=\"fas fa-times-circle fa-2x cross-game-edit\"></i></a>
                                <select name=\"releaseDate[";
                // line 100
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["releaseDate"], "getPlatform", [], "any", false, false, false, 100), "html", null, true);
                echo "][platform]\" class=\"form-control platformList mb-2\">
                                        <option value=\"\">Choisissez un support</option>
                                    ";
                // line 102
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["allPlatforms"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["onePlatform"]) {
                    // line 103
                    echo "                                        <option ";
                    if ((twig_get_attribute($this->env, $this->source, $context["onePlatform"], "getId", [], "any", false, false, false, 103) == twig_get_attribute($this->env, $this->source, $context["releaseDate"], "getPlatformId", [], "any", false, false, false, 103))) {
                        echo "selected ";
                    }
                    echo "value=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["onePlatform"], "getId", [], "any", false, false, false, 103), "html", null, true);
                    echo "\">
                                            ";
                    // line 104
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["onePlatform"], "getName", [], "any", false, false, false, 104), "html", null, true);
                    echo "
                                        </option>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['onePlatform'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 107
                echo "                                </select>
                                <select name=\"releaseDate[";
                // line 108
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["releaseDate"], "getPublisher", [], "any", false, false, false, 108), "html", null, true);
                echo "][publisher]\" class=\"form-control publisherList mb-2\">
                                        <option value=\"\">Choisissez un éditeur</option>
                                    ";
                // line 110
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["allPublishers"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["onePublisher"]) {
                    // line 111
                    echo "                                        <option ";
                    if ((twig_get_attribute($this->env, $this->source, $context["onePublisher"], "getId", [], "any", false, false, false, 111) == twig_get_attribute($this->env, $this->source, $context["releaseDate"], "getPublisherId", [], "any", false, false, false, 111))) {
                        echo "selected ";
                    }
                    echo "value=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["onePublisher"], "getId", [], "any", false, false, false, 111), "html", null, true);
                    echo "\">
                                            ";
                    // line 112
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["onePublisher"], "getName", [], "any", false, false, false, 112), "html", null, true);
                    echo "
                                        </option>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['onePublisher'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 115
                echo "                                </select>
                                    <select name=\"releaseDate[";
                // line 116
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["releaseDate"], "getRegion", [], "any", false, false, false, 116), "html", null, true);
                echo "][region]\" class=\"form-control regionList mb-2\">
                                        <option value=\"\">Choisissez une région</option>
                                    ";
                // line 118
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["allRegions"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["oneRegion"]) {
                    // line 119
                    echo "                                        <option ";
                    if ((twig_get_attribute($this->env, $this->source, $context["oneRegion"], "getId", [], "any", false, false, false, 119) == twig_get_attribute($this->env, $this->source, $context["releaseDate"], "getRegionId", [], "any", false, false, false, 119))) {
                        echo "selected ";
                    }
                    echo "value=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["oneRegion"], "getId", [], "any", false, false, false, 119), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["oneRegion"], "getName", [], "any", false, false, false, 119), "html", null, true);
                    echo "</option>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['oneRegion'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 121
                echo "                                </select>
                                <input type=\"text\" class=\"form-control date\" value=\"";
                // line 122
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["releaseDate"], "getReleaseDate", [], "any", false, false, false, 122), "html", null, true);
                echo "\" readonly>
                                <input type=\"text\" class=\"form-control altDate\" name=\"releaseDate[][date]\" readonly>
                            </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['releaseDate'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 126
            echo "                    </div>
        
                    <button type=\"button\" class=\"btn btn-primary\" id=\"addReleaseDateForm\">Ajouter une date</button>
                </div>
                <hr>
        
                <button type=\"submit\" class=\"btn btn-primary\">Valider</button>
        
            </form>

    ";
        } else {
            // line 137
            echo "
        <h1>Ajouter un jeu</h1>
        <hr>
            <form method=\"post\" action=\"";
            // line 140
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
            // line 160
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["developers"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["developer"]) {
                // line 161
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["developer"], "getId", [], "any", false, false, false, 161), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["developer"], "getName", [], "any", false, false, false, 161), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['developer'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 163
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
            // line 178
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["genres"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["genre"]) {
                // line 179
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["genre"], "getId", [], "any", false, false, false, 179), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["genre"], "getName", [], "any", false, false, false, 179), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['genre'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 181
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
            // line 197
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["modes"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["mode"]) {
                // line 198
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["mode"], "getId", [], "any", false, false, false, 198), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["mode"], "getName", [], "any", false, false, false, 198), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['mode'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 200
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
            // line 216
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["platforms"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["platform"]) {
                // line 217
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["platform"], "getId", [], "any", false, false, false, 217), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["platform"], "getName", [], "any", false, false, false, 217), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['platform'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 219
            echo "                            </select>
                            <select name=\"releaseDate[0][publisher]\" class=\"form-control publisherList mb-2\">
                                    <option selected>Choisissez un éditeur</option>
                                ";
            // line 222
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["publishers"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["publisher"]) {
                // line 223
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["publisher"], "getId", [], "any", false, false, false, 223), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["publisher"], "getName", [], "any", false, false, false, 223), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['publisher'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 225
            echo "                            </select>
                                <select name=\"releaseDate[0][region]\" class=\"form-control regionList mb-2\">
                                    <option selected>Choisissez une région</option>
                                ";
            // line 228
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["regions"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["region"]) {
                // line 229
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["region"], "getId", [], "any", false, false, false, 229), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["region"], "getName", [], "any", false, false, false, 229), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['region'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 231
            echo "                            </select>
                            <input type=\"text\" class=\"form-control date\" placeholder=\"Choisissez une date\" readonly>
                            <!-- <input type=\"text\" class=\"form-control date\" id=\"datepicker0\" placeholder=\"Choisissez une date\" readonly> -->
                            <input type=\"text\" class=\"form-control altDate\" name=\"releaseDate[0][date]\" readonly>
                        </div>
                    </div>
        
                    <button type=\"button\" class=\"btn btn-primary\" id=\"addReleaseDateForm\">Ajouter une date</button>
                </div>
                <hr>
        
                <button type=\"submit\" class=\"btn btn-primary\">Valider</button>
        
            </form>

    ";
        }
        // line 247
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
        return array (  572 => 247,  554 => 231,  543 => 229,  539 => 228,  534 => 225,  523 => 223,  519 => 222,  514 => 219,  503 => 217,  499 => 216,  481 => 200,  470 => 198,  466 => 197,  448 => 181,  437 => 179,  433 => 178,  416 => 163,  405 => 161,  401 => 160,  378 => 140,  373 => 137,  360 => 126,  350 => 122,  347 => 121,  332 => 119,  328 => 118,  323 => 116,  320 => 115,  311 => 112,  302 => 111,  298 => 110,  293 => 108,  290 => 107,  281 => 104,  272 => 103,  268 => 102,  263 => 100,  259 => 98,  255 => 97,  243 => 87,  235 => 84,  226 => 81,  217 => 80,  213 => 79,  208 => 77,  204 => 75,  200 => 74,  188 => 64,  180 => 61,  171 => 58,  162 => 57,  158 => 56,  153 => 54,  149 => 52,  145 => 51,  134 => 42,  126 => 39,  117 => 36,  108 => 35,  104 => 34,  99 => 32,  95 => 30,  91 => 29,  80 => 21,  72 => 16,  66 => 13,  61 => 10,  59 => 9,  56 => 8,  53 => 7,  48 => 4,  45 => 3,  35 => 1,);
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
                        {% for releaseDate in releaseDates %}
                            <div class=\"form-group bloc-entity-game-edit\" >
                                <a href=\"#\" class=\"cross-cancel-release\"><i class=\"fas fa-times-circle fa-2x cross-game-edit\"></i></a>
                                <select name=\"releaseDate[{{ releaseDate.getPlatform }}][platform]\" class=\"form-control platformList mb-2\">
                                        <option value=\"\">Choisissez un support</option>
                                    {% for onePlatform in allPlatforms %}
                                        <option {% if onePlatform.getId == releaseDate.getPlatformId %}selected {% endif %}value=\"{{ onePlatform.getId }}\">
                                            {{ onePlatform.getName }}
                                        </option>
                                    {% endfor %}
                                </select>
                                <select name=\"releaseDate[{{ releaseDate.getPublisher }}][publisher]\" class=\"form-control publisherList mb-2\">
                                        <option value=\"\">Choisissez un éditeur</option>
                                    {% for onePublisher in allPublishers %}
                                        <option {% if onePublisher.getId == releaseDate.getPublisherId %}selected {% endif %}value=\"{{ onePublisher.getId }}\">
                                            {{ onePublisher.getName }}
                                        </option>
                                    {% endfor %}
                                </select>
                                    <select name=\"releaseDate[{{ releaseDate.getRegion }}][region]\" class=\"form-control regionList mb-2\">
                                        <option value=\"\">Choisissez une région</option>
                                    {% for oneRegion in allRegions %}
                                        <option {% if oneRegion.getId == releaseDate.getRegionId %}selected {% endif %}value=\"{{ oneRegion.getId }}\">{{ oneRegion.getName }}</option>
                                    {% endfor %}
                                </select>
                                <input type=\"text\" class=\"form-control date\" value=\"{{ releaseDate.getReleaseDate }}\" readonly>
                                <input type=\"text\" class=\"form-control altDate\" name=\"releaseDate[][date]\" readonly>
                            </div>
                        {% endfor %}
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
                            <input type=\"text\" class=\"form-control date\" placeholder=\"Choisissez une date\" readonly>
                            <!-- <input type=\"text\" class=\"form-control date\" id=\"datepicker0\" placeholder=\"Choisissez une date\" readonly> -->
                            <input type=\"text\" class=\"form-control altDate\" name=\"releaseDate[0][date]\" readonly>
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
