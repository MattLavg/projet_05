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
            echo "update-game\" enctype=\"multipart/form-data\" novalidate>

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

                <div class=\"form-group\">
                    <label for=\"cover\">Télécharger une image pour le jeu.</label>
                    <input type=\"file\" class=\"form-control-file\" id=\"cover\" name=\"cover\">
                    <small id=\"cover\" class=\"form-text text-muted\">L'image ne doit pas dépasser 3 Mo.</small>
                </div>

                <hr>
                
                <h4>Le ou les développeur(s) du jeu :</h4>
                <div>
                    <div class=\"entity-group-game-edit\">
                        ";
            // line 42
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["developers"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["developer"]) {
                // line 43
                echo "                            <div class=\"form-group bloc-entity-game-edit pl-5\">
                                <a href=\"#\" class=\"cross-cancel-game-update\"><i class=\"fas fa-times-circle fa-2x cross-game-edit\"></i></a>
                                <select name=\"developer[";
                // line 45
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["developer"], "getName", [], "any", false, false, false, 45), "html", null, true);
                echo "]\" class=\"form-control developerList mb-2\">
                                        <option value=\"\">Choisissez un développeur</option>
                                    ";
                // line 47
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["allDevelopers"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["oneDeveloper"]) {
                    // line 48
                    echo "                                        <option ";
                    if ((twig_get_attribute($this->env, $this->source, $context["oneDeveloper"], "getId", [], "any", false, false, false, 48) == twig_get_attribute($this->env, $this->source, $context["developer"], "getId", [], "any", false, false, false, 48))) {
                        echo "selected ";
                    }
                    echo "value=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["oneDeveloper"], "getId", [], "any", false, false, false, 48), "html", null, true);
                    echo "\">
                                            ";
                    // line 49
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["oneDeveloper"], "getName", [], "any", false, false, false, 49), "html", null, true);
                    echo "
                                        </option>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['oneDeveloper'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 52
                echo "                                </select>
                            </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['developer'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 55
            echo "                    </div>
        
                    <button type=\"button\" class=\"btn btn-primary addEntityForm\">Ajouter un développeur</button>
                </div>
                <hr>
                
                <h4>Le ou les genre(s) du jeu :</h4>
                <div>
                    <div class=\"entity-group-game-edit\">
                        ";
            // line 64
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["genres"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["genre"]) {
                // line 65
                echo "                            <div class=\"form-group bloc-entity-game-edit pl-5\" >
                                <a href=\"#\" class=\"cross-cancel-game-update\"><i class=\"fas fa-times-circle fa-2x cross-game-edit\"></i></a>
                                <select name=\"genre[";
                // line 67
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["genre"], "getName", [], "any", false, false, false, 67), "html", null, true);
                echo "]\" class=\"form-control genreList mb-2\">
                                        <option value=\"\">Choisissez un genre</option>
                                    ";
                // line 69
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["allGenres"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["oneGenre"]) {
                    // line 70
                    echo "                                        <option ";
                    if ((twig_get_attribute($this->env, $this->source, $context["oneGenre"], "getId", [], "any", false, false, false, 70) == twig_get_attribute($this->env, $this->source, $context["genre"], "getId", [], "any", false, false, false, 70))) {
                        echo "selected ";
                    }
                    echo "value=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["oneGenre"], "getId", [], "any", false, false, false, 70), "html", null, true);
                    echo "\">
                                            ";
                    // line 71
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["oneGenre"], "getName", [], "any", false, false, false, 71), "html", null, true);
                    echo "
                                        </option>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['oneGenre'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 74
                echo "                                </select>
                            </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['genre'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 77
            echo "                    </div>
        
                    <button type=\"button\" class=\"btn btn-primary addEntityForm\">Ajouter un genre</button>
                </div>
                <hr>
        
                
                <h4>Le ou les mode(s) du jeu :</h4>
                <div>
                    <div class=\"entity-group-game-edit\">
                        ";
            // line 87
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["modes"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["mode"]) {
                // line 88
                echo "                            <div class=\"form-group bloc-entity-game-edit pl-5\" >
                                <a href=\"#\" class=\"cross-cancel-game-update\"><i class=\"fas fa-times-circle fa-2x cross-game-edit\"></i></a>
                                <select name=\"mode[";
                // line 90
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["mode"], "getName", [], "any", false, false, false, 90), "html", null, true);
                echo "]\" class=\"form-control modeList mb-2\">
                                        <option value=\"\">Choisissez un mode</option>
                                    ";
                // line 92
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["allModes"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["oneMode"]) {
                    // line 93
                    echo "                                        <option ";
                    if ((twig_get_attribute($this->env, $this->source, $context["oneMode"], "getId", [], "any", false, false, false, 93) == twig_get_attribute($this->env, $this->source, $context["mode"], "getId", [], "any", false, false, false, 93))) {
                        echo "selected ";
                    }
                    echo "value=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["oneMode"], "getId", [], "any", false, false, false, 93), "html", null, true);
                    echo "\">
                                            ";
                    // line 94
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["oneMode"], "getName", [], "any", false, false, false, 94), "html", null, true);
                    echo "
                                        </option>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['oneMode'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 97
                echo "                                </select>
                            </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['mode'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 100
            echo "                    </div>
        
                    <button type=\"button\" class=\"btn btn-primary addEntityForm\">Ajouter un mode</button>
                </div>
                <hr>
        
                <h4>La ou les dates de sorties :</h4>
                <p>Pour valider une date vous devez sélectionner un support, un éditeur, une région et une date.</p>
                <div>
                    <div class=\"entity-group-game-edit\">
                        ";
            // line 110
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["releaseDates"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["releaseDate"]) {
                // line 111
                echo "                            <div class=\"form-group bloc-entity-game-edit background-release-game-update pl-5\" >
                                <a href=\"#\" class=\"cross-cancel-release-game-update\"><i class=\"fas fa-times-circle fa-2x cross-game-edit\"></i></a>
                                <select name=\"releaseDate[0][platform]\" class=\"form-control platformList mb-2\">
                                        <option value=\"\">Choisissez un support</option>
                                    ";
                // line 115
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["allPlatforms"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["onePlatform"]) {
                    // line 116
                    echo "                                        <option ";
                    if ((twig_get_attribute($this->env, $this->source, $context["onePlatform"], "getId", [], "any", false, false, false, 116) == twig_get_attribute($this->env, $this->source, $context["releaseDate"], "getPlatformId", [], "any", false, false, false, 116))) {
                        echo "selected ";
                    }
                    echo "value=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["onePlatform"], "getId", [], "any", false, false, false, 116), "html", null, true);
                    echo "\">
                                            ";
                    // line 117
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["onePlatform"], "getName", [], "any", false, false, false, 117), "html", null, true);
                    echo "
                                        </option>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['onePlatform'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 120
                echo "                                </select>
                                <select name=\"releaseDate[0][publisher]\" class=\"form-control publisherList mb-2\">
                                        <option value=\"\">Choisissez un éditeur</option>
                                    ";
                // line 123
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["allPublishers"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["onePublisher"]) {
                    // line 124
                    echo "                                        <option ";
                    if ((twig_get_attribute($this->env, $this->source, $context["onePublisher"], "getId", [], "any", false, false, false, 124) == twig_get_attribute($this->env, $this->source, $context["releaseDate"], "getPublisherId", [], "any", false, false, false, 124))) {
                        echo "selected ";
                    }
                    echo "value=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["onePublisher"], "getId", [], "any", false, false, false, 124), "html", null, true);
                    echo "\">
                                            ";
                    // line 125
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["onePublisher"], "getName", [], "any", false, false, false, 125), "html", null, true);
                    echo "
                                        </option>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['onePublisher'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 128
                echo "                                </select>
                                    <select name=\"releaseDate[0][region]\" class=\"form-control regionList mb-2\">
                                        <option value=\"\">Choisissez une région</option>
                                    ";
                // line 131
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["allRegions"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["oneRegion"]) {
                    // line 132
                    echo "                                        <option ";
                    if ((twig_get_attribute($this->env, $this->source, $context["oneRegion"], "getId", [], "any", false, false, false, 132) == twig_get_attribute($this->env, $this->source, $context["releaseDate"], "getRegionId", [], "any", false, false, false, 132))) {
                        echo "selected ";
                    }
                    echo "value=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["oneRegion"], "getId", [], "any", false, false, false, 132), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["oneRegion"], "getName", [], "any", false, false, false, 132), "html", null, true);
                    echo "</option>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['oneRegion'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 134
                echo "                                </select>
                                <input type=\"text\" class=\"form-control date\" value=\"";
                // line 135
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["releaseDate"], "getReleaseDate", [], "any", false, false, false, 135), "html", null, true);
                echo "\" readonly>
                                <input type=\"text\" class=\"form-control altDate\" name=\"releaseDate[0][date]\" readonly>
                            </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['releaseDate'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 139
            echo "                    </div>
        
                    <button type=\"button\" class=\"btn btn-primary\" id=\"addReleaseDateForm\">Ajouter une date</button>
                </div>
                <hr>
        
                <button type=\"submit\" class=\"btn btn-primary updateGameBtn\">Valider</button>
        
            </form>

    ";
        } else {
            // line 150
            echo "
        <h1>Ajouter un jeu</h1>
        <hr>
            <form method=\"post\" action=\"";
            // line 153
            echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
            echo "add-game\" enctype=\"multipart/form-data\" novalidate>
                <div class=\"form-group\">
                    <label for=\"name\">Le titre du jeu :</label>
                    <input type=\"text\" class=\"form-control\" id=\"name\" name=\"name\" placeholder=\"Titre\">
                    <span class=\"missName redText\"></span>
                </div>
        
                <div class=\"form-group\">
                    <label>Description du jeu :</label>
                    <textarea id=\"tinymcetextarea\" name=\"content\"></textarea>
                    <span class=\"missContent redText\"></span>
                </div>
        
                <hr>

                <div class=\"form-group\">
                    <label for=\"cover\">Télécharger une image pour le jeu.</label>
                    <input type=\"file\" class=\"form-control-file\" id=\"cover\" name=\"cover\">
                    <span class=\"missImage redText\"></span>
                    <small id=\"cover\" class=\"form-text text-muted\">L'image ne doit pas dépasser 3 Mo.</small>
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
            // line 184
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["developers"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["developer"]) {
                // line 185
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["developer"], "getId", [], "any", false, false, false, 185), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["developer"], "getName", [], "any", false, false, false, 185), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['developer'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 187
            echo "                            </select>
                            <span class=\"redText\"></span>
                        </div>
                    </div>
        
                    <button type=\"button\" class=\"btn btn-primary addEntityForm\">Ajouter un développeur</button>
                    <span class=\"missDev redText\"></span>
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
            // line 204
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["genres"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["genre"]) {
                // line 205
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["genre"], "getId", [], "any", false, false, false, 205), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["genre"], "getName", [], "any", false, false, false, 205), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['genre'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 207
            echo "                            </select>
                            <span class=\"redText\"></span>
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
            // line 224
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["modes"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["mode"]) {
                // line 225
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["mode"], "getId", [], "any", false, false, false, 225), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["mode"], "getName", [], "any", false, false, false, 225), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['mode'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 227
            echo "                            </select>
                            <span class=\"redText\"></span>
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
            // line 244
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["platforms"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["platform"]) {
                // line 245
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["platform"], "getId", [], "any", false, false, false, 245), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["platform"], "getName", [], "any", false, false, false, 245), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['platform'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 247
            echo "                            </select>
                            <select name=\"releaseDate[0][publisher]\" class=\"form-control publisherList mb-2\">
                                    <option value=\"\">Choisissez un éditeur</option>
                                ";
            // line 250
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["publishers"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["publisher"]) {
                // line 251
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["publisher"], "getId", [], "any", false, false, false, 251), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["publisher"], "getName", [], "any", false, false, false, 251), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['publisher'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 253
            echo "                            </select>
                                <select name=\"releaseDate[0][region]\" class=\"form-control regionList mb-2\">
                                    <option value=\"\">Choisissez une région</option>
                                ";
            // line 256
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["regions"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["region"]) {
                // line 257
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["region"], "getId", [], "any", false, false, false, 257), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["region"], "getName", [], "any", false, false, false, 257), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['region'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 259
            echo "                            </select>
                            <input type=\"text\" class=\"form-control date\" placeholder=\"Choisissez une date\" readonly>
                            <input type=\"text\" class=\"form-control altDate\" name=\"releaseDate[0][date]\" readonly>
                        </div>
                    </div>
        
                    <button type=\"button\" class=\"btn btn-primary\" id=\"addReleaseDateForm\">Ajouter une date</button>
                </div>
                <hr>
        
                <button type=\"submit\" class=\"btn btn-primary addGameBtn\">Valider</button>
        
            </form>

    ";
        }
        // line 274
        echo "
    ";
        // line 275
        if (($context["errorMessage"] ?? null)) {
            // line 276
            echo "        <div class=\"alert alert-danger alert-dismissible fade show actionErrorMessage fixed-bottom\" role=\"alert\">
            ";
            // line 277
            echo twig_escape_filter($this->env, ($context["errorMessage"] ?? null), "html", null, true);
            echo "
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
            </button>
        </div>
    ";
        }
        // line 283
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
        return array (  610 => 283,  601 => 277,  598 => 276,  596 => 275,  593 => 274,  576 => 259,  565 => 257,  561 => 256,  556 => 253,  545 => 251,  541 => 250,  536 => 247,  525 => 245,  521 => 244,  502 => 227,  491 => 225,  487 => 224,  468 => 207,  457 => 205,  453 => 204,  434 => 187,  423 => 185,  419 => 184,  385 => 153,  380 => 150,  367 => 139,  357 => 135,  354 => 134,  339 => 132,  335 => 131,  330 => 128,  321 => 125,  312 => 124,  308 => 123,  303 => 120,  294 => 117,  285 => 116,  281 => 115,  275 => 111,  271 => 110,  259 => 100,  251 => 97,  242 => 94,  233 => 93,  229 => 92,  224 => 90,  220 => 88,  216 => 87,  204 => 77,  196 => 74,  187 => 71,  178 => 70,  174 => 69,  169 => 67,  165 => 65,  161 => 64,  150 => 55,  142 => 52,  133 => 49,  124 => 48,  120 => 47,  115 => 45,  111 => 43,  107 => 42,  88 => 26,  80 => 21,  72 => 16,  66 => 13,  61 => 10,  59 => 9,  56 => 8,  53 => 7,  48 => 4,  45 => 3,  35 => 1,);
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
            <form method=\"post\" action=\"{{ HOST }}update-game\" enctype=\"multipart/form-data\" novalidate>

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

                <div class=\"form-group\">
                    <label for=\"cover\">Télécharger une image pour le jeu.</label>
                    <input type=\"file\" class=\"form-control-file\" id=\"cover\" name=\"cover\">
                    <small id=\"cover\" class=\"form-text text-muted\">L'image ne doit pas dépasser 3 Mo.</small>
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
        
                <button type=\"submit\" class=\"btn btn-primary updateGameBtn\">Valider</button>
        
            </form>

    {% else %}

        <h1>Ajouter un jeu</h1>
        <hr>
            <form method=\"post\" action=\"{{ HOST }}add-game\" enctype=\"multipart/form-data\" novalidate>
                <div class=\"form-group\">
                    <label for=\"name\">Le titre du jeu :</label>
                    <input type=\"text\" class=\"form-control\" id=\"name\" name=\"name\" placeholder=\"Titre\">
                    <span class=\"missName redText\"></span>
                </div>
        
                <div class=\"form-group\">
                    <label>Description du jeu :</label>
                    <textarea id=\"tinymcetextarea\" name=\"content\"></textarea>
                    <span class=\"missContent redText\"></span>
                </div>
        
                <hr>

                <div class=\"form-group\">
                    <label for=\"cover\">Télécharger une image pour le jeu.</label>
                    <input type=\"file\" class=\"form-control-file\" id=\"cover\" name=\"cover\">
                    <span class=\"missImage redText\"></span>
                    <small id=\"cover\" class=\"form-text text-muted\">L'image ne doit pas dépasser 3 Mo.</small>
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
                            <span class=\"redText\"></span>
                        </div>
                    </div>
        
                    <button type=\"button\" class=\"btn btn-primary addEntityForm\">Ajouter un développeur</button>
                    <span class=\"missDev redText\"></span>
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
                            <span class=\"redText\"></span>
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
                            <span class=\"redText\"></span>
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
        
                <button type=\"submit\" class=\"btn btn-primary addGameBtn\">Valider</button>
        
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
