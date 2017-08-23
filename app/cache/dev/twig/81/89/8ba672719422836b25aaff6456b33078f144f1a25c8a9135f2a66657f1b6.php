<?php

/* ApplicationCoreBundle::index.html.twig */
class __TwigTemplate_81898ba672719422836b25aaff6456b33078f144f1a25c8a9135f2a66657f1b6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context["_version"] = 1;
        // line 2
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <link href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/images/siap_icon.png"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"image/png\" rel=\"Shortcut Icon\" />
        <link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/css/seleccion_modulo.css"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
        <!-- Latest compiled and minified CSS -->
        <link rel=\"stylesheet\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/css/bootstrap3/css/bootstrap.min.css"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\">
        <!-- Optional theme -->
        <link rel=\"stylesheet\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/css/bootstrap3/css/bootstrap-theme.min.css"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\">
        <script src=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatajquery/jquery-1.10.2.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatajquery/jquery-ui-1.10.4.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatajquery/jquery-ui-i18n.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/css/bootstrap3/js/bootstrap.min.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script type=\"text/javascript\">
            jQuery(document).ready(function(\$) {
                \$('.carousel').carousel({
                    interval: 3000
                });
            });
        </script>
        <title>Ministerio de Salud de El Salvador</title>
    </head>
    <body>
        <div id=\"pagina\">
            <div id=\"pagina-content\">
                <div id=\"content\">
                    <center>
                        <table>
                            <!-- <tr><td id=\"cont-title\"><b>El Salvador<br />Ministerio de Salud<br />Sistema Integral de Atenci&oacute;n al Paciente</b></td></tr> -->
                            <tr><td id=\"cont-body\">
                                    <div class=\"box-settings shadow\">
                                        <div class=\"row over\">
                                            ";
        // line 37
        if (array_key_exists("urlModule", $context)) {
            // line 38
            echo "                                                ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["urlModule"]) ? $context["urlModule"] : $this->getContext($context, "urlModule")));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                // line 39
                echo "                                                    <div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12";
                if (((twig_length_filter($this->env, (isset($context["hiddeModules"]) ? $context["hiddeModules"] : $this->getContext($context, "hiddeModules"))) > 0) && twig_in_filter($this->getAttribute((isset($context["loop"]) ? $context["loop"] : $this->getContext($context, "loop")), "index"), (isset($context["hiddeModules"]) ? $context["hiddeModules"] : $this->getContext($context, "hiddeModules"))))) {
                    echo " hidden";
                }
                echo "\">
                                                        <a href=\"";
                // line 40
                echo twig_escape_filter($this->env, (isset($context["module"]) ? $context["module"] : $this->getContext($context, "module")), "html", null, true);
                echo "\">
                                                            <div class=\"module module";
                // line 41
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["loop"]) ? $context["loop"] : $this->getContext($context, "loop")), "index"), "html", null, true);
                echo " pull-right\"></div>
                                                        </a>
                                                    </div>
                                                ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 45
            echo "                                            ";
        }
        // line 46
        echo "                                        </div>
                                        <!-- <div id=\"cover-carousel\" class=\"carousel slide\" data-ride=\"carousel\"> -->
                                        <div id=\"cover-carousel\">
                                            <!-- Indicators -->
                                            <!-- <ol class=\"carousel-indicators\">
                                                <li data-target=\"#cover-carousel\" data-slide-to=\"0\" class=\"active\"></li>
                                                <li data-target=\"#cover-carousel\" data-slide-to=\"1\"></li>
                                                <li data-target=\"#cover-carousel\" data-slide-to=\"2\"></li>
                                                <li data-target=\"#cover-carousel\" data-slide-to=\"3\"></li>
                                            </ol> -->

                                            <!-- Wrapper for slides -->
                                            <div class=\"carousel-inner\">
                                                <div class=\"item active\">
                                                    <img src=\"";
        // line 60
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/images/siap_index_img_shadow.png"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" alt=\"img01\">
                                                </div>
                                                <!-- <div class=\"item active\">
                                                    <img src=\"";
        // line 63
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/images/cover01.png"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" alt=\"img01\">
                                                </div> -->
                                                <!-- <div class=\"item\">
                                                    <img src=\"";
        // line 66
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/images/cover02.png"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" alt=\"img02\">
                                                </div>
                                                <div class=\"item\">
                                                    <img src=\"";
        // line 69
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/images/cover03.png"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" alt=\"img03\">
                                                </div>
                                                <div class=\"item\">
                                                    <img src=\"";
        // line 72
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/images/cover04.png"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" alt=\"img04\">
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr><td id=\"cont-footer\"><div id=\"footer\"></div></td></tr>
                        </table>
                    </center>
                </div>
            </div>
        </div>
        <div class=\"page-footer\">
                <img class=\"dtic-footer\" src=\"";
        // line 86
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/images/dtic.png"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" alt=\"dtic\"/>Direcci&oacute;n de Tecnolog&iacute;as de Informaci&oacute;n y Comunicaciones - Ministerio de Salud
            </div>
    </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "ApplicationCoreBundle::index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  217 => 86,  198 => 72,  190 => 69,  182 => 66,  174 => 63,  166 => 60,  150 => 46,  147 => 45,  129 => 41,  125 => 40,  118 => 39,  100 => 38,  98 => 37,  73 => 17,  66 => 15,  60 => 14,  54 => 13,  48 => 12,  41 => 10,  34 => 8,  28 => 7,  21 => 2,  19 => 1,);
    }
}
