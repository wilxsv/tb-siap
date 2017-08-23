<?php

/* MinsalLaboratorioBundle:Custom:SecSolicitudestudios/bodyLayout.html.twig */
class __TwigTemplate_4b76c289d25459dd87caa239b55f12ab3ad135a5bc2dd431e5818a58bb447d51 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'bodylayout' => array($this, 'block_bodylayout'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('bodylayout', $context, $blocks);
    }

    public function block_bodylayout($context, array $blocks = array())
    {
        // line 2
        echo "    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["area"]) ? $context["area"] : $this->getContext($context, "area")), "plantillas"));
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
        foreach ($context['_seq'] as $context["_key"] => $context["plantilla"]) {
            // line 3
            echo "        ";
            if (($this->getAttribute((isset($context["plantilla"]) ? $context["plantilla"] : $this->getContext($context, "plantilla")), "codigo") === (isset($context["pType"]) ? $context["pType"] : $this->getContext($context, "pType")))) {
                // line 4
                echo "            ";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["plantilla"]) ? $context["plantilla"] : $this->getContext($context, "plantilla")), "examenes"));
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
                foreach ($context['_seq'] as $context["_key"] => $context["examen"]) {
                    // line 5
                    echo "                ";
                    $context["examStatus"] = $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "codigo_estado_detalle");
                    // line 6
                    echo "                ";
                    if ((!((isset($context["examStatus"]) ? $context["examStatus"] : $this->getContext($context, "examStatus")) === "RM"))) {
                        // line 7
                        echo "                    <div class=\"bs-callout bs-callout-";
                        if (($this->getAttribute((isset($context["count"]) ? $context["count"] : $this->getContext($context, "count")), (isset($context["pType"]) ? $context["pType"] : $this->getContext($context, "pType")), array(), "array") % 2)) {
                            echo "primary";
                        } else {
                            echo "info";
                        }
                        echo "\">
                        <a data-toggle=\"collapse\" href=\"#collapse-exam-";
                        // line 8
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["area"]) ? $context["area"] : $this->getContext($context, "area")), "codigo"), "html", null, true);
                        echo "-";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["plantilla"]) ? $context["plantilla"] : $this->getContext($context, "plantilla")), "codigo"), "html", null, true);
                        echo "-";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "codigo"), "html", null, true);
                        echo "\" aria-expanded=\"false\" aria-controls=\"collapse-exam-";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["area"]) ? $context["area"] : $this->getContext($context, "area")), "codigo"), "html", null, true);
                        echo "-";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["plantilla"]) ? $context["plantilla"] : $this->getContext($context, "plantilla")), "codigo"), "html", null, true);
                        echo "-";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "codigo"), "html", null, true);
                        echo "\">
                            ";
                        // line 9
                        $this->env->loadTemplate("MinsalLaboratorioBundle:Custom:SecSolicitudestudios/headerLayout.html.twig")->display($context);
                        // line 10
                        echo "                        </a>

                        <div class=\"collapse\" id=\"collapse-exam-";
                        // line 12
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["area"]) ? $context["area"] : $this->getContext($context, "area")), "codigo"), "html", null, true);
                        echo "-";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["plantilla"]) ? $context["plantilla"] : $this->getContext($context, "plantilla")), "codigo"), "html", null, true);
                        echo "-";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "codigo"), "html", null, true);
                        echo "\">
                            ";
                        // line 13
                        if (((isset($context["examStatus"]) ? $context["examStatus"] : $this->getContext($context, "examStatus")) === "RC")) {
                            // line 14
                            echo "                                ";
                            $template = $this->env->resolveTemplate((("MinsalLaboratorioBundle:Custom:SecSolicitudestudios/layout" . (isset($context["pType"]) ? $context["pType"] : $this->getContext($context, "pType"))) . ".html.twig"));
                            $template->display($context);
                            // line 15
                            echo "                            ";
                        }
                        // line 16
                        echo "                        </div>
                    </div>
                    ";
                        // line 18
                        $context["count"] = twig_array_merge((isset($context["count"]) ? $context["count"] : $this->getContext($context, "count")), array(("" . (isset($context["pType"]) ? $context["pType"] : $this->getContext($context, "pType"))) => ($this->getAttribute((isset($context["count"]) ? $context["count"] : $this->getContext($context, "count")), (isset($context["pType"]) ? $context["pType"] : $this->getContext($context, "pType")), array(), "array") + 1)));
                        // line 19
                        echo "                ";
                    }
                    // line 20
                    echo "            ";
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
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['examen'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 21
                echo "        ";
            }
            // line 22
            echo "    ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['plantilla'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "MinsalLaboratorioBundle:Custom:SecSolicitudestudios/bodyLayout.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  143 => 22,  140 => 21,  126 => 20,  123 => 19,  121 => 18,  117 => 16,  114 => 15,  110 => 14,  108 => 13,  100 => 12,  96 => 10,  94 => 9,  80 => 8,  71 => 7,  68 => 6,  65 => 5,  47 => 4,  44 => 3,  26 => 2,  20 => 1,  470 => 201,  463 => 196,  460 => 195,  442 => 190,  428 => 189,  425 => 188,  422 => 187,  419 => 186,  401 => 185,  398 => 184,  390 => 180,  384 => 177,  375 => 175,  371 => 173,  369 => 172,  366 => 171,  363 => 170,  360 => 169,  357 => 168,  354 => 167,  351 => 166,  348 => 165,  346 => 164,  343 => 163,  340 => 162,  337 => 161,  334 => 160,  331 => 159,  328 => 158,  325 => 157,  323 => 156,  320 => 155,  317 => 154,  314 => 153,  311 => 152,  308 => 151,  305 => 150,  303 => 149,  300 => 148,  298 => 147,  295 => 146,  292 => 145,  289 => 144,  286 => 143,  283 => 142,  280 => 141,  277 => 140,  259 => 139,  257 => 138,  248 => 134,  237 => 125,  233 => 123,  230 => 122,  221 => 119,  217 => 118,  213 => 117,  210 => 116,  205 => 115,  203 => 114,  177 => 91,  170 => 87,  163 => 83,  156 => 79,  149 => 75,  142 => 71,  135 => 67,  118 => 52,  107 => 43,  104 => 42,  101 => 41,  77 => 21,  74 => 20,  66 => 16,  63 => 15,  60 => 14,  52 => 10,  49 => 9,  46 => 8,  40 => 5,  35 => 4,  32 => 3,);
    }
}
