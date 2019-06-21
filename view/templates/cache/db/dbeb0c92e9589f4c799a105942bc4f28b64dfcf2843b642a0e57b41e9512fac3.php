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

/* home.php */
class __TwigTemplate_f1448e99cee805a0789fed4596f41082234aa2b789bdfdaa95c310421b0dd793 extends \Twig\Template
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
        echo "<?php

\$title = 'Accueil | LISTaGAME';


\$elementsOnPage = false;

foreach (\$games as \$game) 
{
    \$elementsOnPage = true;
?>

    <div class=\"listPosts\">

        <h3>
            <a href=\"<?= HOST; ?>post/id/<?= \$game->getId(); ?>\"><?= htmlspecialchars(\$game->getName()); ?></a>
        </h3>
        <p>
            <?= \$game->getContent(); ?><br>
            <a href=\"<?= HOST; ?>post/id/<?= \$game->getId(); ?>\">Voir la suite</a>
        </p>

    </div>

    <hr>

<?php
}

if (!\$elementsOnPage) {
    echo 'Il n\\'y a actuellement aucun article';
}
";
    }

    public function getTemplateName()
    {
        return "home.php";
    }

    public function getDebugInfo()
    {
        return array (  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<?php

\$title = 'Accueil | LISTaGAME';


\$elementsOnPage = false;

foreach (\$games as \$game) 
{
    \$elementsOnPage = true;
?>

    <div class=\"listPosts\">

        <h3>
            <a href=\"<?= HOST; ?>post/id/<?= \$game->getId(); ?>\"><?= htmlspecialchars(\$game->getName()); ?></a>
        </h3>
        <p>
            <?= \$game->getContent(); ?><br>
            <a href=\"<?= HOST; ?>post/id/<?= \$game->getId(); ?>\">Voir la suite</a>
        </p>

    </div>

    <hr>

<?php
}

if (!\$elementsOnPage) {
    echo 'Il n\\'y a actuellement aucun article';
}
", "home.php", "/Users/mathias/Sites/projet_05/view/frontend/home.php");
    }
}
