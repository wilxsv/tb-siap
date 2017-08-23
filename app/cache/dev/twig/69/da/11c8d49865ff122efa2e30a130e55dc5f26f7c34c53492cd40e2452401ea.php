<?php

/* MinsalLaboratorioBundle:Custom:SecSolicitudestudios/layoutA.html.twig */
class __TwigTemplate_69da11c8d49865ff122efa2e30a130e55dc5f26f7c34c53492cd40e2452401ea extends Twig_Template
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
        echo "<table class=\"table\">
    <thead>
        <tr>
            <th>Resultado</th>
            <th>Unidades</th>
            <th>Rangos Normales</th>
            <th>Observacion</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                ";
        // line 13
        if (((!(null === $this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "resultadoFinal"), "id_posible_resultado"))) || ($this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "resultadoFinal"), "id_posible_resultado") != ""))) {
            // line 14
            echo "                    ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "resultadoFinal"), "nombre_posible_resultado"), "html", null, true);
            echo "
                ";
        } else {
            // line 16
            echo "                    ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "resultadoFinal"), "resultado"), "html", null, true);
            echo "
                ";
        }
        // line 18
        echo "            </td>
            <td>";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "resultadoFinal"), "unidad"), "html", null, true);
        echo "</td>
            <td>";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "resultadoFinal"), "rango_inicio"), "html", null, true);
        echo "-";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "resultadoFinal"), "rango_fin"), "html", null, true);
        echo "</td>
            <td>";
        // line 21
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "resultadoFinal"), "observacion"), "html", null, true);
        echo "</td>
        </tr>
    </tbody>
</table>
";
    }

    public function getTemplateName()
    {
        return "MinsalLaboratorioBundle:Custom:SecSolicitudestudios/layoutA.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  60 => 21,  54 => 20,  50 => 19,  47 => 18,  41 => 16,  35 => 14,  33 => 13,  19 => 1,);
    }
}
