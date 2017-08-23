<?php

/* MinsalSiapsBundle:Form:form_admin_fields.html.twig */
class __TwigTemplate_fd47ea5b38e4c5e4cc88ec701debf3f2e79d322560913c13322fa7c2c9d194b9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig");

        $this->blocks = array(
            'field_row' => array($this, 'block_field_row'),
            'label' => array($this, 'block_label'),
            'repeated_row' => array($this, 'block_repeated_row'),
            'sonata_admin_orm_one_to_many_widget' => array($this, 'block_sonata_admin_orm_one_to_many_widget'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_field_row($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        if ((((!array_key_exists("sonata_admin", $context)) || (!(isset($context["sonata_admin_enabled"]) ? $context["sonata_admin_enabled"] : $this->getContext($context, "sonata_admin_enabled")))) || (!$this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description")))) {
            // line 5
            echo "        ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'label', (twig_test_empty($_label_ = ((array_key_exists("label", $context)) ? (_twig_default_filter((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), null)) : (null))) ? array() : array("label" => $_label_)));
            echo "
        ";
            // line 6
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
            echo "
        ";
            // line 7
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
            echo "
    ";
        } else {
            // line 9
            echo "        <div class=\"control-group";
            if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors"))) > 0)) {
                echo " error";
            }
            echo "\" id=\"sonata-ba-field-container-";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
            echo "\">
            ";
            // line 10
            $this->displayBlock('label', $context, $blocks);
            // line 17
            echo "
            <div class=\"controls sonata-ba-field sonata-ba-field-";
            // line 18
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "edit"), "html", null, true);
            echo "-";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "inline"), "html", null, true);
            echo " ";
            if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors"))) > 0)) {
                echo "sonata-ba-field-error";
            }
            echo "\">
                ";
            // line 19
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
            echo "

                ";
            // line 21
            if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors"))) > 0)) {
                echo "                                        
                    <i class=\"ui-icon ui-icon-alert\" data-title=\"";
                // line 22
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("error"), "html", null, true);
                echo "\" data-content=\"";
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
                echo "\" style=\"display: inline-block\"></i>
                ";
            }
            // line 24
            echo "
                ";
            // line 25
            if ($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description"), "help")) {
                // line 26
                echo "                    <span class=\"help-block sonata-ba-field-help\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description"), "help"), "html", null, true);
                echo "</span>
                ";
            }
            // line 28
            echo "            </div>
        </div>
    ";
        }
    }

    // line 10
    public function block_label($context, array $blocks = array())
    {
        // line 11
        echo "                ";
        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array(), "any", false, true), "options", array(), "any", false, true), "name", array(), "any", true, true)) {
            // line 12
            echo "                    ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'label', array("attr" => array("class" => "control-label")) + (twig_test_empty($_label_ = $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description"), "options"), "name")) ? array() : array("label" => $_label_)));
            echo "
                ";
        } else {
            // line 14
            echo "                    ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'label', array("attr" => array("class" => "control-label")) + (twig_test_empty($_label_ = ((array_key_exists("label", $context)) ? (_twig_default_filter((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), null)) : (null))) ? array() : array("label" => $_label_)));
            echo "
                ";
        }
        // line 16
        echo "            ";
    }

    // line 34
    public function block_repeated_row($context, array $blocks = array())
    {
        // line 35
        echo "    <div class=\"control-group";
        if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors"))) > 0)) {
            echo " error";
        }
        echo "\" id=\"sonata-ba-field-container-";
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
        echo "\">
        ";
        // line 36
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "first"), 'label', array("attr" => array("class" => "control-label")) + (twig_test_empty($_label_ = ((array_key_exists("label", $context)) ? (_twig_default_filter((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), null)) : (null))) ? array() : array("label" => $_label_)));
        echo "

        <div class=\"controls sonata-ba-field sonata-ba-field-";
        // line 38
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "edit"), "html", null, true);
        echo "-";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "inline"), "html", null, true);
        echo " ";
        if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors"))) > 0)) {
            echo "sonata-ba-field-error";
        }
        echo "\">

            ";
        // line 40
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "first"), 'widget');
        echo "

            ";
        // line 42
        if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors"))) > 0)) {
            // line 43
            echo "                <div class=\"help-inline sonata-ba-field-error-messages\">
                    ";
            // line 44
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "first"), 'errors');
            echo "
                </div>
            ";
        }
        // line 47
        echo "
            ";
        // line 48
        if ($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description"), "help")) {
            // line 49
            echo "                <span class=\"help-block sonata-ba-field-help\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description"), "help"), "html", null, true);
            echo "</span>
            ";
        }
        // line 51
        echo "        </div>
    </div>
    <div class=\"control-group";
        // line 53
        if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors"))) > 0)) {
            echo " error";
        }
        echo "\" id=\"sonata-ba-field-container-";
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
        echo "\">
        ";
        // line 54
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "second"), 'label', array("attr" => array("class" => "control-label")) + (twig_test_empty($_label_ = (($this->getAttribute((isset($context["label"]) ? $context["label"] : null), "second", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label"]) ? $context["label"] : null), "second"), null)) : (null))) ? array() : array("label" => $_label_)));
        echo "

        <div class=\"controls sonata-ba-field sonata-ba-field-";
        // line 56
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "edit"), "html", null, true);
        echo "-";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "inline"), "html", null, true);
        echo " ";
        if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors"))) > 0)) {
            echo "sonata-ba-field-error";
        }
        echo "\">

            ";
        // line 58
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "second"), 'widget');
        echo "

            ";
        // line 60
        if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors"))) > 0)) {
            // line 61
            echo "                <div class=\"help-inline sonata-ba-field-error-messages\">
                    ";
            // line 62
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "second"), 'errors');
            echo "
                </div>
            ";
        }
        // line 65
        echo "
            ";
        // line 66
        if ($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description"), "help")) {
            // line 67
            echo "                <span class=\"help-block sonata-ba-field-help\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description"), "help"), "html", null, true);
            echo "</span>
            ";
        }
        // line 69
        echo "        </div>
    </div>
";
    }

    // line 72
    public function block_sonata_admin_orm_one_to_many_widget($context, array $blocks = array())
    {
        // line 73
        echo "    ";
        $this->env->loadTemplate("MinsalSiapsBundle:CRUD:edit_orm_one_to_many.html.twig")->display($context);
    }

    public function getTemplateName()
    {
        return "MinsalSiapsBundle:Form:form_admin_fields.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  250 => 73,  247 => 72,  241 => 69,  235 => 67,  233 => 66,  230 => 65,  224 => 62,  221 => 61,  219 => 60,  214 => 58,  203 => 56,  198 => 54,  190 => 53,  186 => 51,  180 => 49,  178 => 48,  175 => 47,  169 => 44,  166 => 43,  164 => 42,  159 => 40,  143 => 36,  134 => 35,  131 => 34,  127 => 16,  121 => 14,  115 => 12,  112 => 11,  109 => 10,  102 => 28,  96 => 26,  94 => 25,  91 => 24,  75 => 19,  65 => 18,  62 => 17,  51 => 9,  46 => 7,  37 => 5,  31 => 3,  624 => 282,  621 => 281,  616 => 276,  613 => 275,  609 => 273,  593 => 270,  589 => 267,  583 => 266,  580 => 265,  574 => 263,  571 => 262,  568 => 261,  564 => 260,  561 => 259,  555 => 257,  553 => 256,  550 => 255,  545 => 253,  540 => 252,  538 => 251,  530 => 248,  520 => 247,  516 => 245,  513 => 244,  511 => 243,  507 => 241,  503 => 238,  495 => 233,  477 => 232,  474 => 231,  469 => 228,  466 => 227,  459 => 289,  456 => 288,  452 => 286,  450 => 281,  445 => 279,  442 => 278,  440 => 275,  437 => 274,  435 => 231,  432 => 230,  430 => 227,  427 => 226,  421 => 223,  418 => 222,  416 => 221,  413 => 220,  409 => 219,  394 => 217,  391 => 216,  387 => 215,  384 => 214,  378 => 211,  375 => 210,  373 => 209,  370 => 208,  368 => 207,  362 => 205,  359 => 204,  314 => 162,  303 => 159,  295 => 154,  291 => 153,  287 => 152,  283 => 151,  270 => 150,  266 => 149,  260 => 146,  248 => 139,  242 => 136,  229 => 135,  216 => 134,  212 => 133,  208 => 132,  200 => 127,  196 => 125,  192 => 124,  184 => 118,  157 => 93,  155 => 92,  148 => 38,  100 => 42,  97 => 41,  93 => 39,  88 => 37,  84 => 22,  80 => 21,  76 => 34,  72 => 33,  67 => 30,  64 => 29,  60 => 10,  58 => 26,  42 => 6,  39 => 13,  34 => 4,);
    }
}
