<?php

/* MinsalSeguimientoBundle:SecHistorialClinico:historias_clinicas_pre_show.html.twig */
class __TwigTemplate_3ca4fc6dd668eb63637b4447b1b59d4678d6c3415f2ef561bf39f9f96a8bb8c1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'javascripts' => array($this, 'block_javascripts'),
            'sonata_header' => array($this, 'block_sonata_header'),
            'actions' => array($this, 'block_actions'),
            'tab_menu' => array($this, 'block_tab_menu'),
            'list_table' => array($this, 'block_list_table'),
            'list_header' => array($this, 'block_list_header'),
            'table_header' => array($this, 'block_table_header'),
            'table_body' => array($this, 'block_table_body'),
            'table_footer' => array($this, 'block_table_footer'),
            'batch' => array($this, 'block_batch'),
            'batch_javascript' => array($this, 'block_batch_javascript'),
            'batch_actions' => array($this, 'block_batch_actions'),
            'pager_results' => array($this, 'block_pager_results'),
            'pager_links' => array($this, 'block_pager_links'),
            'list_footer' => array($this, 'block_list_footer'),
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
    public function block_javascripts($context, array $blocks = array())
    {
        // line 15
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    ";
        // line 16
        $this->env->loadTemplate("MinsalSeguimientoBundle:SecHistorialClinico:requestParameters.html.twig")->display($context);
        // line 17
        echo "    <script type=\"text/javascript\">
        jQuery(document).ready(function (\$) {

        });

        function setSelectedListItem(id){
            window.opener.setHistoriaSeguimiento(id);
            window.close();
        };
    </script>
";
    }

    // line 29
    public function block_sonata_header($context, array $blocks = array())
    {
        // line 30
        echo "   ";
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == false)) {
            // line 31
            echo "       ";
            $this->displayParentBlock("sonata_header", $context, $blocks);
            echo "
   ";
        }
    }

    // line 35
    public function block_actions($context, array $blocks = array())
    {
        // line 36
        echo "   ";
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == false)) {
            // line 37
            echo "       <li>";
            $this->env->loadTemplate("SonataAdminBundle:Button:create_button.html.twig")->display($context);
            echo "</li>
   ";
        }
    }

    // line 41
    public function block_tab_menu($context, array $blocks = array())
    {
        echo $this->env->getExtension('knp_menu')->render($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "sidemenu", array(0 => (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action"))), "method"), array("currentClass" => "active"), "list");
    }

    // line 44
    public function block_list_table($context, array $blocks = array())
    {
        // line 45
        echo "    ";
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == true)) {
            // line 46
            echo "        <div class=\"container-fluid\">
            <div class=\"row\">
                <div class=\"pull-right\">
                    <button type=\"button\" class=\"btn btn-default\" onclick=\"window.close();\"><i class=\"fa fa-fw fa-times-circle\"></i> &nbsp;Cerrar&nbsp;</button>
                </div>
            </div>
        </div><br/>
    ";
        }
        // line 54
        echo "    <div class=\"box box-primary\">
        <div class=\"box-body table-responsive no-padding\">
            ";
        // line 56
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("sonata.admin.list.table.top", array("admin" => (isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")))));
        echo "

            ";
        // line 58
        $this->displayBlock('list_header', $context, $blocks);
        // line 59
        echo "
            ";
        // line 60
        $context["batchactions"] = $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "batchactions");
        // line 61
        echo "            ";
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "results")) > 0)) {
            // line 62
            echo "                ";
            if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => "batch"), "method")) {
                // line 63
                echo "                <form action=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "batch", 1 => array("filter" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "filterParameters"))), "method"), "html", null, true);
                echo "\" method=\"POST\" >
                    <input type=\"hidden\" name=\"_sonata_csrf_token\" value=\"";
                // line 64
                echo twig_escape_filter($this->env, (isset($context["csrf_token"]) ? $context["csrf_token"] : $this->getContext($context, "csrf_token")), "html", null, true);
                echo "\">
                ";
            }
            // line 66
            echo "                    <table class=\"table table-bordered table-striped\">
                        ";
            // line 67
            $this->displayBlock('table_header', $context, $blocks);
            // line 103
            echo "
                        ";
            // line 104
            $this->displayBlock('table_body', $context, $blocks);
            // line 113
            echo "
                        ";
            // line 114
            $this->displayBlock('table_footer', $context, $blocks);
            // line 202
            echo "                    </table>
                ";
            // line 203
            if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => "batch"), "method")) {
                // line 204
                echo "                </form>
                ";
            }
            // line 206
            echo "            ";
        } else {
            // line 207
            echo "                <div class=\"callout callout-info\">
                    ";
            // line 208
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("no_result", array(), "SonataAdminBundle"), "html", null, true);
            echo "
                </div>
            ";
        }
        // line 211
        echo "
            ";
        // line 212
        $this->displayBlock('list_footer', $context, $blocks);
        // line 213
        echo "
            ";
        // line 214
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("sonata.admin.list.table.bottom", array("admin" => (isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")))));
        echo "


        </div>
    </div>
";
    }

    // line 58
    public function block_list_header($context, array $blocks = array())
    {
    }

    // line 67
    public function block_table_header($context, array $blocks = array())
    {
        // line 68
        echo "                            <thead>
                                <tr class=\"sonata-ba-list-field-header\">
                                    ";
        // line 70
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "list"), "elements"));
        foreach ($context['_seq'] as $context["_key"] => $context["field_description"]) {
            // line 71
            echo "                                        ";
            if ((($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => "batch"), "method") && ($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "getOption", array(0 => "code"), "method") == "_batch")) && (twig_length_filter($this->env, (isset($context["batchactions"]) ? $context["batchactions"] : $this->getContext($context, "batchactions"))) > 0))) {
                // line 72
                echo "                                            <th class=\"sonata-ba-list-field-header sonata-ba-list-field-header-batch\">
                                              <input type=\"checkbox\" id=\"list_batch_checkbox\">
                                            </th>
                                        ";
            } elseif (($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "getOption", array(0 => "code"), "method") == "_select")) {
                // line 76
                echo "                                            <th class=\"sonata-ba-list-field-header sonata-ba-list-field-header-select\"></th>
                                        ";
            } elseif ((($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "name") == "_action") && $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "isXmlHttpRequest"))) {
                // line 78
                echo "                                            ";
                // line 79
                echo "                                        ";
            } elseif ((($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "getOption", array(0 => "ajax_hidden"), "method") == true) && $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "isXmlHttpRequest"))) {
                // line 80
                echo "                                            ";
                // line 81
                echo "                                        ";
            } else {
                // line 82
                echo "                                            ";
                $context["sortable"] = false;
                // line 83
                echo "                                            ";
                if (($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "sortable", array(), "any", true, true) && $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options"), "sortable"))) {
                    // line 84
                    echo "                                                ";
                    $context["sortable"] = true;
                    // line 85
                    echo "                                                ";
                    $context["sort_parameters"] = $this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "modelmanager"), "sortparameters", array(0 => (isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), 1 => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid")), "method");
                    // line 86
                    echo "                                                ";
                    $context["current"] = (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "values"), "_sort_by") == (isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description"))) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "values"), "_sort_by"), "fieldName") == $this->getAttribute($this->getAttribute((isset($context["sort_parameters"]) ? $context["sort_parameters"] : $this->getContext($context, "sort_parameters")), "filter"), "_sort_by")));
                    // line 87
                    echo "                                                ";
                    $context["sort_active_class"] = (((isset($context["current"]) ? $context["current"] : $this->getContext($context, "current"))) ? ("sonata-ba-list-field-order-active") : (""));
                    // line 88
                    echo "                                                ";
                    $context["sort_by"] = (((isset($context["current"]) ? $context["current"] : $this->getContext($context, "current"))) ? ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "values"), "_sort_order")) : ($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options"), "_sort_order")));
                    // line 89
                    echo "                                            ";
                }
                // line 90
                echo "
                                            ";
                // line 91
                ob_start();
                // line 92
                echo "                                                <th class=\"sonata-ba-list-field-header-";
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
                // line 93
                if ((isset($context["sortable"]) ? $context["sortable"] : $this->getContext($context, "sortable"))) {
                    echo "<a href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "list", 1 => (isset($context["sort_parameters"]) ? $context["sort_parameters"] : $this->getContext($context, "sort_parameters"))), "method"), "html", null, true);
                    echo "\">";
                }
                // line 94
                echo "                                                    ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "trans", array(0 => $this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "label"), 1 => array(), 2 => $this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "translationDomain")), "method"), "html", null, true);
                echo "
                                                    ";
                // line 95
                if ((isset($context["sortable"]) ? $context["sortable"] : $this->getContext($context, "sortable"))) {
                    echo "</a>";
                }
                // line 96
                echo "                                                </th>
                                            ";
                echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                // line 98
                echo "                                        ";
            }
            // line 99
            echo "                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field_description'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 100
        echo "                                </tr>
                            </thead>
                        ";
    }

    // line 104
    public function block_table_body($context, array $blocks = array())
    {
        // line 105
        echo "                            <tbody>
                                ";
        // line 106
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
            // line 107
            echo "                                    <tr>
                                        ";
            // line 108
            $template = $this->env->resolveTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "inner_list_row"), "method"));
            $template->display($context);
            // line 109
            echo "                                    </tr>
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
        // line 111
        echo "                            </tbody>
                        ";
    }

    // line 114
    public function block_table_footer($context, array $blocks = array())
    {
        // line 115
        echo "                            <tr>
                                <th colspan=\"";
        // line 116
        echo twig_escape_filter($this->env, (twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "list"), "elements")) - (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "isXmlHttpRequest")) ? (($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "list"), "has", array(0 => "_action"), "method") + $this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "list"), "has", array(0 => "batch"), "method"))) : (0))), "html", null, true);
        echo "\">
                                    <div class=\"form-inline\">
                                        ";
        // line 118
        if ((!$this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "isXmlHttpRequest"))) {
            // line 119
            echo "                                            ";
            if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => "batch"), "method") && (twig_length_filter($this->env, (isset($context["batchactions"]) ? $context["batchactions"] : $this->getContext($context, "batchactions"))) > 0))) {
                // line 120
                echo "                                                ";
                $this->displayBlock('batch', $context, $blocks);
                // line 161
                echo "                                            ";
            }
            // line 162
            echo "
                                            <div class=\"pull-right\">
                                                ";
            // line 164
            if ((($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => "export"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "EXPORT"), "method")) && twig_length_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getExportFormats", array(), "method")))) {
                // line 165
                echo "                                                    <div class=\"btn-group\">
                                                        <button type=\"button\" class=\"btn btn-default dropdown-toggle\" data-toggle=\"dropdown\">
                                                            <i class=\"glyphicon glyphicon-export\"></i>
                                                            ";
                // line 168
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label_export_download", array(), "SonataAdminBundle"), "html", null, true);
                echo "
                                                            <span class=\"caret\"></span>
                                                        </button>
                                                        <ul class=\"dropdown-menu\">
                                                            ";
                // line 172
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getExportFormats", array(), "method"));
                foreach ($context['_seq'] as $context["_key"] => $context["format"]) {
                    // line 173
                    echo "                                                                <li>
                                                                    <a href=\"";
                    // line 174
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "export", 1 => ($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "modelmanager"), "paginationparameters", array(0 => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), 1 => 0), "method") + array("format" => (isset($context["format"]) ? $context["format"] : $this->getContext($context, "format"))))), "method"), "html", null, true);
                    echo "\">
                                                                        <i class=\"glyphicon glyphicon-download\"></i>
                                                                        ";
                    // line 176
                    echo twig_escape_filter($this->env, twig_upper_filter($this->env, (isset($context["format"]) ? $context["format"] : $this->getContext($context, "format"))), "html", null, true);
                    echo "
                                                                    </a>
                                                                <li>
                                                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['format'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 180
                echo "                                                        </ul>
                                                    </div>

                                                    &nbsp;-&nbsp;
                                                ";
            }
            // line 185
            echo "
                                                ";
            // line 186
            $this->displayBlock('pager_results', $context, $blocks);
            // line 189
            echo "                                            </div>
                                        ";
        }
        // line 191
        echo "                                    </div>
                                </th>
                            </tr>

                            ";
        // line 195
        $this->displayBlock('pager_links', $context, $blocks);
        // line 200
        echo "
                        ";
    }

    // line 120
    public function block_batch($context, array $blocks = array())
    {
        // line 121
        echo "                                                    <script>
                                                        ";
        // line 122
        $this->displayBlock('batch_javascript', $context, $blocks);
        // line 143
        echo "                                                    </script>

                                                    ";
        // line 145
        $this->displayBlock('batch_actions', $context, $blocks);
        // line 158
        echo "
                                                    <input type=\"submit\" class=\"btn btn-small btn-primary\" value=\"";
        // line 159
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_batch", array(), "SonataAdminBundle"), "html", null, true);
        echo "\">
                                                ";
    }

    // line 122
    public function block_batch_javascript($context, array $blocks = array())
    {
        // line 123
        echo "                                                            jQuery(document).ready(function (\$) {
                                                                \$('#list_batch_checkbox').on('ifChanged', function () {
                                                                    \$(this)
                                                                        .closest('table')
                                                                        .find('td.sonata-ba-list-field-batch input[type=\"checkbox\"]')
                                                                        .iCheck(\$(this).is(':checked') ? 'check' : 'uncheck')
                                                                    ;
                                                                });

                                                                \$('td.sonata-ba-list-field-batch input[type=\"checkbox\"]')
                                                                    .on('ifChanged', function () {
                                                                        \$(this)
                                                                            .closest('tr')
                                                                            .toggleClass('sonata-ba-list-row-selected', \$(this).is(':checked'))
                                                                        ;
                                                                    })
                                                                    .trigger('ifChanged')
                                                                ;
                                                            });
                                                        ";
    }

    // line 145
    public function block_batch_actions($context, array $blocks = array())
    {
        // line 146
        echo "                                                        <label class=\"checkbox\" for=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_all_elements\">
                                                            <input type=\"checkbox\" name=\"all_elements\" id=\"";
        // line 147
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_all_elements\">
                                                            ";
        // line 148
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("all_elements", array(), "SonataAdminBundle"), "html", null, true);
        echo "
                                                             (";
        // line 149
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "pager"), "nbresults"), "html", null, true);
        echo ")
                                                        </label>

                                                        <select name=\"action\" style=\"width: auto; height: auto\">
                                                            ";
        // line 153
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["batchactions"]) ? $context["batchactions"] : $this->getContext($context, "batchactions")));
        foreach ($context['_seq'] as $context["action"] => $context["options"]) {
            // line 154
            echo "                                                                <option value=\"";
            echo twig_escape_filter($this->env, (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["options"]) ? $context["options"] : $this->getContext($context, "options")), "label"), "html", null, true);
            echo "</option>
                                                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['action'], $context['options'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 156
        echo "                                                        </select>
                                                    ";
    }

    // line 186
    public function block_pager_results($context, array $blocks = array())
    {
        // line 187
        echo "                                                    ";
        $template = $this->env->resolveTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "pager_results"), "method"));
        $template->display($context);
        // line 188
        echo "                                                ";
    }

    // line 195
    public function block_pager_links($context, array $blocks = array())
    {
        // line 196
        echo "                                ";
        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "pager"), "haveToPaginate", array(), "method")) {
            // line 197
            echo "                                    ";
            $template = $this->env->resolveTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "pager_links"), "method"));
            $template->display($context);
            // line 198
            echo "                                ";
        }
        // line 199
        echo "                            ";
    }

    // line 212
    public function block_list_footer($context, array $blocks = array())
    {
    }

    // line 221
    public function block_list_filters($context, array $blocks = array())
    {
        // line 222
        echo "    ";
        if ($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "filters")) {
            // line 223
            echo "        ";
            $this->env->getExtension('form')->renderer->setTheme((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), array(0 => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "filter"), "method")));
            // line 224
            echo "        <div class=\"box box-primary\">
            <div class=\"box-header\">
                <h4 class=\"box-title filter_legend ";
            // line 226
            echo (($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "hasActiveFilters")) ? ("active") : ("inactive"));
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label_filters", array(), "SonataAdminBundle"), "html", null, true);
            echo "</h4>
            </div>

            <div class=\"box-body\">
                <form class=\"sonata-filter-form ";
            // line 230
            echo ((($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isChild") && (1 == twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "filters"))))) ? ("hide") : (""));
            echo "\" action=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "list"), "method"), "html", null, true);
            echo "?external=";
            if ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external")) {
                echo "true";
            } else {
                echo "false";
            }
            echo "&selectable=";
            if ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "selectable")) {
                echo "true";
            } else {
                echo "false";
            }
            echo "&idExpedienteHclinica=";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "idExpedienteHclinica"), "html", null, true);
            echo "&idEspecialidadHclinica=";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "idEspecialidadHclinica"), "html", null, true);
            echo "\" method=\"GET\" role=\"form\">
                    ";
            // line 231
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
            echo "
                        <div class=\"filter_container ";
            // line 232
            echo (($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "hasActiveFilters")) ? ("active") : ("inactive"));
            echo "\">
                            ";
            // line 233
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "filters"));
            foreach ($context['_seq'] as $context["_key"] => $context["filter"]) {
                // line 234
                echo "                                <div class=\"form-group\">
                                    <label for=\"";
                // line 235
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "children"), $this->getAttribute((isset($context["filter"]) ? $context["filter"] : $this->getContext($context, "filter")), "formName"), array(), "array"), "children"), "value", array(), "array"), "vars"), "id"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "trans", array(0 => $this->getAttribute((isset($context["filter"]) ? $context["filter"] : $this->getContext($context, "filter")), "label"), 1 => array(), 2 => $this->getAttribute((isset($context["filter"]) ? $context["filter"] : $this->getContext($context, "filter")), "translationDomain")), "method"), "html", null, true);
                echo "</label>
                                    ";
                // line 236
                $context["attr"] = (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "children", array(), "any", false, true), $this->getAttribute((isset($context["filter"]) ? $context["filter"] : $this->getContext($context, "filter")), "formName"), array(), "array", false, true), "children", array(), "any", false, true), "type", array(), "array", false, true), "vars", array(), "any", false, true), "attr", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "children", array(), "any", false, true), $this->getAttribute((isset($context["filter"]) ? $context["filter"] : $this->getContext($context, "filter")), "formName"), array(), "array", false, true), "children", array(), "any", false, true), "type", array(), "array", false, true), "vars", array(), "any", false, true), "attr"), array())) : (array()));
                // line 237
                echo "                                    ";
                $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => trim(((($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class"), "")) : ("")) . " sonata-filter-option"))));
                // line 238
                echo "
                                    ";
                // line 239
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "children"), $this->getAttribute((isset($context["filter"]) ? $context["filter"] : $this->getContext($context, "filter")), "formName"), array(), "array"), "children"), "type", array(), "array"), 'widget', array("attr" => (isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr"))));
                echo "

                                    ";
                // line 241
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "children"), $this->getAttribute((isset($context["filter"]) ? $context["filter"] : $this->getContext($context, "filter")), "formName"), array(), "array"), "children"), "value", array(), "array"), 'widget');
                echo "
                                </div>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['filter'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 244
            echo "
                            <input type=\"hidden\" name=\"filter[_page]\" id=\"filter__page\" value=\"1\">

                            ";
            // line 247
            $context["foo"] = $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "children"), "_page", array(), "array"), "setRendered", array(), "method");
            // line 248
            echo "                            ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
            echo "

                            <button type=\"submit\" class=\"btn btn-primary\"><i class=\"fa fa-filter\"></i> ";
            // line 250
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_filter", array(), "SonataAdminBundle"), "html", null, true);
            echo "</button>

                            <a class=\"btn btn-default\" href=\"";
            // line 252
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "list", 1 => array("filters" => "reset")), "method"), "html", null, true);
            echo "&external=";
            if ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external")) {
                echo "true";
            } else {
                echo "false";
            }
            echo "&selectable=";
            if ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "selectable")) {
                echo "true";
            } else {
                echo "false";
            }
            echo "&idExpedienteHclinica=";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "idExpedienteHclinica"), "html", null, true);
            echo "&idEspecialidadHclinica=";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "idEspecialidadHclinica"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_reset_filter", array(), "SonataAdminBundle"), "html", null, true);
            echo "</a>
                        </div>

                        ";
            // line 255
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "persistentParameters"));
            foreach ($context['_seq'] as $context["paramKey"] => $context["paramValue"]) {
                // line 256
                echo "                            <input type=\"hidden\" name=\"";
                echo twig_escape_filter($this->env, (isset($context["paramKey"]) ? $context["paramKey"] : $this->getContext($context, "paramKey")), "html", null, true);
                echo "\" value=\"";
                echo twig_escape_filter($this->env, (isset($context["paramValue"]) ? $context["paramValue"] : $this->getContext($context, "paramValue")), "html", null, true);
                echo "\">
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['paramKey'], $context['paramValue'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 258
            echo "                </form>
            </div>
        </div>

    ";
        }
    }

    public function getTemplateName()
    {
        return "MinsalSeguimientoBundle:SecHistorialClinico:historias_clinicas_pre_show.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  724 => 258,  713 => 256,  709 => 255,  685 => 252,  680 => 250,  674 => 248,  672 => 247,  667 => 244,  658 => 241,  653 => 239,  650 => 238,  647 => 237,  645 => 236,  639 => 235,  636 => 234,  632 => 233,  628 => 232,  624 => 231,  602 => 230,  593 => 226,  589 => 224,  586 => 223,  583 => 222,  580 => 221,  575 => 212,  571 => 199,  568 => 198,  564 => 197,  561 => 196,  558 => 195,  554 => 188,  550 => 187,  547 => 186,  542 => 156,  531 => 154,  527 => 153,  520 => 149,  516 => 148,  512 => 147,  507 => 146,  504 => 145,  481 => 123,  478 => 122,  472 => 159,  469 => 158,  467 => 145,  463 => 143,  461 => 122,  458 => 121,  455 => 120,  450 => 200,  448 => 195,  442 => 191,  438 => 189,  436 => 186,  433 => 185,  426 => 180,  416 => 176,  411 => 174,  408 => 173,  404 => 172,  397 => 168,  392 => 165,  390 => 164,  386 => 162,  383 => 161,  380 => 120,  377 => 119,  375 => 118,  370 => 116,  367 => 115,  364 => 114,  359 => 111,  344 => 109,  341 => 108,  338 => 107,  321 => 106,  318 => 105,  315 => 104,  309 => 100,  303 => 99,  300 => 98,  296 => 96,  292 => 95,  287 => 94,  281 => 93,  269 => 92,  267 => 91,  264 => 90,  261 => 89,  258 => 88,  255 => 87,  252 => 86,  249 => 85,  246 => 84,  243 => 83,  240 => 82,  237 => 81,  235 => 80,  232 => 79,  230 => 78,  226 => 76,  220 => 72,  217 => 71,  213 => 70,  209 => 68,  206 => 67,  201 => 58,  191 => 214,  188 => 213,  186 => 212,  183 => 211,  177 => 208,  174 => 207,  171 => 206,  167 => 204,  165 => 203,  162 => 202,  160 => 114,  157 => 113,  155 => 104,  152 => 103,  150 => 67,  147 => 66,  142 => 64,  137 => 63,  134 => 62,  131 => 61,  129 => 60,  126 => 59,  124 => 58,  119 => 56,  115 => 54,  105 => 46,  102 => 45,  99 => 44,  93 => 41,  85 => 37,  82 => 36,  79 => 35,  71 => 31,  68 => 30,  65 => 29,  51 => 17,  49 => 16,  44 => 15,  41 => 14,);
    }
}
