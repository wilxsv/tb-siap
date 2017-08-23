<?php

/* MinsalSiapsBundle:CRUD:base_list.html.twig */
class __TwigTemplate_1460a77bec5328a39db139a00bae9d3e6ba31f18f373e5ccba82895e0a358820 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'actions' => array($this, 'block_actions'),
            'side_menu' => array($this, 'block_side_menu'),
            'list_table' => array($this, 'block_list_table'),
            'table_header' => array($this, 'block_table_header'),
            'table_body' => array($this, 'block_table_body'),
            'table_footer' => array($this, 'block_table_footer'),
            'batch' => array($this, 'block_batch'),
            'batch_javascript' => array($this, 'block_batch_javascript'),
            'batch_actions' => array($this, 'block_batch_actions'),
            'list_filters' => array($this, 'block_list_filters'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate((isset($context["base_template"]) ? $context["base_template"] : $this->getContext($context, "base_template")));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_actions($context, array $blocks = array())
    {
        // line 15
        echo "    <li>";
        $this->env->loadTemplate("SonataAdminBundle:Core:create_button.html.twig")->display($context);
        echo "</li>
";
    }

    // line 18
    public function block_side_menu($context, array $blocks = array())
    {
        echo $this->env->getExtension('knp_menu')->render($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "sidemenu", array(0 => (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action"))), "method"), array("currentClass" => "active"), "list");
    }

    // line 20
    public function block_list_table($context, array $blocks = array())
    {
        // line 21
        echo "    ";
        $context["batchactions"] = $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "batchactions");
        // line 22
        echo "    ";
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "results")) > 0)) {
            // line 23
            echo "        <form action=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "batch", 1 => array("filter" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "filterParameters"))), "method"), "html", null, true);
            echo "\" method=\"POST\" >
            <table class=\"table table-bordered table-striped\">
                ";
            // line 25
            $this->displayBlock('table_header', $context, $blocks);
            // line 59
            echo "
                ";
            // line 60
            $this->displayBlock('table_body', $context, $blocks);
            // line 69
            echo "
                ";
            // line 70
            $this->displayBlock('table_footer', $context, $blocks);
            // line 173
            echo "            </table>
        </form>
    ";
        } else {
            // line 176
            echo "        <p class=\"notice\">
            ";
            // line 177
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("no_result", array(), "SonataAdminBundle"), "html", null, true);
            echo "
        </p>
    ";
        }
    }

    // line 25
    public function block_table_header($context, array $blocks = array())
    {
        // line 26
        echo "                    <thead>
                        <tr class=\"sonata-ba-list-field-header\">
                            ";
        // line 28
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "list"), "elements"));
        foreach ($context['_seq'] as $context["_key"] => $context["field_description"]) {
            // line 29
            echo "                                ";
            if ((($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "getOption", array(0 => "code"), "method") == "_batch") && (twig_length_filter($this->env, (isset($context["batchactions"]) ? $context["batchactions"] : $this->getContext($context, "batchactions"))) > 0))) {
                // line 30
                echo "                                    <th class=\"sonata-ba-list-field-header sonata-ba-list-field-header-batch\">
                                        <!-- PARA QUE NO APARESCA EL SELECCIONAR TODOS EN EL ENCABEZADO DE LA TABLA
                                      <input type=\"checkbox\" id=\"list_batch_checkbox\" />
                                        -->
                                    </th>
                                ";
            } elseif ((($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "name") == "_action") && $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "isXmlHttpRequest"))) {
                // line 36
                echo "                                        ";
                // line 37
                echo "                                ";
            } else {
                // line 38
                echo "                                    ";
                $context["sortable"] = false;
                // line 39
                echo "                                    ";
                if (($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "sortable", array(), "any", true, true) && $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options"), "sortable"))) {
                    // line 40
                    echo "                                        ";
                    $context["sortable"] = true;
                    // line 41
                    echo "                                        ";
                    $context["current"] = ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "values"), "_sort_by") == (isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")));
                    // line 42
                    echo "                                        ";
                    $context["sort_parameters"] = $this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "modelmanager"), "sortparameters", array(0 => (isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), 1 => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid")), "method");
                    // line 43
                    echo "                                        ";
                    $context["sort_active_class"] = (((isset($context["current"]) ? $context["current"] : $this->getContext($context, "current"))) ? ("sonata-ba-list-field-order-active") : (""));
                    // line 44
                    echo "                                        ";
                    $context["sort_by"] = (((isset($context["current"]) ? $context["current"] : $this->getContext($context, "current"))) ? ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "values"), "_sort_order")) : ($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options"), "_sort_order")));
                    // line 45
                    echo "                                    ";
                }
                // line 46
                echo "
                                    ";
                // line 47
                ob_start();
                // line 48
                echo "                                        <th class=\"sonata-ba-list-field-header-";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "type"), "html", null, true);
                echo " ";
                if ((isset($context["sortable"]) ? $context["sortable"] : $this->getContext($context, "sortable"))) {
                    echo " sonata-ba-list-field-header-order-";
                    echo twig_escape_filter($this->env, twig_lower_filter($this->env, (isset($context["sort_by"]) ? $context["sort_by"] : $this->getContext($context, "sort_by"))), "html", null, true);
                    echo " ";
                    echo twig_escape_filter($this->env, (isset($context["sort_active_class"]) ? $context["sort_active_class"] : $this->getContext($context, "sort_active_class")), "html", null, true);
                }
                echo "\">
                                            ";
                // line 49
                if ((isset($context["sortable"]) ? $context["sortable"] : $this->getContext($context, "sortable"))) {
                    echo "<a href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "list", 1 => (isset($context["sort_parameters"]) ? $context["sort_parameters"] : $this->getContext($context, "sort_parameters"))), "method"), "html", null, true);
                    echo "\">";
                }
                // line 50
                echo "                                            ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "trans", array(0 => $this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "label")), "method"), "html", null, true);
                echo "
                                            ";
                // line 51
                if ((isset($context["sortable"]) ? $context["sortable"] : $this->getContext($context, "sortable"))) {
                    echo "</a>";
                }
                // line 52
                echo "                                        </th>
                                    ";
                echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                // line 54
                echo "                                ";
            }
            // line 55
            echo "                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field_description'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 56
        echo "                        </tr>
                    </thead>
                ";
    }

    // line 60
    public function block_table_body($context, array $blocks = array())
    {
        // line 61
        echo "                    <tbody>
                        ";
        // line 62
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "results"));
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
        foreach ($context['_seq'] as $context["_key"] => $context["object"]) {
            // line 63
            echo "                            <tr>
                                ";
            // line 64
            $template = $this->env->resolveTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "inner_list_row"), "method"));
            $template->display($context);
            // line 65
            echo "                            </tr>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['object'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 67
        echo "                    </tbody>
                ";
    }

    // line 70
    public function block_table_footer($context, array $blocks = array())
    {
        // line 71
        echo "                    <tr>
                        <th colspan=\"";
        // line 72
        echo twig_escape_filter($this->env, (twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "list"), "elements")) - (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "isXmlHttpRequest")) ? (($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "list"), "has", array(0 => "_action"), "method") + $this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "list"), "has", array(0 => "batch"), "method"))) : (0))), "html", null, true);
        echo "\">
                            <div class=\"form-inline\">
                                ";
        // line 74
        if ((!$this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "isXmlHttpRequest"))) {
            // line 75
            echo "                                    ";
            if ((twig_length_filter($this->env, (isset($context["batchactions"]) ? $context["batchactions"] : $this->getContext($context, "batchactions"))) > 0)) {
                // line 76
                echo "                                        ";
                $this->displayBlock('batch', $context, $blocks);
                // line 104
                echo "
                                        <input type=\"submit\" class=\"btn btn-small btn-primary\" value=\"";
                // line 105
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_batch", array(), "SonataAdminBundle"), "html", null, true);
                echo "\"/>
                                    ";
            }
            // line 107
            echo "
                                    <div class=\"pull-right\">
                                        ";
            // line 109
            if ((($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => "export"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "EXPORT"), "method")) && twig_length_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getExportFormats", array(), "method")))) {
                // line 110
                echo "                                            ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label_export_download", array(), "SonataAdminBundle"), "html", null, true);
                echo "
                                            ";
                // line 111
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getExportFormats", array(), "method"));
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
                foreach ($context['_seq'] as $context["_key"] => $context["format"]) {
                    // line 112
                    echo "                                                <a href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "export", 1 => ($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "modelmanager"), "paginationparameters", array(0 => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), 1 => 0), "method") + array("format" => (isset($context["format"]) ? $context["format"] : $this->getContext($context, "format"))))), "method"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, (isset($context["format"]) ? $context["format"] : $this->getContext($context, "format")), "html", null, true);
                    echo "</a>";
                    if ((!$this->getAttribute((isset($context["loop"]) ? $context["loop"] : $this->getContext($context, "loop")), "last"))) {
                        echo ",";
                    }
                    // line 113
                    echo "                                            ";
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
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['format'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 114
                echo "
                                            &nbsp;-&nbsp;
                                        ";
            }
            // line 117
            echo "
                                        ";
            // line 118
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "pager"), "page"), "html", null, true);
            echo " / ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "pager"), "lastpage"), "html", null, true);
            echo "

                                        &nbsp;-&nbsp;

                                        ";
            // line 122
            echo $this->env->getExtension('translator')->getTranslator()->transChoice("list_results_count", $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "pager"), "nbresults"), array("%count%" => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "pager"), "nbresults")), "SonataAdminBundle");
            // line 123
            echo "
                                        &nbsp;-&nbsp;
                                        <label class=\"control-label\" for=\"";
            // line 125
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
            echo "_per_page\">";
            echo $this->env->getExtension('translator')->getTranslator()->trans("label_per_page", array(), "SonataAdminBundle");
            echo "</label>
                                        <select class=\"per-page small\" id=\"";
            // line 126
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
            echo "_per_page\" style=\"width: auto; height: auto\">
                                            ";
            // line 127
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getperpageoptions"));
            foreach ($context['_seq'] as $context["_key"] => $context["per_page"]) {
                // line 128
                echo "                                                <option ";
                if (((isset($context["per_page"]) ? $context["per_page"] : $this->getContext($context, "per_page")) == $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "pager"), "maxperpage"))) {
                    echo "selected=\"selected\"";
                }
                echo " value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "list", 1 => array("filter" => twig_array_merge($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "values"), array("_per_page" => (isset($context["per_page"]) ? $context["per_page"] : $this->getContext($context, "per_page")))))), "method"), "html", null, true);
                echo "\">
                                                    ";
                // line 129
                echo twig_escape_filter($this->env, (isset($context["per_page"]) ? $context["per_page"] : $this->getContext($context, "per_page")), "html", null, true);
                echo "
                                                </option>
                                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['per_page'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 132
            echo "                                        </select>
                                    </div>
                                ";
        }
        // line 135
        echo "                            </div>
                        </th>
                    </tr>
                    ";
        // line 138
        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "pager"), "haveToPaginate", array(), "method")) {
            // line 139
            echo "                        <tr>
                            <td colspan=\"";
            // line 140
            echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "list"), "elements")), "html", null, true);
            echo "\">
                                <div class=\"pagination pagination-centered\">
                                    <ul>
                                        ";
            // line 143
            if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "pager"), "page") != 1)) {
                // line 144
                echo "                                            <li><a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "list", 1 => $this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "modelmanager"), "paginationparameters", array(0 => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), 1 => 1), "method")), "method"), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_first_pager", array(), "SonataAdminBundle"), "html", null, true);
                echo "\">&laquo;</a></li>
                                        ";
            }
            // line 146
            echo "
                                        ";
            // line 147
            if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "pager"), "page") != $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "pager"), "previouspage"))) {
                // line 148
                echo "                                            <li><a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "list", 1 => $this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "modelmanager"), "paginationparameters", array(0 => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), 1 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "pager"), "previouspage")), "method")), "method"), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_previous_pager", array(), "SonataAdminBundle"), "html", null, true);
                echo "\">&lsaquo;</a></li>
                                        ";
            }
            // line 150
            echo "
                                        ";
            // line 152
            echo "                                        ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "pager"), "getLinks", array(), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["page"]) {
                // line 153
                echo "                                            ";
                if (((isset($context["page"]) ? $context["page"] : $this->getContext($context, "page")) == $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "pager"), "page"))) {
                    // line 154
                    echo "                                                <li class=\"active\"><a href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "list", 1 => $this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "modelmanager"), "paginationparameters", array(0 => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), 1 => (isset($context["page"]) ? $context["page"] : $this->getContext($context, "page"))), "method")), "method"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, (isset($context["page"]) ? $context["page"] : $this->getContext($context, "page")), "html", null, true);
                    echo "</a></li>
                                            ";
                } else {
                    // line 156
                    echo "                                                <li><a href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "list", 1 => $this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "modelmanager"), "paginationparameters", array(0 => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), 1 => (isset($context["page"]) ? $context["page"] : $this->getContext($context, "page"))), "method")), "method"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, (isset($context["page"]) ? $context["page"] : $this->getContext($context, "page")), "html", null, true);
                    echo "</a></li>
                                            ";
                }
                // line 158
                echo "                                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['page'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 159
            echo "
                                        ";
            // line 160
            if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "pager"), "page") != $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "pager"), "nextpage"))) {
                // line 161
                echo "                                            <li><a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "list", 1 => $this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "modelmanager"), "paginationparameters", array(0 => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), 1 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "pager"), "nextpage")), "method")), "method"), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_next_pager", array(), "SonataAdminBundle"), "html", null, true);
                echo "\">&rsaquo;</a></li>
                                        ";
            }
            // line 163
            echo "
                                        ";
            // line 164
            if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "pager"), "page") != $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "pager"), "lastpage"))) {
                // line 165
                echo "                                            <li><a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "list", 1 => $this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "modelmanager"), "paginationparameters", array(0 => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), 1 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "pager"), "lastpage")), "method")), "method"), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_last_pager", array(), "SonataAdminBundle"), "html", null, true);
                echo "\">&raquo;</a></li>
                                        ";
            }
            // line 167
            echo "                                    </ul>
                                </div>
                            </td>
                        </tr>
                    ";
        }
        // line 172
        echo "                ";
    }

    // line 76
    public function block_batch($context, array $blocks = array())
    {
        // line 77
        echo "                                            <script type=\"text/javascript\">
                                                ";
        // line 78
        $this->displayBlock('batch_javascript', $context, $blocks);
        // line 88
        echo "                                            </script>

                                            ";
        // line 90
        $this->displayBlock('batch_actions', $context, $blocks);
        // line 103
        echo "                                        ";
    }

    // line 78
    public function block_batch_javascript($context, array $blocks = array())
    {
        // line 79
        echo "                                                    jQuery(document).ready(function (\$) {
                                                        \$('#list_batch_checkbox').click(function () {
                                                            \$(this).closest('table').find(\"td input[type='checkbox']\").attr('checked', \$(this).is(':checked')).parent().parent().toggleClass('sonata-ba-list-row-selected', \$(this).is(':checked'));
                                                        });
                                                        \$(\"td.sonata-ba-list-field-batch input[type='checkbox']\").change(function () {
                                                            \$(this).parent().parent().toggleClass('sonata-ba-list-row-selected', \$(this).is(':checked'));
                                                        });
                                                    });
                                                ";
    }

    // line 90
    public function block_batch_actions($context, array $blocks = array())
    {
        // line 91
        echo "                                            <!-- PARA QUE NO APARESCA EL ELIMINAR TODOS EN LAS PLANTILLAS
                                                <label class=\"checkbox\" for=\"";
        // line 95
        echo "                                                </label>
                                            -->
                                                <select name=\"action\" style=\"width: auto; height: auto\">
                                                    ";
        // line 98
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["batchactions"]) ? $context["batchactions"] : $this->getContext($context, "batchactions")));
        foreach ($context['_seq'] as $context["action"] => $context["options"]) {
            // line 99
            echo "                                                        <option value=\"";
            echo twig_escape_filter($this->env, (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["options"]) ? $context["options"] : $this->getContext($context, "options")), "label"), "html", null, true);
            echo "</option>
                                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['action'], $context['options'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 101
        echo "                                                </select>
                                            ";
    }

    // line 182
    public function block_list_filters($context, array $blocks = array())
    {
        // line 183
        echo "    ";
        if ($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "filters")) {
            // line 184
            echo "        <form class=\"sonata-filter-form ";
            echo ((($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isChild") && (1 == twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "filters"))))) ? ("hide") : (""));
            echo "\" action=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "list"), "method"), "html", null, true);
            echo "\" method=\"GET\">
            <fieldset class=\"filter_legend\">
                <legend class=\"filter_legend ";
            // line 186
            echo (($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "hasActiveFilters")) ? ("active") : ("inactive"));
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label_filters", array(), "SonataAdminBundle"), "html", null, true);
            echo "</legend>

                <div class=\"filter_container ";
            // line 188
            echo (($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "hasActiveFilters")) ? ("active") : ("inactive"));
            echo "\">
                    <div>
                        ";
            // line 190
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "filters"));
            foreach ($context['_seq'] as $context["_key"] => $context["filter"]) {
                // line 191
                echo "                            <div class=\"clearfix\">
                                <label for=\"";
                // line 192
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "children"), $this->getAttribute((isset($context["filter"]) ? $context["filter"] : $this->getContext($context, "filter")), "formName"), array(), "array"), "children"), "value", array(), "array"), "vars"), "id"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "trans", array(0 => $this->getAttribute((isset($context["filter"]) ? $context["filter"] : $this->getContext($context, "filter")), "label")), "method"), "html", null, true);
                echo "</label>
                                ";
                // line 193
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "children"), $this->getAttribute((isset($context["filter"]) ? $context["filter"] : $this->getContext($context, "filter")), "formName"), array(), "array"), "children"), "type", array(), "array"), 'widget', array("attr" => array("class" => "span8 sonata-filter-option")));
                echo "
                                ";
                // line 194
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "children"), $this->getAttribute((isset($context["filter"]) ? $context["filter"] : $this->getContext($context, "filter")), "formName"), array(), "array"), "children"), "value", array(), "array"), 'widget', array("attr" => array("class" => "span8")));
                echo "
                            </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['filter'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 197
            echo "                    </div>

                    <input type=\"hidden\" name=\"filter[_page]\" id=\"filter__page\" value=\"1\" />

                    ";
            // line 201
            $context["foo"] = $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "children"), "_page", array(), "array"), "setRendered", array(), "method");
            // line 202
            echo "                    ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
            echo "

                    <input type=\"submit\" class=\"btn btn-primary\" value=\"";
            // line 204
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_filter", array(), "SonataAdminBundle"), "html", null, true);
            echo "\" />

                    <a class=\"btn\" href=\"";
            // line 206
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "list", 1 => array("filters" => "reset")), "method"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_reset_filter", array(), "SonataAdminBundle"), "html", null, true);
            echo "</a>
                </div>
            </fieldset>
        </form>
    ";
        }
    }

    public function getTemplateName()
    {
        return "MinsalSiapsBundle:CRUD:base_list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  595 => 193,  589 => 192,  586 => 191,  562 => 184,  556 => 182,  506 => 103,  498 => 78,  492 => 76,  473 => 165,  458 => 160,  399 => 143,  352 => 126,  346 => 125,  328 => 117,  880 => 288,  837 => 274,  827 => 270,  823 => 268,  821 => 267,  818 => 266,  789 => 251,  758 => 243,  667 => 218,  573 => 172,  567 => 170,  520 => 177,  481 => 167,  475 => 159,  472 => 158,  466 => 156,  441 => 156,  438 => 149,  432 => 147,  429 => 146,  395 => 132,  382 => 128,  378 => 132,  367 => 120,  357 => 118,  348 => 115,  334 => 110,  286 => 85,  205 => 59,  297 => 92,  218 => 64,  940 => 351,  932 => 346,  926 => 342,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 327,  888 => 326,  883 => 290,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 297,  808 => 296,  787 => 294,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 259,  740 => 239,  734 => 254,  731 => 253,  728 => 252,  725 => 251,  719 => 257,  716 => 251,  714 => 250,  711 => 249,  705 => 248,  701 => 261,  690 => 228,  687 => 246,  671 => 262,  669 => 219,  653 => 232,  634 => 224,  628 => 214,  621 => 220,  609 => 216,  602 => 206,  591 => 289,  571 => 228,  499 => 154,  488 => 172,  389 => 75,  223 => 46,  14 => 2,  306 => 95,  303 => 91,  300 => 112,  292 => 86,  280 => 87,  12 => 36,  624 => 213,  620 => 223,  612 => 220,  601 => 216,  599 => 194,  580 => 194,  574 => 230,  559 => 183,  526 => 179,  497 => 173,  485 => 124,  463 => 117,  447 => 152,  404 => 135,  401 => 144,  391 => 76,  369 => 129,  333 => 132,  329 => 65,  307 => 82,  287 => 58,  195 => 54,  178 => 46,  956 => 271,  953 => 270,  946 => 302,  942 => 300,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 301,  820 => 243,  816 => 265,  807 => 259,  805 => 295,  802 => 235,  791 => 262,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 211,  717 => 210,  713 => 209,  700 => 205,  679 => 225,  673 => 221,  668 => 197,  663 => 195,  660 => 194,  657 => 193,  650 => 231,  647 => 230,  644 => 190,  632 => 187,  629 => 186,  626 => 221,  603 => 179,  600 => 178,  594 => 212,  588 => 175,  584 => 173,  570 => 186,  561 => 168,  554 => 224,  551 => 101,  546 => 175,  522 => 156,  513 => 79,  479 => 135,  468 => 163,  451 => 120,  448 => 121,  424 => 98,  418 => 112,  410 => 113,  376 => 153,  373 => 102,  340 => 122,  326 => 129,  261 => 76,  118 => 37,  200 => 64,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 306,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 298,  1056 => 293,  1053 => 292,  1051 => 291,  1048 => 290,  1040 => 285,  1036 => 284,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 280,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 255,  961 => 254,  958 => 253,  955 => 252,  952 => 251,  950 => 269,  947 => 249,  939 => 243,  936 => 297,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 282,  889 => 224,  881 => 278,  878 => 287,  876 => 276,  873 => 217,  865 => 272,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 304,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 190,  809 => 189,  798 => 255,  796 => 254,  793 => 182,  785 => 232,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 165,  753 => 220,  751 => 265,  739 => 156,  729 => 233,  724 => 154,  721 => 258,  712 => 231,  710 => 149,  707 => 208,  699 => 142,  697 => 141,  696 => 204,  695 => 230,  694 => 138,  689 => 137,  680 => 134,  675 => 132,  662 => 217,  658 => 124,  654 => 123,  649 => 122,  643 => 227,  640 => 226,  638 => 118,  617 => 112,  614 => 201,  598 => 107,  593 => 201,  576 => 101,  564 => 162,  557 => 209,  550 => 94,  527 => 91,  515 => 305,  512 => 84,  509 => 228,  503 => 81,  496 => 79,  493 => 155,  478 => 143,  467 => 72,  456 => 154,  450 => 114,  414 => 148,  408 => 91,  388 => 138,  371 => 72,  363 => 32,  350 => 26,  342 => 123,  335 => 66,  316 => 16,  290 => 90,  276 => 109,  266 => 366,  263 => 133,  255 => 353,  245 => 70,  207 => 93,  194 => 89,  184 => 55,  76 => 70,  810 => 238,  804 => 260,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 248,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 241,  743 => 240,  735 => 238,  732 => 234,  715 => 151,  698 => 259,  693 => 248,  688 => 202,  685 => 227,  682 => 226,  672 => 223,  670 => 222,  665 => 196,  648 => 219,  627 => 206,  622 => 204,  619 => 212,  616 => 202,  613 => 210,  610 => 209,  608 => 197,  605 => 207,  596 => 106,  592 => 203,  587 => 197,  585 => 196,  582 => 190,  578 => 178,  572 => 204,  566 => 212,  547 => 93,  545 => 198,  542 => 186,  533 => 186,  531 => 95,  507 => 165,  505 => 180,  502 => 175,  477 => 164,  471 => 164,  465 => 161,  454 => 121,  446 => 156,  443 => 155,  431 => 151,  428 => 100,  425 => 152,  422 => 150,  412 => 147,  406 => 111,  390 => 139,  383 => 135,  377 => 73,  375 => 124,  372 => 122,  370 => 121,  359 => 70,  356 => 127,  353 => 69,  349 => 119,  336 => 115,  332 => 88,  330 => 103,  318 => 105,  313 => 96,  291 => 80,  190 => 56,  321 => 100,  295 => 87,  274 => 90,  242 => 121,  236 => 81,  70 => 10,  170 => 57,  288 => 79,  284 => 76,  279 => 82,  275 => 56,  256 => 74,  250 => 126,  237 => 71,  232 => 48,  222 => 64,  191 => 88,  153 => 72,  150 => 48,  563 => 211,  560 => 172,  558 => 167,  553 => 194,  549 => 182,  543 => 174,  537 => 184,  532 => 192,  528 => 91,  525 => 90,  523 => 178,  518 => 180,  514 => 167,  511 => 166,  508 => 165,  501 => 163,  491 => 171,  487 => 156,  460 => 161,  455 => 159,  449 => 158,  442 => 111,  439 => 133,  436 => 132,  433 => 154,  426 => 145,  420 => 143,  415 => 127,  411 => 120,  405 => 108,  403 => 48,  380 => 130,  366 => 150,  354 => 117,  331 => 118,  325 => 107,  320 => 87,  317 => 98,  311 => 62,  308 => 102,  304 => 81,  272 => 107,  267 => 105,  249 => 72,  216 => 71,  155 => 73,  146 => 34,  126 => 64,  188 => 54,  181 => 54,  161 => 51,  110 => 37,  124 => 39,  692 => 399,  683 => 282,  678 => 279,  676 => 265,  666 => 126,  661 => 380,  656 => 378,  652 => 376,  645 => 215,  641 => 189,  635 => 226,  631 => 218,  625 => 361,  615 => 354,  607 => 208,  597 => 177,  590 => 202,  583 => 287,  579 => 284,  577 => 188,  575 => 328,  569 => 213,  565 => 324,  555 => 166,  548 => 188,  540 => 99,  536 => 98,  529 => 191,  524 => 90,  516 => 294,  510 => 78,  504 => 90,  500 => 88,  495 => 77,  490 => 154,  486 => 165,  482 => 145,  470 => 121,  464 => 125,  459 => 116,  452 => 158,  434 => 118,  421 => 90,  417 => 142,  400 => 47,  385 => 129,  361 => 207,  344 => 113,  339 => 116,  324 => 179,  310 => 103,  302 => 93,  296 => 151,  282 => 83,  259 => 76,  244 => 83,  231 => 67,  226 => 102,  215 => 63,  186 => 51,  152 => 42,  114 => 39,  104 => 43,  358 => 103,  351 => 116,  347 => 68,  343 => 92,  338 => 130,  327 => 108,  323 => 114,  319 => 124,  315 => 98,  301 => 80,  299 => 89,  293 => 59,  289 => 94,  281 => 57,  277 => 95,  271 => 79,  265 => 51,  262 => 81,  260 => 363,  257 => 53,  251 => 72,  248 => 71,  239 => 82,  228 => 103,  225 => 65,  213 => 70,  211 => 69,  197 => 30,  174 => 63,  148 => 47,  134 => 40,  127 => 40,  20 => 1,  270 => 84,  253 => 78,  233 => 80,  212 => 62,  210 => 61,  206 => 57,  202 => 62,  198 => 72,  192 => 55,  185 => 53,  180 => 51,  175 => 81,  172 => 81,  167 => 55,  165 => 46,  160 => 44,  137 => 66,  113 => 38,  100 => 38,  90 => 22,  81 => 26,  65 => 9,  129 => 41,  97 => 26,  77 => 28,  34 => 8,  53 => 14,  84 => 27,  58 => 16,  23 => 11,  480 => 75,  474 => 122,  469 => 157,  461 => 70,  457 => 124,  453 => 151,  444 => 151,  440 => 154,  437 => 61,  435 => 148,  430 => 153,  427 => 143,  423 => 144,  413 => 241,  409 => 146,  407 => 136,  402 => 107,  398 => 88,  393 => 140,  387 => 134,  384 => 106,  381 => 157,  379 => 154,  374 => 36,  368 => 34,  365 => 119,  362 => 148,  360 => 128,  355 => 27,  341 => 67,  337 => 90,  322 => 106,  314 => 88,  312 => 97,  309 => 113,  305 => 101,  298 => 91,  294 => 100,  285 => 88,  283 => 111,  278 => 110,  268 => 373,  264 => 104,  258 => 75,  252 => 73,  247 => 75,  241 => 107,  229 => 47,  220 => 99,  214 => 63,  177 => 52,  169 => 80,  140 => 67,  132 => 36,  128 => 57,  107 => 28,  61 => 17,  273 => 84,  269 => 88,  254 => 46,  243 => 73,  240 => 67,  238 => 68,  235 => 105,  230 => 62,  227 => 76,  224 => 101,  221 => 65,  219 => 63,  217 => 86,  208 => 102,  204 => 101,  179 => 60,  159 => 50,  143 => 66,  135 => 37,  119 => 40,  102 => 27,  71 => 60,  67 => 15,  63 => 16,  59 => 13,  28 => 7,  94 => 25,  89 => 35,  85 => 23,  75 => 19,  68 => 59,  56 => 6,  87 => 21,  201 => 57,  196 => 60,  183 => 84,  171 => 48,  166 => 60,  163 => 58,  158 => 74,  156 => 75,  151 => 54,  142 => 45,  138 => 47,  136 => 43,  121 => 38,  117 => 45,  105 => 29,  91 => 23,  62 => 8,  49 => 11,  25 => 1,  21 => 2,  31 => 4,  38 => 15,  26 => 13,  24 => 14,  19 => 1,  93 => 30,  88 => 24,  78 => 173,  46 => 9,  44 => 36,  27 => 4,  79 => 29,  72 => 25,  69 => 23,  47 => 22,  40 => 6,  37 => 8,  22 => 12,  246 => 71,  157 => 56,  145 => 46,  139 => 44,  131 => 39,  123 => 63,  120 => 42,  115 => 30,  111 => 35,  108 => 30,  101 => 28,  98 => 37,  96 => 32,  83 => 176,  74 => 11,  66 => 25,  55 => 15,  52 => 12,  50 => 53,  43 => 9,  41 => 10,  35 => 14,  32 => 6,  29 => 14,  209 => 58,  203 => 32,  199 => 61,  193 => 36,  189 => 34,  187 => 69,  182 => 66,  176 => 85,  173 => 51,  168 => 50,  164 => 53,  162 => 49,  154 => 48,  149 => 72,  147 => 45,  144 => 45,  141 => 44,  133 => 42,  130 => 41,  125 => 40,  122 => 32,  116 => 36,  112 => 56,  109 => 50,  106 => 53,  103 => 25,  99 => 24,  95 => 23,  92 => 37,  86 => 177,  82 => 22,  80 => 24,  73 => 69,  64 => 20,  60 => 23,  57 => 22,  54 => 21,  51 => 20,  48 => 38,  45 => 18,  42 => 21,  39 => 20,  36 => 5,  33 => 3,  30 => 4,);
    }
}
