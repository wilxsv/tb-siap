<?php

/* MinsalLaboratorioBundle:Custom:SecSolicitudestudios/layoutC.html.twig */
class __TwigTemplate_47ac1d686f0626dde052c288b66abd278f028509b7bddbc25d8c6e1666e3a3ab extends Twig_Template
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
        echo "<div class=\"row\" style=\"font-size: 17px;padding-top: 20px;padding-bottom: 20px;\">
    <div class=\"col-md-12 col-sm-12\">
        Resultado: <strong>";
        // line 3
        if (((!(null === $this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "resultadoFinal"), "id_posible_resultado"))) || ($this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "resultadoFinal"), "id_posible_resultado") != ""))) {
            // line 4
            echo "            ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "resultadoFinal"), "nombre_posible_resultado"), "html", null, true);
            echo "
        ";
        } else {
            // line 6
            echo "            ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "resultadoFinal"), "resultado"), "html", null, true);
            echo "
        ";
        }
        // line 7
        echo "</strong>
    </div>
    ";
        // line 9
        if ((!($this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "resultadoFinal"), "id_observacion") === null))) {
            // line 10
            echo "        <div class=\"col-md-12 col-sm-12\">
            Observacion: <strong>";
            // line 11
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "resultadoFinal"), "nombre_observacion"), "html", null, true);
            echo "</strong>
        </div>
    ";
        }
        // line 14
        echo "</div>

";
        // line 16
        if ((twig_length_filter($this->env, $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "bacterias")) > 0)) {
            // line 17
            echo "    <table class=\"table\">
        <tbody>
            ";
            // line 19
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "bacterias"));
            foreach ($context['_seq'] as $context["_key"] => $context["bacteria"]) {
                // line 20
                echo "                <tr>
                    <td colspan=\"4\">
                        <div class=\"row\">
                            <div class=\"col-md-12 col-sm-12\">
                                <table class=\"heading-bact-pc\">
                                    <tbody>
                                        <tr>
                                            <td>Organismo:</td>
                                            <td style=\"padding-left:15px;\"><strong>";
                // line 28
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["bacteria"]) ? $context["bacteria"] : $this->getContext($context, "bacteria")), "nombre"), "html", null, true);
                echo "</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Cultivo con cuenta de Colonias:</td>
                                            <td style=\"padding-left:15px;\"><strong>";
                // line 32
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["bacteria"]) ? $context["bacteria"] : $this->getContext($context, "bacteria")), "cantidad"), "html", null, true);
                echo "</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr style=\"font-weight: bold;\">
                    <td></td>
                    <td>Antibiotico</td>
                    <td>Lectura</td>
                    <td>Interpretacion</td>
                </tr>
                ";
                // line 46
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["bacteria"]) ? $context["bacteria"] : $this->getContext($context, "bacteria")), "tarjetas"));
                foreach ($context['_seq'] as $context["_key"] => $context["tarjeta"]) {
                    // line 47
                    echo "                    ";
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["tarjeta"]) ? $context["tarjeta"] : $this->getContext($context, "tarjeta")), "antibioticos"));
                    foreach ($context['_seq'] as $context["_key"] => $context["antibiotico"]) {
                        // line 48
                        echo "                        <tr>
                            <td></td>
                            <td>";
                        // line 50
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["antibiotico"]) ? $context["antibiotico"] : $this->getContext($context, "antibiotico")), "nombre"), "html", null, true);
                        echo "</td>
                            <td>";
                        // line 51
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["antibiotico"]) ? $context["antibiotico"] : $this->getContext($context, "antibiotico")), "lectura"), "html", null, true);
                        echo "</td>
                            <td>
                                ";
                        // line 53
                        if (((!(null === $this->getAttribute((isset($context["antibiotico"]) ? $context["antibiotico"] : $this->getContext($context, "antibiotico")), "id_posible_resultado"))) || ($this->getAttribute((isset($context["antibiotico"]) ? $context["antibiotico"] : $this->getContext($context, "antibiotico")), "id_posible_resultado") != ""))) {
                            // line 54
                            echo "                                    ";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["antibiotico"]) ? $context["antibiotico"] : $this->getContext($context, "antibiotico")), "nombre_posible_resultado"), "html", null, true);
                            echo "
                                ";
                        } else {
                            // line 56
                            echo "                                    ";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["antibiotico"]) ? $context["antibiotico"] : $this->getContext($context, "antibiotico")), "resultado"), "html", null, true);
                            echo "
                                ";
                        }
                        // line 58
                        echo "                            </td>
                        </tr>
                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['antibiotico'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 61
                    echo "                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tarjeta'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 62
                echo "            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['bacteria'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 63
            echo "        </tbody>
    </table>
";
        }
    }

    public function getTemplateName()
    {
        return "MinsalLaboratorioBundle:Custom:SecSolicitudestudios/layoutC.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  156 => 63,  150 => 62,  144 => 61,  136 => 58,  130 => 56,  124 => 54,  122 => 53,  117 => 51,  113 => 50,  109 => 48,  104 => 47,  100 => 46,  83 => 32,  76 => 28,  66 => 20,  62 => 19,  58 => 17,  56 => 16,  52 => 14,  46 => 11,  43 => 10,  37 => 7,  31 => 6,  25 => 4,  23 => 3,  60 => 21,  54 => 20,  50 => 19,  47 => 18,  41 => 9,  35 => 14,  33 => 13,  19 => 1,);
    }
}
