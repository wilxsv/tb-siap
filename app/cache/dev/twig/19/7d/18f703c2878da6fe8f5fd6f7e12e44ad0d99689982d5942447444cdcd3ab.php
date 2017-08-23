<?php

/* SonataAdminBundle:CRUD:action.html.twig */
class __TwigTemplate_197d18f703c2878da6fe8f5fd6f7e12e44ad0d99689982d5942447444cdcd3ab extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'actions' => array($this, 'block_actions'),
            'tab_menu' => array($this, 'block_tab_menu'),
            'content' => array($this, 'block_content'),
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
        $this->env->loadTemplate("SonataAdminBundle:Button:create_button.html.twig")->display($context);
        echo "</li>
    <li>";
        // line 16
        $this->env->loadTemplate("SonataAdminBundle:Button:list_button.html.twig")->display($context);
        echo "</li>
";
    }

    // line 19
    public function block_tab_menu($context, array $blocks = array())
    {
        // line 20
        echo "    ";
        if (array_key_exists("action", $context)) {
            // line 21
            echo "        ";
            echo $this->env->getExtension('knp_menu')->render($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "sidemenu", array(0 => (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action"))), "method"), array("currentClass" => "active"), "list");
            echo "
    ";
        }
    }

    // line 25
    public function block_content($context, array $blocks = array())
    {
        // line 26
        echo "
    Redefine the content block in your action template

";
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:action.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  59 => 26,  56 => 25,  48 => 21,  45 => 20,  42 => 19,  36 => 16,  28 => 14,  1673 => 1259,  1670 => 1258,  1663 => 1316,  1635 => 1290,  1632 => 1289,  1629 => 1288,  1622 => 1283,  1617 => 1281,  1614 => 1280,  1611 => 1279,  1606 => 1277,  1601 => 1275,  1598 => 1274,  1595 => 1273,  1588 => 1268,  1586 => 1267,  1582 => 1265,  1572 => 1262,  1569 => 1261,  1566 => 1260,  1563 => 1258,  1557 => 1256,  1555 => 1255,  1552 => 1254,  1549 => 1253,  1541 => 1250,  1532 => 1247,  1527 => 1246,  1522 => 1245,  1519 => 1244,  1514 => 1243,  1511 => 1242,  1504 => 1237,  1492 => 1230,  1487 => 1227,  1485 => 1226,  1477 => 1220,  1475 => 1219,  1333 => 1084,  1320 => 1073,  1316 => 1071,  1313 => 1070,  1306 => 1067,  1304 => 1066,  1301 => 1065,  1296 => 1063,  1291 => 1062,  1289 => 1061,  1286 => 1060,  1283 => 1059,  1280 => 1058,  1277 => 1057,  1274 => 1056,  1271 => 1055,  1268 => 1054,  1266 => 1053,  1217 => 1011,  1190 => 991,  1186 => 989,  1184 => 988,  892 => 703,  889 => 702,  883 => 700,  880 => 699,  874 => 697,  872 => 696,  803 => 630,  711 => 540,  705 => 539,  606 => 447,  577 => 420,  571 => 419,  487 => 337,  481 => 335,  479 => 334,  430 => 287,  392 => 251,  387 => 249,  382 => 248,  380 => 247,  377 => 246,  364 => 235,  362 => 234,  266 => 140,  261 => 138,  257 => 137,  252 => 136,  250 => 135,  246 => 134,  240 => 130,  237 => 129,  233 => 127,  224 => 124,  222 => 123,  211 => 121,  203 => 119,  201 => 118,  189 => 116,  178 => 108,  166 => 98,  164 => 97,  117 => 52,  111 => 48,  109 => 47,  87 => 27,  85 => 26,  80 => 25,  77 => 24,  71 => 21,  66 => 20,  63 => 19,  58 => 16,  50 => 12,  47 => 11,  44 => 10,  39 => 8,  37 => 7,  35 => 6,  33 => 5,  31 => 15,);
    }
}
