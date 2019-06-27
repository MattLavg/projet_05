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
                    <input type=\"hidden\" class=\"form-control\" id=\"id\" name=\"id\" value=\"";
            // line 16
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["game"] ?? null), "getid", [], "any", false, false, false, 16), "html", null, true);
            echo "\">
                </div>

                <div class=\"form-group\">
                    <label for=\"name\">Le titre du jeu :</label>
                    <input type=\"text\" class=\"form-control\" id=\"name\" name=\"name\" value=\"";
            // line 21
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["game"] ?? null), "getName", [], "any", false, false, false, 21), "html", null, true);
            echo "\">
                </div>
        
                <div class=\"form-group\">
                    <label>Description du jeu :</label>
                    <textarea id=\"tinymcetextarea\" name=\"content\">";
            // line 26
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["game"] ?? null), "getContent", [], "any", false, false, false, 26), "html", null, true);
            echo "</textarea>
                </div>
        
                <hr>
                
                <h4>Le ou les développeur(s) du jeu :</h4>
                <div>
                    <div class=\"entity-group-game-edit\">
                        ";
            // line 34
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["developers"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["developer"]) {
                // line 35
                echo "                            <div class=\"form-group bloc-entity-game-edit pl-5\">
                                <a href=\"#\" class=\"cross-cancel-game-update\"><i class=\"fas fa-times-circle fa-2x cross-game-edit\"></i></a>
                                <select name=\"developer[";
                // line 37
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["developer"], "getName", [], "any", false, false, false, 37), "html", null, true);
                echo "]\" class=\"form-control developerList mb-2\">
                                        <option value=\"\">Choisissez un développeur</option>
                                    ";
                // line 39
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["allDevelopers"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["oneDeveloper"]) {
                    // line 40
                    echo "                                        <option ";
                    if ((twig_get_attribute($this->env, $this->source, $context["oneDeveloper"], "getId", [], "any", false, false, false, 40) == twig_get_attribute($this->env, $this->source, $context["developer"], "getId", [], "any", false, false, false, 40))) {
                        echo "selected ";
                    }
                    echo "value=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["oneDeveloper"], "getId", [], "any", false, false, false, 40), "html", null, true);
                    echo "\">
                                            ";
                    // line 41
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["oneDeveloper"], "getName", [], "any", false, false, false, 41), "html", null, true);
                    echo "
                                        </option>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['oneDeveloper'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 44
                echo "                                </select>
                            </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['developer'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 47
            echo "                    </div>
        
                    <button type=\"button\" class=\"btn btn-primary addEntityForm\">Ajouter un développeur</button>
                </div>
                <hr>
                
                <h4>Le ou les genre(s) du jeu :</h4>
                <div>
                    <div class=\"entity-group-game-edit\">
                        ";
            // line 56
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["genres"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["genre"]) {
                // line 57
                echo "                            <div class=\"form-group bloc-entity-game-edit pl-5\" >
                                <a href=\"#\" class=\"cross-cancel-game-update\"><i class=\"fas fa-times-circle fa-2x cross-game-edit\"></i></a>
                                <select name=\"genre[";
                // line 59
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["genre"], "getName", [], "any", false, false, false, 59), "html", null, true);
                echo "]\" class=\"form-control genreList mb-2\">
                                        <option value=\"\">Choisissez un genre</option>
                                    ";
                // line 61
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["allGenres"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["oneGenre"]) {
                    // line 62
                    echo "                                        <option ";
                    if ((twig_get_attribute($this->env, $this->source, $context["oneGenre"], "getId", [], "any", false, false, false, 62) == twig_get_attribute($this->env, $this->source, $context["genre"], "getId", [], "any", false, false, false, 62))) {
                        echo "selected ";
                    }
                    echo "value=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["oneGenre"], "getId", [], "any", false, false, false, 62), "html", null, true);
                    echo "\">
                                            ";
                    // line 63
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["oneGenre"], "getName", [], "any", false, false, false, 63), "html", null, true);
                    echo "
                                        </option>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['oneGenre'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 66
                echo "                                </select>
                            </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['genre'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 69
            echo "                    </div>
        
                    <button type=\"button\" class=\"btn btn-primary addEntityForm\">Ajouter un genre</button>
                </div>
                <hr>
        
                
                <h4>Le ou les mode(s) du jeu :</h4>
                <div>
                    <div class=\"entity-group-game-edit\">
                        ";
            // line 79
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["modes"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["mode"]) {
                // line 80
                echo "                            <div class=\"form-group bloc-entity-game-edit pl-5\" >
                                <a href=\"#\" class=\"cross-cancel-game-update\"><i class=\"fas fa-times-circle fa-2x cross-game-edit\"></i></a>
                                <select name=\"mode[";
                // line 82
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["mode"], "getName", [], "any", false, false, false, 82), "html", null, true);
                echo "]\" class=\"form-control modeList mb-2\">
                                        <option value=\"\">Choisissez un mode</option>
                                    ";
                // line 84
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["allModes"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["oneMode"]) {
                    // line 85
                    echo "                                        <option ";
                    if ((twig_get_attribute($this->env, $this->source, $context["oneMode"], "getId", [], "any", false, false, false, 85) == twig_get_attribute($this->env, $this->source, $context["mode"], "getId", [], "any", false, false, false, 85))) {
                        echo "selected ";
                    }
                    echo "value=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["oneMode"], "getId", [], "any", false, false, false, 85), "html", null, true);
                    echo "\">
                                            ";
                    // line 86
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["oneMode"], "getName", [], "any", false, false, false, 86), "html", null, true);
                    echo "
                                        </option>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['oneMode'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 89
                echo "                                </select>
                            </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['mode'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 92
            echo "                    </div>
        
                    <button type=\"button\" class=\"btn btn-primary addEntityForm\">Ajouter un mode</button>
                </div>
                <hr>
        
                <h4>La ou les dates de sorties :</h4>
                <p>Pour valider une date vous devez sélectionner un support, un éditeur, une région et une date.</p>
                <div>
                    <div class=\"entity-group-game-edit\">
                        ";
            // line 102
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["releaseDates"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["releaseDate"]) {
                // line 103
                echo "                            <div class=\"form-group bloc-entity-game-edit background-release-game-update pl-5\" >
                                <a href=\"#\" class=\"cross-cancel-release-game-update\"><i class=\"fas fa-times-circle fa-2x cross-game-edit\"></i></a>
                                <select name=\"releaseDate[0][platform]\" class=\"form-control platformList mb-2\">
                                        <option value=\"\">Choisissez un support</option>
                                    ";
                // line 107
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["allPlatforms"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["onePlatform"]) {
                    // line 108
                    echo "                                        <option ";
                    if ((twig_get_attribute($this->env, $this->source, $context["onePlatform"], "getId", [], "any", false, false, false, 108) == twig_get_attribute($this->env, $this->source, $context["releaseDate"], "getPlatformId", [], "any", false, false, false, 108))) {
                        echo "selected ";
                    }
                    echo "value=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["onePlatform"], "getId", [], "any", false, false, false, 108), "html", null, true);
                    echo "\">
                                            ";
                    // line 109
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["onePlatform"], "getName", [], "any", false, false, false, 109), "html", null, true);
                    echo "
                                        </option>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['onePlatform'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 112
                echo "                                </select>
                                <select name=\"releaseDate[0][publisher]\" class=\"form-control publisherList mb-2\">
                                        <option value=\"\">Choisissez un éditeur</option>
                                    ";
                // line 115
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["allPublishers"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["onePublisher"]) {
                    // line 116
                    echo "                                        <option ";
                    if ((twig_get_attribute($this->env, $this->source, $context["onePublisher"], "getId", [], "any", false, false, false, 116) == twig_get_attribute($this->env, $this->source, $context["releaseDate"], "getPublisherId", [], "any", false, false, false, 116))) {
                        echo "selected ";
                    }
                    echo "value=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["onePublisher"], "getId", [], "any", false, false, false, 116), "html", null, true);
                    echo "\">
                                            ";
                    // line 117
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["onePublisher"], "getName", [], "any", false, false, false, 117), "html", null, true);
                    echo "
                                        </option>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['onePublisher'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 120
                echo "                                </select>
                                    <select name=\"releaseDate[0][region]\" class=\"form-control regionList mb-2\">
                                        <option value=\"\">Choisissez une région</option>
                                    ";
                // line 123
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["allRegions"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["oneRegion"]) {
                    // line 124
                    echo "                                        <option ";
                    if ((twig_get_attribute($this->env, $this->source, $context["oneRegion"], "getId", [], "any", false, false, false, 124) == twig_get_attribute($this->env, $this->source, $context["releaseDate"], "getRegionId", [], "any", false, false, false, 124))) {
                        echo "selected ";
                    }
                    echo "value=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["oneRegion"], "getId", [], "any", false, false, false, 124), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["oneRegion"], "getName", [], "any", false, false, false, 124), "html", null, true);
                    echo "</option>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['oneRegion'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 126
                echo "                                </select>
                                <input type=\"text\" class=\"form-control date\" value=\"";
                // line 127
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["releaseDate"], "getReleaseDate", [], "any", false, false, false, 127), "html", null, true);
                echo "\" readonly>
                                <input type=\"text\" class=\"form-control altDate\" name=\"releaseDate[0][date]\" readonly>
                            </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['releaseDate'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 131
            echo "                    </div>
        
                    <button type=\"button\" class=\"btn btn-primary\" id=\"addReleaseDateForm\">Ajouter une date</button>
                </div>
                <hr>
        
                <button type=\"submit\" class=\"btn btn-primary\">Valider</button>
        
            </form>

    ";
        } else {
            // line 142
            echo "
        <h1>Ajouter un jeu</h1>
        <hr>
            <form method=\"post\" action=\"";
            // line 145
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
                                    <option value=\"\">Choisissez un développeur</option>
                                ";
            // line 165
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["developers"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["developer"]) {
                // line 166
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["developer"], "getId", [], "any", false, false, false, 166), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["developer"], "getName", [], "any", false, false, false, 166), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['developer'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 168
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
                                    <option value=\"\">Choisissez un genre</option>
                                ";
            // line 183
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["genres"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["genre"]) {
                // line 184
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["genre"], "getId", [], "any", false, false, false, 184), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["genre"], "getName", [], "any", false, false, false, 184), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['genre'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 186
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
                                    <option value=\"\">Choisissez un mode</option>
                                ";
            // line 202
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["modes"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["mode"]) {
                // line 203
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["mode"], "getId", [], "any", false, false, false, 203), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["mode"], "getName", [], "any", false, false, false, 203), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['mode'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 205
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
                                    <option value=\"\">Choisissez un support</option>
                                ";
            // line 221
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["platforms"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["platform"]) {
                // line 222
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["platform"], "getId", [], "any", false, false, false, 222), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["platform"], "getName", [], "any", false, false, false, 222), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['platform'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 224
            echo "                            </select>
                            <select name=\"releaseDate[0][publisher]\" class=\"form-control publisherList mb-2\">
                                    <option value=\"\">Choisissez un éditeur</option>
                                ";
            // line 227
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["publishers"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["publisher"]) {
                // line 228
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["publisher"], "getId", [], "any", false, false, false, 228), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["publisher"], "getName", [], "any", false, false, false, 228), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['publisher'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 230
            echo "                            </select>
                                <select name=\"releaseDate[0][region]\" class=\"form-control regionList mb-2\">
                                    <option value=\"\">Choisissez une région</option>
                                ";
            // line 233
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["regions"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["region"]) {
                // line 234
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["region"], "getId", [], "any", false, false, false, 234), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["region"], "getName", [], "any", false, false, false, 234), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['region'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 236
            echo "                            </select>
                            <input type=\"text\" class=\"form-control date\" placeholder=\"Choisissez une date\" readonly>
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
        // line 251
        echo "
    ";
        // line 252
        if (($context["errorMessage"] ?? null)) {
            // line 253
            echo "        <div class=\"alert alert-danger alert-dismissible fade show actionErrorMessage fixed-bottom\" role=\"alert\">
            ";
            // line 254
            echo twig_escape_filter($this->env, ($context["errorMessage"] ?? null), "html", null, true);
            echo "
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
            </button>
        </div>
    ";
        }
        // line 260
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
        return array (  587 => 260,  578 => 254,  575 => 253,  573 => 252,  570 => 251,  553 => 236,  542 => 234,  538 => 233,  533 => 230,  522 => 228,  518 => 227,  513 => 224,  502 => 222,  498 => 221,  480 => 205,  469 => 203,  465 => 202,  447 => 186,  436 => 184,  432 => 183,  415 => 168,  404 => 166,  400 => 165,  377 => 145,  372 => 142,  359 => 131,  349 => 127,  346 => 126,  331 => 124,  327 => 123,  322 => 120,  313 => 117,  304 => 116,  300 => 115,  295 => 112,  286 => 109,  277 => 108,  273 => 107,  267 => 103,  263 => 102,  251 => 92,  243 => 89,  234 => 86,  225 => 85,  221 => 84,  216 => 82,  212 => 80,  208 => 79,  196 => 69,  188 => 66,  179 => 63,  170 => 62,  166 => 61,  161 => 59,  157 => 57,  153 => 56,  142 => 47,  134 => 44,  125 => 41,  116 => 40,  112 => 39,  107 => 37,  103 => 35,  99 => 34,  88 => 26,  80 => 21,  72 => 16,  66 => 13,  61 => 10,  59 => 9,  56 => 8,  53 => 7,  48 => 4,  45 => 3,  35 => 1,);
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
                    <input type=\"hidden\" class=\"form-control\" id=\"id\" name=\"id\" value=\"{{ game.getid }}\">
                </div>

                <div class=\"form-group\">
                    <label for=\"name\">Le titre du jeu :</label>
                    <input type=\"text\" class=\"form-control\" id=\"name\" name=\"name\" value=\"{{ game.getName }}\">
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
                            <div class=\"form-group bloc-entity-game-edit background-release-game-update pl-5\" >
                                <a href=\"#\" class=\"cross-cancel-release-game-update\"><i class=\"fas fa-times-circle fa-2x cross-game-edit\"></i></a>
                                <select name=\"releaseDate[0][platform]\" class=\"form-control platformList mb-2\">
                                        <option value=\"\">Choisissez un support</option>
                                    {% for onePlatform in allPlatforms %}
                                        <option {% if onePlatform.getId == releaseDate.getPlatformId %}selected {% endif %}value=\"{{ onePlatform.getId }}\">
                                            {{ onePlatform.getName }}
                                        </option>
                                    {% endfor %}
                                </select>
                                <select name=\"releaseDate[0][publisher]\" class=\"form-control publisherList mb-2\">
                                        <option value=\"\">Choisissez un éditeur</option>
                                    {% for onePublisher in allPublishers %}
                                        <option {% if onePublisher.getId == releaseDate.getPublisherId %}selected {% endif %}value=\"{{ onePublisher.getId }}\">
                                            {{ onePublisher.getName }}
                                        </option>
                                    {% endfor %}
                                </select>
                                    <select name=\"releaseDate[0][region]\" class=\"form-control regionList mb-2\">
                                        <option value=\"\">Choisissez une région</option>
                                    {% for oneRegion in allRegions %}
                                        <option {% if oneRegion.getId == releaseDate.getRegionId %}selected {% endif %}value=\"{{ oneRegion.getId }}\">{{ oneRegion.getName }}</option>
                                    {% endfor %}
                                </select>
                                <input type=\"text\" class=\"form-control date\" value=\"{{ releaseDate.getReleaseDate }}\" readonly>
                                <input type=\"text\" class=\"form-control altDate\" name=\"releaseDate[0][date]\" readonly>
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
                                    <option value=\"\">Choisissez un développeur</option>
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
                                    <option value=\"\">Choisissez un genre</option>
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
                                    <option value=\"\">Choisissez un mode</option>
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
                                    <option value=\"\">Choisissez un support</option>
                                {% for platform in platforms %}
                                    <option value=\"{{ platform.getId }}\">{{ platform.getName }}</option>
                                {% endfor %}
                            </select>
                            <select name=\"releaseDate[0][publisher]\" class=\"form-control publisherList mb-2\">
                                    <option value=\"\">Choisissez un éditeur</option>
                                {% for publisher in publishers %}
                                    <option value=\"{{ publisher.getId }}\">{{ publisher.getName }}</option>
                                {% endfor %}
                            </select>
                                <select name=\"releaseDate[0][region]\" class=\"form-control regionList mb-2\">
                                    <option value=\"\">Choisissez une région</option>
                                {% for region in regions %}
                                    <option value=\"{{ region.getId }}\">{{ region.getName }}</option>
                                {% endfor %}
                            </select>
                            <input type=\"text\" class=\"form-control date\" placeholder=\"Choisissez une date\" readonly>
                            <input type=\"text\" class=\"form-control altDate\" name=\"releaseDate[0][date]\" readonly>
                        </div>
                    </div>
        
                    <button type=\"button\" class=\"btn btn-primary\" id=\"addReleaseDateForm\">Ajouter une date</button>
                </div>
                <hr>
        
                <button type=\"submit\" class=\"btn btn-primary\">Valider</button>
        
            </form>

    {% endif %}

    {% if errorMessage %}
        <div class=\"alert alert-danger alert-dismissible fade show actionErrorMessage fixed-bottom\" role=\"alert\">
            {{ errorMessage }}
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
            </button>
        </div>
    {% endif %}

{% endblock %}", "gameEdit.twig", "/Users/mathias/Sites/projet_05/view/backend/gameEdit.twig");
    }
}
