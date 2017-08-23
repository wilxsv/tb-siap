<?php

/* SonataAdminBundle::layout.html.twig */
class __TwigTemplate_0cff6318ce8ecd6eb41721722b0bea0716e819216177784c138711ce9310a06e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle::standard_layout.html.twig");

        $_trait_0 = $this->env->loadTemplate("MinsalSiapsBundle::acercaDe.html.twig");
        // line 2
        if (!$_trait_0->isTraitable()) {
            throw new Twig_Error_Runtime('Template "'."MinsalSiapsBundle::acercaDe.html.twig".'" cannot be used as a trait.');
        }
        $_trait_0_blocks = $_trait_0->getBlocks();

        $this->traits = $_trait_0_blocks;

        $this->blocks = array_merge(
            $this->traits,
            array(
                'meta_tags' => array($this, 'block_meta_tags'),
                'stylesheets' => array($this, 'block_stylesheets'),
                'javascripts' => array($this, 'block_javascripts'),
                'body_attributes' => array($this, 'block_body_attributes'),
                'sonata_header' => array($this, 'block_sonata_header'),
                'logo' => array($this, 'block_logo'),
                'sonata_nav' => array($this, 'block_sonata_nav'),
                'sonata_side_nav' => array($this, 'block_sonata_side_nav'),
                'side_bar_before_nav' => array($this, 'block_side_bar_before_nav'),
                'side_bar_nav' => array($this, 'block_side_bar_nav'),
                'custom_menu' => array($this, 'block_custom_menu'),
                'side_bar_after_nav' => array($this, 'block_side_bar_after_nav'),
                'sonata_top_nav_menu' => array($this, 'block_sonata_top_nav_menu'),
                'sonata_breadcrumb' => array($this, 'block_sonata_breadcrumb'),
                'sonata_left_side' => array($this, 'block_sonata_left_side'),
                'sonata_page_content_nav' => array($this, 'block_sonata_page_content_nav'),
            )
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle::standard_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["_version"] = 1.2;
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_meta_tags($context, array $blocks = array())
    {
        // line 6
        echo "    ";
        $this->displayParentBlock("meta_tags", $context, $blocks);
        echo "
";
    }

    // line 8
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 9
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/images/siap_icon.png"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"image/png\" rel=\"Shortcut Icon\">
    ";
        // line 10
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "

    <link rel=\"stylesheet\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/AdminLTE/plugins/iCheck/all.css"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
    <link rel=\"stylesheet\" href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/css/siaps.css"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
    <link rel=\"stylesheet\" href=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/css/fullcalendar/fullcalendar.css"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
    <link rel=\"stylesheet\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/css/bootstrap-daterangepicker/daterangepicker-bs3.css"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
    <link rel=\"stylesheet\" href=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
    <link rel=\"stylesheet\" href=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/clockpicker/dist/bootstrap-clockpicker.min.css"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
    <link rel=\"stylesheet\" href=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/bootstrap-tour/build/css/bootstrap-tour.min.css"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
    <link rel=\"stylesheet\" href=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/css/jasny-bootstrap/jasny-bootstrap.min.css"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
    <link rel=\"stylesheet\" href=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/AdminLTE/plugins/datatables/dataTables.bootstrap.css"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
    <link rel=\"stylesheet\" href=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/waitMe/waitMe.min.css"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
    <link rel=\"stylesheet\" href=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/AdminLTE/plugins/datatables/plugins/buttons/buttons.dataTables.min.css"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
    <link rel=\"stylesheet\" href=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/bootstrap3-wysihtml5/dist/bootstrap3-wysihtml5.min.css"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />

    ";
        // line 25
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "getId", array(), "method", true, true)) {
            echo "<link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/css/corelayout.css"), "html", null, true);
            echo "?v=";
            echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
            echo "\" type=\"text/css\" media=\"all\" />";
        }
    }

    // line 28
    public function block_javascripts($context, array $blocks = array())
    {
        // line 29
        echo "    <script>
        window.SONATA_CONFIG = {
            CONFIRM_EXIT: ";
        // line 31
        echo "false,
            USE_SELECT2: ";
        // line 32
        if ((array_key_exists("admin_pool", $context) && $this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "use_select2"), "method"))) {
            echo "true";
        } else {
            echo "false";
        }
        echo ",
            USE_ICHECK: ";
        // line 33
        if ((array_key_exists("admin_pool", $context) && $this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "use_icheck"), "method"))) {
            echo "true";
        } else {
            echo "false";
        }
        // line 34
        echo "        };
        window.SONATA_TRANSLATIONS = {
            CONFIRM_EXIT: '";
        // line 36
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("confirm_exit", array(), "SonataAdminBundle"), "js"), "html", null, true);
        echo "'
        };
    </script>

    ";
        // line 40
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "javascripts", 1 => array()), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["javascript"]) {
            // line 41
            echo "        ";
            if (twig_in_filter("Admin.js", (isset($context["javascript"]) ? $context["javascript"] : $this->getContext($context, "javascript")))) {
                // line 42
                echo "            <script src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/js/admin-bundle/Admin.js"), "html", null, true);
                echo "?v=";
                echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
                echo "\" type=\"text/javascript\"></script>
        ";
            } else {
                // line 44
                echo "            <script src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl((isset($context["javascript"]) ? $context["javascript"] : $this->getContext($context, "javascript"))), "html", null, true);
                echo "?v=";
                echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
                echo "\" type=\"text/javascript\"></script>
        ";
            }
            // line 46
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['javascript'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 47
        echo "
    <script src=\"";
        // line 48
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/js/jasny-bootstrap/jasny-bootstrap.min.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 49
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/ivoryckeditor/ckeditor.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 50
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/fosjsrouting/js/router.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 51
        echo $this->env->getExtension('routing')->getPath("fos_js_routing_js", array("callback" => "fos.Router.setData"));
        echo "&v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <!--Adesigns Bundle-->
    <script src=\"";
        // line 53
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/js/fullcalendar/fullcalendar.min.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 54
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/js/funciones_generales.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\" id=\"funciones_generales_js\"></script>
    <script src=\"";
        // line 55
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/moment/moment.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 56
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/js/bootstrap-daterangepicker/daterangepicker.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 57
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 58
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 59
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/clockpicker/dist/bootstrap-clockpicker.min.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 60
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/bootstrap-tour/build/js/bootstrap-tour.min.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 61
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/js/maskedinput/jquery.maskedinput.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 62
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/AdminLTE/plugins/datatables/jquery.dataTables.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 63
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/AdminLTE/plugins/datatables/dataTables.bootstrap.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 64
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/AdminLTE/plugins/datatables/plugins/buttons/buttons.html5.min.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 65
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/AdminLTE/plugins/datatables/plugins/buttons/buttons.print.min.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 66
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/AdminLTE/plugins/datatables/plugins/buttons/dataTables.buttons.min.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 67
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/AdminLTE/plugins/datatables/plugins/buttons/jszip.min.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 68
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/AdminLTE/plugins/datatables/plugins/buttons/pdfmake.min.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 69
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/AdminLTE/plugins/datatables/plugins/buttons/vfs_fonts.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 70
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/waitMe/waitMe.min.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 71
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/bootstrap-number-input-master/bootstrap-number-input.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 72
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/bootstrap3-wysihtml5/dist/bootstrap3-wysihtml5.all.min.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 73
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/bootstrap3-wysihtml5/dist/locales/bootstrap-wysihtml5.es-ES.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 74
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/vendor/waitMe/waitMe.min.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    ";
        // line 75
        if ($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user")) {
            // line 76
            echo "        <script type=\"text/javascript\">
        var currentTime = new Date();
        var year = currentTime.getFullYear();
        var modal_elements=[];
        var collectionIndex = [];
        var auxiliarMenu =  { main :
                                {
                                  backgroundColor: '#F9F9F9',
                                  borderColor    : '#3C8DBC',
                                  color          : '#3C8DBC',
                                  //marginTop      : 300,
                                  icon           : '<i class=\"fa fa-fw fa-bars\"></i>',
                                  tabs           : {}
                                }
                            };
        var userTourCreateRoute = '";
            // line 91
            echo $this->env->getExtension('routing')->getUrl("admin_application_core_mntusertour_create");
            echo "';

        function showAbout() {
            return '";
            // line 94
            ob_start();
            echo strtr($this->renderBlock("about_content", $context, $blocks), array("
" => ""));
            echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
            echo "';
        }
        </script>
    ";
        }
        // line 98
        echo "    <script type=\"text/javascript\">
        jQuery(document).ready(function (\$) {
            ";
        // line 100
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "getId", array(), "method", true, true)) {
            // line 101
            echo "                var eAbout = \$('#about_info_modal');
                eAbout.on('click', function () {
                    modal_elements.push({
                        id: 'about_info_modal',
                        header: 'Acerca de',
                        func: 'showAbout',
                        footer: 'Ministerio de Salud - DTIC, &copy; ' + year + ' Todos los derechos reservados.',
                        widthModal: '750px'
                    });
                });
                \$('#manualUsuario').attr('href', '";
            // line 111
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("render_download_file", array("name" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_manualUsuario"), "method"), "directory" => twig_escape_filter($this->env, "manualUsuario", "url"), "file_type" => twig_escape_filter($this->env, twig_lower_filter($this->env, "document/pdf"), "url"), "disposition" => "inline", "thumbnail" => false)), "html", null, true);
            // line 119
            echo "');
                \$('#manualUsuario').attr('target', '_blank');
                \$('body').append('<div class=\"page-footer\"><img class=\"dtic-footer\" src=\"";
            // line 121
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/images/dtic.png"), "html", null, true);
            echo "?v=";
            echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
            echo "\" alt=\"dtic\"/>Dirección de Tecnologías de Información y Comunicaciones - Ministerio de Salud</div>');

                ";
            // line 123
            if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SUPER_ADMIN"), "method")) {
                // line 124
                echo "                    auxiliarMenu.main.tabs = { userTour :
                                                { title            : 'Tutorial de Usuario',
                                                  icon             : '<i class=\"fa fa-fw fa-rocket\"></i>',
                                                  dropdown         : true,
                                                  active           : false,
                                                  content          : '',
                                                  dropdownOptions  :
                                                    { createTour :
                                                        { title      : 'Crear',
                                                          href       : '#',
                                                          //addDivider : false,
                                                          otherAttrs : { 'onClick' : 'createUserTour();' }
                                                        }
                                                    }
                                                }
                                            };
                    /* Por el momento solo se llama esta funcion cuando se es administrador */
                    buildAuxMenu(auxiliarMenu);
                ";
            }
            // line 143
            echo "
            ";
        }
        // line 145
        echo "        });
    </script>
    ";
        // line 147
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "getId", array(), "method", true, true)) {
            // line 148
            echo "        <script type=\"text/javascript\">
            var lastUsed = 0;
            var remaining = 0;
            var lapse = 0;
            var limit
            = ";
            // line 153
            echo twig_escape_filter($this->env, (isset($context["max_iddle_time"]) ? $context["max_iddle_time"] : $this->getContext($context, "max_iddle_time")), "html", null, true);
            echo ";
                    var url = '";
            // line 154
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("sonata_user_admin_security_login", array("_moduleSelection" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_moduleSelection"), "method"))), "html", null, true);
            echo "';
            var interval = 5000;

            idleSession();

            jQuery(document).ready(function (\$) {
                \$.ajaxSetup({
                    complete: function (xhr, textStatus) {
                        var found = this.url.search('siaps/timeInfo');
                        if (found === -1) {
                            idleSession();
                        }
                    }
                });
            });

            function idleSession() {
                try {
                    jQuery.ajax({
                        url: Routing.generate('siapsTimeInfo'),
                        async: true,
                        dataType: 'json',
                        success: function (data) {
                            if (data.status === null) {
                                reloadPage();
                            } else {
                                lastUsed = data.time;
                                lapse = time() - lastUsed;
                                remaining = limit - lapse;
                            }
                        }
                    });
                } catch (e) {
                    console.log(e);
                    return false;
                }

            }

            var idleInterval = setInterval(timeCheck, interval);

            function timeCheck() {
                remaining = remaining - (interval / 1000);
                if (remaining < 0) {
                    idleSession();
                }
            }

            function reloadPage() {
                window.location.href = url;
            }
        </script>
    ";
        }
    }

    // line 209
    public function block_body_attributes($context, array $blocks = array())
    {
        echo "class=\"sonata-bc\"";
    }

    // line 211
    public function block_sonata_header($context, array $blocks = array())
    {
        // line 212
        echo "    <header class=\"header\">
        ";
        // line 213
        $this->displayBlock('logo', $context, $blocks);
        // line 228
        echo "
        ";
        // line 230
        echo "        ";
        $this->displayBlock('sonata_nav', $context, $blocks);
        // line 283
        echo "        ";
        // line 284
        echo "    </header>

    ";
        // line 287
        echo "    <div class=\"row";
        if ((twig_test_empty((isset($context["_breadcrumb"]) ? $context["_breadcrumb"] : $this->getContext($context, "_breadcrumb"))) && (!array_key_exists("action", $context)))) {
            echo " row-breadcrumb";
        }
        echo "\">
        <div class=\"col-md-12 breadcrumb\">
            ";
        // line 289
        $this->displayBlock('sonata_breadcrumb', $context, $blocks);
        // line 318
        echo "        </div>
    </div>
    ";
    }

    // line 213
    public function block_logo($context, array $blocks = array())
    {
        // line 214
        echo "            <center>
                <a class=\"logo\" href=\"";
        // line 215
        echo $this->env->getExtension('routing')->getUrl("sonata_admin_dashboard");
        echo "\">
                    <img class=\"banner\" src=\"";
        // line 216
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/images/logo_siaps.png"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" alt=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "title"), "html", null, true);
        echo "\">
                </a>
            </center>
            ";
        // line 219
        if ($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user")) {
            // line 220
            echo "                <h1 class=\"establecimiento\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEstablecimiento", array(), "method"), "html", null, true);
            echo "</h1>
                ";
            // line 221
            if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado", array(), "method")) {
                // line 222
                echo "                    <p class=\"usuario\"><strong>Bienvenid@:</strong>";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado", array(), "method"), "html", null, true);
                echo "</p>
                ";
            } else {
                // line 224
                echo "                    <p class=\"usuario\"><strong>Bienvenid@:</strong>";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "html", null, true);
                echo "</p>
                ";
            }
            // line 226
            echo "            ";
        }
        // line 227
        echo "        ";
    }

    // line 230
    public function block_sonata_nav($context, array $blocks = array())
    {
        // line 231
        echo "            ";
        if (array_key_exists("admin_pool", $context)) {
            // line 232
            echo "                <nav class=\"navbar navbar-static-top\" role=\"navigation\">
                    <div class=\"container-fluid\">
                        <div class=\"navbar-header\">
                            <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#navbar-collapse-1\">
                                <span class=\"sr-only\">Toggle navigation</span>
                                <span class=\"icon-bar\"></span>
                                <span class=\"icon-bar\"></span>
                                <span class=\"icon-bar\"></span>
                            </button>
                            <a class=\"navbar-brand\" href=\"#\"></a>
                        </div>

                        <div class=\"navbar-left\">
                            <div class=\"collapse navbar-collapse\" id=\"navbar-collapse-1\">
                                ";
            // line 246
            $this->displayBlock('sonata_side_nav', $context, $blocks);
            // line 262
            echo "                            </div>
                        </div>

                        ";
            // line 265
            $this->displayBlock('sonata_top_nav_menu', $context, $blocks);
            // line 279
            echo "                    </div>    <!--Container Fluid-->
                </nav>
            ";
        }
        // line 282
        echo "        ";
    }

    // line 246
    public function block_sonata_side_nav($context, array $blocks = array())
    {
        // line 247
        echo "
                                    ";
        // line 248
        $this->displayBlock('side_bar_before_nav', $context, $blocks);
        // line 249
        echo "                                    ";
        $this->displayBlock('side_bar_nav', $context, $blocks);
        // line 259
        echo "                                    ";
        $this->displayBlock('side_bar_after_nav', $context, $blocks);
        // line 261
        echo "                                ";
    }

    // line 248
    public function block_side_bar_before_nav($context, array $blocks = array())
    {
        echo " ";
    }

    // line 249
    public function block_side_bar_nav($context, array $blocks = array())
    {
        // line 250
        echo "                                        ";
        // line 251
        echo "                                        ";
        $this->displayBlock('custom_menu', $context, $blocks);
        // line 257
        echo "                                        ";
        // line 258
        echo "                                    ";
    }

    // line 251
    public function block_custom_menu($context, array $blocks = array())
    {
        // line 252
        echo "                                            ";
        if ($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user")) {
            // line 253
            echo "                                                ";
            $context["cus_menu"] = $this->env->getExtension('knp_menu')->get("ApplicationCoreBundle:MenuBuilder:mainMenu", array(), array("admin" => $this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "dashboardgroups"), "user" => $this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user")));
            // line 254
            echo "                                                ";
            echo $this->env->getExtension('knp_menu')->render((isset($context["cus_menu"]) ? $context["cus_menu"] : $this->getContext($context, "cus_menu")), array("currentClass" => "active", "template" => "ApplicationCoreBundle:Menu:knp_menu.html.twig"));
            echo "
                                            ";
        }
        // line 256
        echo "                                        ";
    }

    // line 259
    public function block_side_bar_after_nav($context, array $blocks = array())
    {
        // line 260
        echo "                                    ";
    }

    // line 265
    public function block_sonata_top_nav_menu($context, array $blocks = array())
    {
        // line 266
        echo "                            <div class=\"navbar-right\">
                                <ul class=\"nav navbar-nav\">
                                    <li class=\"dropdown user-menu\">
                                        <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">
                                            <i class=\"fa fa-user fa-fw\"></i> <i class=\"fa fa-caret-down\"></i>
                                        </a>
                                        <ul class=\"dropdown-menu dropdown-user\">
                                            ";
        // line 273
        $this->env->loadTemplate("SonataAdminBundle::user_block.html.twig")->display($context);
        // line 274
        echo "                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        ";
    }

    // line 289
    public function block_sonata_breadcrumb($context, array $blocks = array())
    {
        // line 290
        echo "                ";
        if (((!twig_test_empty((isset($context["_breadcrumb"]) ? $context["_breadcrumb"] : $this->getContext($context, "_breadcrumb")))) || array_key_exists("action", $context))) {
            // line 291
            echo "                    <ol class=\"nav navbar-top-links breadcrumb\">
                        ";
            // line 292
            if (twig_test_empty((isset($context["_breadcrumb"]) ? $context["_breadcrumb"] : $this->getContext($context, "_breadcrumb")))) {
                // line 293
                echo "                            ";
                if (array_key_exists("action", $context)) {
                    // line 294
                    echo "                                ";
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "breadcrumbs", array(0 => (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action"))), "method"));
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
                    foreach ($context['_seq'] as $context["_key"] => $context["menu"]) {
                        // line 295
                        echo "                                    ";
                        if ((!$this->getAttribute((isset($context["loop"]) ? $context["loop"] : $this->getContext($context, "loop")), "last"))) {
                            // line 296
                            echo "                                        <li>
                                            ";
                            // line 297
                            if ((!twig_test_empty($this->getAttribute((isset($context["menu"]) ? $context["menu"] : $this->getContext($context, "menu")), "uri")))) {
                                // line 298
                                echo "                                                ";
                                if ((($this->getAttribute((isset($context["menu"]) ? $context["menu"] : $this->getContext($context, "menu")), "label") == "Dashboard") || ($this->getAttribute((isset($context["menu"]) ? $context["menu"] : $this->getContext($context, "menu")), "label") == "⌂"))) {
                                    // line 299
                                    echo "                                                    <a href=\"";
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["menu"]) ? $context["menu"] : $this->getContext($context, "menu")), "uri"), "html", null, true);
                                    echo "\"><span class=\"glyphicon glyphicon-home\"></span> </a>
                                                ";
                                } else {
                                    // line 301
                                    echo "                                                    <a href=\"";
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["menu"]) ? $context["menu"] : $this->getContext($context, "menu")), "uri"), "html", null, true);
                                    echo "\">";
                                    echo $this->getAttribute((isset($context["menu"]) ? $context["menu"] : $this->getContext($context, "menu")), "label");
                                    echo "</a>
                                                ";
                                }
                                // line 303
                                echo "                                            ";
                            } else {
                                // line 304
                                echo "                                                ";
                                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["menu"]) ? $context["menu"] : $this->getContext($context, "menu")), "label"), "html", null, true);
                                echo "
                                            ";
                            }
                            // line 306
                            echo "                                        </li>
                                    ";
                        } else {
                            // line 308
                            echo "                                        <li class=\"active\"><span>";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["menu"]) ? $context["menu"] : $this->getContext($context, "menu")), "label"), "html", null, true);
                            echo "</span></li>
                                            ";
                        }
                        // line 310
                        echo "                                        ";
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
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['menu'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 311
                    echo "                                    ";
                }
                // line 312
                echo "                                ";
            } else {
                // line 313
                echo "                                    ";
                echo (isset($context["_breadcrumb"]) ? $context["_breadcrumb"] : $this->getContext($context, "_breadcrumb"));
                echo "
                                ";
            }
            // line 315
            echo "                    </ol>
                ";
        }
        // line 317
        echo "            ";
    }

    // line 323
    public function block_sonata_left_side($context, array $blocks = array())
    {
    }

    // line 326
    public function block_sonata_page_content_nav($context, array $blocks = array())
    {
        // line 327
        echo "    ";
        if (((!twig_test_empty(trim((isset($context["_tab_menu"]) ? $context["_tab_menu"] : $this->getContext($context, "_tab_menu"))))) || (!twig_test_empty(trim(strtr((isset($context["_actions"]) ? $context["_actions"] : $this->getContext($context, "_actions")), array("<li>" => "", "</li>" => ""))))))) {
            // line 328
            echo "        <nav class=\"navbar navbar-default\" role=\"navigation\">
            ";
            // line 329
            if ((!twig_test_empty((isset($context["_navbar_title"]) ? $context["_navbar_title"] : $this->getContext($context, "_navbar_title"))))) {
                // line 330
                echo "                <div class=\"navbar-header\">
                    <span class=\"navbar-brand\">";
                // line 331
                echo (isset($context["_navbar_title"]) ? $context["_navbar_title"] : $this->getContext($context, "_navbar_title"));
                echo "</span>
                </div>
            ";
            }
            // line 334
            echo "            <div class=\"container-fluid\">
                <div class=\"navbar-left\">
                    ";
            // line 336
            if ((!twig_test_empty((isset($context["_tab_menu"]) ? $context["_tab_menu"] : $this->getContext($context, "_tab_menu"))))) {
                // line 337
                echo "                        ";
                echo (isset($context["_tab_menu"]) ? $context["_tab_menu"] : $this->getContext($context, "_tab_menu"));
                echo "
                    ";
            }
            // line 339
            echo "                </div>

                ";
            // line 341
            if ((!twig_test_empty(trim(strtr((isset($context["_actions"]) ? $context["_actions"] : $this->getContext($context, "_actions")), array("<li>" => "", "</li>" => "")))))) {
                // line 342
                echo "                    <ul class=\"nav navbar-nav navbar-right\">
                        <li class=\"dropdown sonata-actions\">
                            <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Acci&oacute;n<b class=\"caret\"></b></a>
                            <ul class=\"dropdown-menu\" role=\"menu\">
                                ";
                // line 346
                echo (isset($context["_actions"]) ? $context["_actions"] : $this->getContext($context, "_actions"));
                echo "
                            </ul>
                        </li>
                    </ul>
                ";
            }
            // line 351
            echo "            </div>
        </nav>
    ";
        }
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  940 => 351,  932 => 346,  926 => 342,  924 => 341,  920 => 339,  914 => 337,  912 => 336,  908 => 334,  902 => 331,  899 => 330,  897 => 329,  894 => 328,  891 => 327,  888 => 326,  883 => 323,  879 => 317,  875 => 315,  869 => 313,  866 => 312,  863 => 311,  849 => 310,  843 => 308,  839 => 306,  833 => 304,  830 => 303,  822 => 301,  816 => 299,  813 => 298,  811 => 297,  808 => 296,  805 => 295,  787 => 294,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  773 => 289,  765 => 274,  763 => 273,  754 => 266,  751 => 265,  747 => 260,  744 => 259,  740 => 256,  734 => 254,  731 => 253,  728 => 252,  725 => 251,  721 => 258,  719 => 257,  716 => 251,  714 => 250,  711 => 249,  705 => 248,  701 => 261,  698 => 259,  695 => 249,  693 => 248,  690 => 247,  687 => 246,  683 => 282,  678 => 279,  676 => 265,  671 => 262,  669 => 246,  653 => 232,  650 => 231,  647 => 230,  643 => 227,  640 => 226,  634 => 224,  628 => 222,  626 => 221,  621 => 220,  619 => 219,  609 => 216,  605 => 215,  602 => 214,  599 => 213,  593 => 318,  591 => 289,  583 => 287,  579 => 284,  577 => 283,  574 => 230,  571 => 228,  569 => 213,  566 => 212,  563 => 211,  557 => 209,  499 => 154,  495 => 153,  488 => 148,  486 => 147,  482 => 145,  478 => 143,  457 => 124,  455 => 123,  448 => 121,  444 => 119,  442 => 111,  430 => 101,  428 => 100,  424 => 98,  414 => 94,  408 => 91,  391 => 76,  389 => 75,  383 => 74,  377 => 73,  371 => 72,  365 => 71,  359 => 70,  353 => 69,  347 => 68,  341 => 67,  335 => 66,  329 => 65,  311 => 62,  305 => 61,  299 => 60,  293 => 59,  287 => 58,  281 => 57,  275 => 56,  269 => 55,  257 => 53,  244 => 50,  238 => 49,  232 => 48,  229 => 47,  223 => 46,  207 => 42,  200 => 40,  193 => 36,  189 => 34,  183 => 33,  175 => 32,  168 => 29,  155 => 25,  148 => 23,  142 => 22,  136 => 21,  124 => 19,  100 => 15,  94 => 14,  88 => 13,  82 => 12,  77 => 10,  70 => 9,  67 => 8,  60 => 6,  57 => 5,  52 => 3,  14 => 2,  323 => 64,  317 => 63,  308 => 95,  302 => 93,  297 => 92,  292 => 91,  289 => 90,  285 => 88,  279 => 86,  276 => 85,  273 => 84,  263 => 54,  259 => 132,  250 => 51,  242 => 121,  235 => 116,  225 => 108,  218 => 106,  215 => 44,  213 => 104,  208 => 102,  204 => 41,  201 => 100,  199 => 90,  196 => 89,  194 => 84,  188 => 82,  185 => 81,  177 => 138,  174 => 137,  172 => 31,  169 => 80,  165 => 28,  162 => 77,  156 => 75,  152 => 73,  149 => 72,  140 => 67,  137 => 66,  132 => 69,  130 => 20,  126 => 64,  123 => 63,  118 => 18,  112 => 17,  106 => 16,  101 => 50,  99 => 49,  56 => 10,  53 => 9,  45 => 6,  39 => 4,  36 => 3,);
    }
}
