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

/* vue.html */
class __TwigTemplate_10c115e65832bc9709ad79df5aa8e99b904004b844d4f180163e65347e36d3fa extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<!doctype html>
<html lang=\"fr\">
<head>
  <meta charset=\"utf-8\">
  <title>Titre de la page</title>
  <link rel=\"stylesheet\" href=\"style.css\">
  <script src=\"script.js\"></script>
</head>
<body>
";
        // line 10
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["result"] ?? null), "title", [], "any", false, false, false, 10), "html", null, true);
        echo "<br>
";
        // line 11
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["result"] ?? null), "author", [], "any", false, false, false, 11), "html", null, true);
        echo "<br>
";
        // line 12
        $context["text"] = "Twig<br>";
        // line 13
        echo twig_escape_filter($this->env, ($context["text"] ?? null));
        echo "

<p>BLOOOP</p>

</body>
</html>";
    }

    public function getTemplateName()
    {
        return "vue.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 13,  54 => 12,  50 => 11,  46 => 10,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "vue.html", "/Users/mathias/Sites/projet_05/templates/vue.html");
    }
}
