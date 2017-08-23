<?php

/* MinsalSeguimientoBundle:SecAntecedentes:showespe.html.twig */
class __TwigTemplate_4690ecc25293819ebecce02c160ee26dcc61478068facaf4164be6018e110d63 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:action.html.twig");

        $this->blocks = array(
            'sonata_header' => array($this, 'block_sonata_header'),
            'actions' => array($this, 'block_actions'),
            'tab_menu' => array($this, 'block_tab_menu'),
            'content' => array($this, 'block_content'),
            'show' => array($this, 'block_show'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:action.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_sonata_header($context, array $blocks = array())
    {
        // line 3
        echo "
";
    }

    // line 5
    public function block_actions($context, array $blocks = array())
    {
        // line 6
        echo "
";
    }

    // line 9
    public function block_tab_menu($context, array $blocks = array())
    {
    }

    // line 10
    public function block_content($context, array $blocks = array())
    {
    }

    // line 12
    public function block_show($context, array $blocks = array())
    {
        // line 13
        echo "    <div class=\"container-fluid\">
        <div class=\"row\">
            <div class=\"pull-right\">
                ";
        // line 16
        if (((($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => "edit"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")) && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "EDIT", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")) && ((isset($context["noEdit"]) ? $context["noEdit"] : $this->getContext($context, "noEdit")) == false))) {
            // line 17
            echo "                    <a class=\"btn btn-primary sonata-action-element\" href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "editespe", 1 => array("id" => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getId", array(), "method"), "idatenareamodestab" => (isset($context["idatenareamodestab"]) ? $context["idatenareamodestab"] : $this->getContext($context, "idatenareamodestab")))), "method"), "html", null, true);
            echo "\">
                        <i class=\"fa fa-edit\"></i>
                        &nbsp;&nbsp;";
            // line 19
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_action_edit", array(), "SonataAdminBundle"), "html", null, true);
            echo "&nbsp;&nbsp;&nbsp;</a>
                ";
        }
        // line 21
        echo "                <button type=\"button\" class=\"btn btn-default\" onclick=\"window.close();\"><i class=\"fa fa-fw fa-times-circle\"></i> &nbsp;Cerrar&nbsp;</button>
            </div>
        </div>
    </div><br/>
    <div class=\"sonata-ba-view\">

        ";
        // line 27
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["savedData"]) ? $context["savedData"] : $this->getContext($context, "savedData")));
        foreach ($context['_seq'] as $context["_key"] => $context["section"]) {
            echo " ";
            // line 28
            echo "        ";
            $context["colspan"] = "2";
            // line 29
            echo "            <div class=\"panel panel-info\">
                <div class=\"panel-heading\"><b style=\"font-size: 17;\">";
            // line 30
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["section"]) ? $context["section"] : $this->getContext($context, "section")), "name"), "html", null, true);
            echo "</b> ";
            // line 31
            echo "                </div>
                    <div class=\"table-responsive\" style=\"overflow-x: auto;\">
                        <table class=\"table table-bordered table-hover\" style=\"font-size: 14px;\">
                            <tbody>
                                ";
            // line 35
            if ($this->getAttribute((isset($context["section"]) ? $context["section"] : $this->getContext($context, "section")), "isCollection")) {
                echo " ";
                // line 36
                echo "                                    ";
                if (($this->getAttribute((isset($context["section"]) ? $context["section"] : null), "collection", array(), "any", true, true) && (twig_length_filter($this->env, $this->getAttribute((isset($context["section"]) ? $context["section"] : $this->getContext($context, "section")), "collection")) > 0))) {
                    // line 37
                    echo "                                        ";
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["section"]) ? $context["section"] : $this->getContext($context, "section")), "collection"));
                    foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                        echo " ";
                        // line 38
                        echo "                                            <tr class=\"sonata-ba-view-container\">
                                                ";
                        // line 39
                        $context['_parent'] = (array) $context;
                        $context['_seq'] = twig_ensure_traversable((isset($context["row"]) ? $context["row"] : $this->getContext($context, "row")));
                        foreach ($context['_seq'] as $context["item"] => $context["data"]) {
                            echo " ";
                            // line 40
                            echo "                                                    <th>";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "name"), "html", null, true);
                            echo "</th>
                                                    <td>";
                            // line 41
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "value"), "html", null, true);
                            echo "</td>
                                                ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['item'], $context['data'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 43
                        echo "                                            </tr>
                                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 45
                    echo "                                     ";
                } else {
                    // line 46
                    echo "                                        <tr><td><p class=\"text-muted\">No hay registros para mostrar.</p></td></tr>
                                    ";
                }
                // line 48
                echo "                                ";
            } else {
                // line 49
                echo "                                    ";
                if (($this->getAttribute((isset($context["section"]) ? $context["section"] : null), "items", array(), "any", true, true) && (twig_length_filter($this->env, $this->getAttribute((isset($context["section"]) ? $context["section"] : $this->getContext($context, "section")), "items")) > 0))) {
                    // line 50
                    echo "                                        ";
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["section"]) ? $context["section"] : $this->getContext($context, "section")), "items"));
                    foreach ($context['_seq'] as $context["item"] => $context["data"]) {
                        echo " ";
                        // line 51
                        echo "                                            ";
                        if (((isset($context["colspan"]) ? $context["colspan"] : $this->getContext($context, "colspan")) == "2")) {
                            // line 52
                            echo "                                                <tr class=\"sonata-ba-view-container\">
                                            ";
                        }
                        // line 54
                        echo "                                                ";
                        if ($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "multiple", array(), "any", true, true)) {
                            echo "  ";
                            // line 55
                            echo "                                                    <th style=\"min-width: 400px; padding-left: ";
                            echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "multiple"), "level") * 10), "html", null, true);
                            echo "px;\">";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "multiple"), "name"), "html", null, true);
                            echo "</th>
                                                    <td>
                                                        ";
                            // line 57
                            if ($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "multiple"), "hideTitle")) {
                                // line 58
                                echo "                                                            ";
                                if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "multiple"), "value")) > 0)) {
                                    // line 59
                                    echo "                                                                ";
                                    $context["answer"] = "Sí";
                                    // line 60
                                    echo "                                                            ";
                                } else {
                                    // line 61
                                    echo "                                                                ";
                                    $context["answer"] = "No";
                                    // line 62
                                    echo "                                                            ";
                                }
                                // line 63
                                echo "
                                                            ";
                                // line 64
                                echo twig_escape_filter($this->env, (isset($context["answer"]) ? $context["answer"] : $this->getContext($context, "answer")), "html", null, true);
                                echo "
                                                        ";
                            } else {
                                // line 66
                                echo "                                                            <ul>
                                                                ";
                                // line 67
                                $context['_parent'] = (array) $context;
                                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "multiple"), "value"));
                                foreach ($context['_seq'] as $context["_key"] => $context["subData"]) {
                                    // line 68
                                    echo "                                                                    <li>";
                                    echo twig_escape_filter($this->env, (isset($context["subData"]) ? $context["subData"] : $this->getContext($context, "subData")), "html", null, true);
                                    echo "</li>
                                                                ";
                                }
                                $_parent = $context['_parent'];
                                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['subData'], $context['_parent'], $context['loop']);
                                $context = array_intersect_key($context, $_parent) + $_parent;
                                // line 70
                                echo "                                                            </ul>
                                                        ";
                            }
                            // line 72
                            echo "
                                                    </td>
                                                ";
                        } else {
                            // line 74
                            echo " ";
                            // line 75
                            echo "                                                    ";
                            if ($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "hideTitle")) {
                                // line 76
                                echo "                                                        ";
                                if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "itemObject"), "getIdFormItem", array(), "method"), "getIdTipoObjeto", array(), "method"), "getId", array(), "method") == 3)) {
                                    // line 77
                                    echo "                                                            ";
                                    $context["colspan"] = "1";
                                    // line 78
                                    echo "                                                            <th colspan=\"";
                                    echo twig_escape_filter($this->env, (isset($context["colspan"]) ? $context["colspan"] : $this->getContext($context, "colspan")), "html", null, true);
                                    echo "\" style=\"min-width: 400px; padding-left: ";
                                    echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "level") * 10), "html", null, true);
                                    echo "px;\">";
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "name"), "html", null, true);
                                    echo "</th>
                                                        ";
                                } else {
                                    // line 80
                                    echo "                                                            <td colspan=\"";
                                    echo twig_escape_filter($this->env, (isset($context["colspan"]) ? $context["colspan"] : $this->getContext($context, "colspan")), "html", null, true);
                                    echo "\" style=\"min-width: 250px;\">";
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "value"), "html", null, true);
                                    echo "</td>
                                                            ";
                                    // line 81
                                    $context["colspan"] = "2";
                                    // line 82
                                    echo "                                                            <!-- <td><span>";
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "value"), "html", null, true);
                                    echo "</span></td> -->
                                                        ";
                                }
                                // line 84
                                echo "                                                    ";
                            } else {
                                // line 85
                                echo "                                                        ";
                                if (((isset($context["colspan"]) ? $context["colspan"] : $this->getContext($context, "colspan")) == "1")) {
                                    // line 86
                                    echo "                                                                <td colspan=\"";
                                    echo twig_escape_filter($this->env, (isset($context["colspan"]) ? $context["colspan"] : $this->getContext($context, "colspan")), "html", null, true);
                                    echo "\" style=\"min-width: 250px;\"></td>
                                                            </tr>
                                                            <tr class=\"sonata-ba-view-container\">
                                                            ";
                                    // line 89
                                    $context["colspan"] = "2";
                                    // line 90
                                    echo "                                                        ";
                                }
                                // line 91
                                echo "                                                        <th style=\"min-width: 400px; padding-left: ";
                                echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "level") * 10), "html", null, true);
                                echo "px;\">";
                                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "name"), "html", null, true);
                                echo "</th>
                                                        <td><span>";
                                // line 92
                                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "value"), "html", null, true);
                                echo "</span></td>
                                                    ";
                            }
                            // line 94
                            echo "                                                ";
                        }
                        // line 95
                        echo "                                            ";
                        if (((isset($context["colspan"]) ? $context["colspan"] : $this->getContext($context, "colspan")) == "2")) {
                            // line 96
                            echo "                                                </tr>
                                            ";
                        }
                        // line 98
                        echo "                                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['item'], $context['data'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 99
                    echo "                                    ";
                } else {
                    // line 100
                    echo "                                        <tr><td><p class=\"text-muted\">No hay registros para mostrar.</p></td></tr>
                                    ";
                }
                // line 102
                echo "
                                ";
            }
            // line 104
            echo "                            </tbody>
                        </table>
                    </div>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['section'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 109
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "MinsalSeguimientoBundle:SecAntecedentes:showespe.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  338 => 109,  328 => 104,  324 => 102,  320 => 100,  317 => 99,  311 => 98,  307 => 96,  304 => 95,  301 => 94,  296 => 92,  289 => 91,  286 => 90,  284 => 89,  277 => 86,  274 => 85,  271 => 84,  265 => 82,  263 => 81,  256 => 80,  246 => 78,  243 => 77,  240 => 76,  237 => 75,  235 => 74,  230 => 72,  226 => 70,  217 => 68,  213 => 67,  210 => 66,  205 => 64,  202 => 63,  199 => 62,  196 => 61,  193 => 60,  190 => 59,  187 => 58,  185 => 57,  177 => 55,  173 => 54,  169 => 52,  166 => 51,  160 => 50,  157 => 49,  154 => 48,  150 => 46,  147 => 45,  140 => 43,  132 => 41,  127 => 40,  122 => 39,  119 => 38,  113 => 37,  110 => 36,  107 => 35,  101 => 31,  98 => 30,  95 => 29,  92 => 28,  87 => 27,  79 => 21,  74 => 19,  68 => 17,  66 => 16,  61 => 13,  58 => 12,  53 => 10,  48 => 9,  43 => 6,  40 => 5,  35 => 3,  32 => 2,);
    }
}
