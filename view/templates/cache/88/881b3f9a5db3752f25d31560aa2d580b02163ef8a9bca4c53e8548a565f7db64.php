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

/* connection.twig */
class __TwigTemplate_49d43b2b07d975aa96584cb0c1adcfcba77f2b5dff8fd4eb28228357fdcabba1 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("front.twig", "connection.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        // line 4
        echo "    <title>Connexion | LISTaGAME</title>
";
    }

    // line 7
    public function block_content($context, array $blocks = [])
    {
        // line 8
        echo "
    <div class=\"row\">
        <div class=\"col-sm col-connexion-left\">
            <h2>Déjà inscrit ?</h2>
            <p>Identifiez-vous.</p>

            <form method=\"post\" action=\"";
        // line 14
        echo twig_escape_filter($this->env, ($context["HOST"] ?? null), "html", null, true);
        echo "login\">
                <div class=\"form-group\">
                    <input type=\"email\" class=\"form-control\" id=\"identificationEmail\" name=\"mail\" aria-describedby=\"emailHelp\" placeholder=\"Email\">
                </div>
                <div class=\"form-group\">
                    <input type=\"password\" class=\"form-control\" id=\"identificationPassword\" name=\"password\" placeholder=\"Mot de passe\">
                </div>
                <button type=\"submit\" class=\"btn btn-primary\">S'identifier</button>   
            </form>

        </div>
        <div class=\"col-sm\">
            <h2>Créer son compte</h2>
            <p>Inscription rapide.</p>

            <form>
                <div class=\"form-group\">
                    <input type=\"text\" class=\"form-control\" id=\"inscriptionNickname\" placeholder=\"Pseudo\">
                </div>
                <div class=\"form-group\">
                    <input type=\"email\" class=\"form-control\" id=\"inscriptionEmail\" aria-describedby=\"emailHelp\" placeholder=\"Email\">
                </div>
                <div class=\"form-group\">
                    <input type=\"password\" class=\"form-control\" id=\"inscriptionPassword\" placeholder=\"Mot de passe\">
                </div>
                <div class=\"form-group\">
                    <input type=\"password\" class=\"form-control\" id=\"confirmationPassword\" placeholder=\"Confirmer le mot de passe\">
                </div>
                <button type=\"submit\" class=\"btn btn-primary\">S'inscrire</button>
            </form>
        </div>
    </div>

";
    }

    public function getTemplateName()
    {
        return "connection.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 14,  56 => 8,  53 => 7,  48 => 4,  45 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"front.twig\" %}

{% block title %}
    <title>Connexion | LISTaGAME</title>
{% endblock %}

{% block content %}

    <div class=\"row\">
        <div class=\"col-sm col-connexion-left\">
            <h2>Déjà inscrit ?</h2>
            <p>Identifiez-vous.</p>

            <form method=\"post\" action=\"{{ HOST }}login\">
                <div class=\"form-group\">
                    <input type=\"email\" class=\"form-control\" id=\"identificationEmail\" name=\"mail\" aria-describedby=\"emailHelp\" placeholder=\"Email\">
                </div>
                <div class=\"form-group\">
                    <input type=\"password\" class=\"form-control\" id=\"identificationPassword\" name=\"password\" placeholder=\"Mot de passe\">
                </div>
                <button type=\"submit\" class=\"btn btn-primary\">S'identifier</button>   
            </form>

        </div>
        <div class=\"col-sm\">
            <h2>Créer son compte</h2>
            <p>Inscription rapide.</p>

            <form>
                <div class=\"form-group\">
                    <input type=\"text\" class=\"form-control\" id=\"inscriptionNickname\" placeholder=\"Pseudo\">
                </div>
                <div class=\"form-group\">
                    <input type=\"email\" class=\"form-control\" id=\"inscriptionEmail\" aria-describedby=\"emailHelp\" placeholder=\"Email\">
                </div>
                <div class=\"form-group\">
                    <input type=\"password\" class=\"form-control\" id=\"inscriptionPassword\" placeholder=\"Mot de passe\">
                </div>
                <div class=\"form-group\">
                    <input type=\"password\" class=\"form-control\" id=\"confirmationPassword\" placeholder=\"Confirmer le mot de passe\">
                </div>
                <button type=\"submit\" class=\"btn btn-primary\">S'inscrire</button>
            </form>
        </div>
    </div>

{% endblock %}", "connection.twig", "/Users/mathias/Sites/projet_05/view/frontend/connection.twig");
    }
}
