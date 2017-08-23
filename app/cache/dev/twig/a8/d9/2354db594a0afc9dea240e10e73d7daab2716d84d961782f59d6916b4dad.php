<?php

/* IvoryCKEditorBundle:Form:ckeditor_widget.html.twig */
class __TwigTemplate_a8d92354db594a0afc9dea240e10e73d7daab2716d84d961782f59d6916b4dad extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'ckeditor_widget' => array($this, 'block_ckeditor_widget'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('ckeditor_widget', $context, $blocks);
    }

    public function block_ckeditor_widget($context, array $blocks = array())
    {
        // line 2
        echo "    <textarea ";
        $this->displayBlock("widget_attributes", $context, $blocks);
        echo ">";
        echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true);
        echo "</textarea>

    ";
        // line 4
        if ((isset($context["enable"]) ? $context["enable"] : $this->getContext($context, "enable"))) {
            // line 5
            echo "        ";
            if ((!call_user_func_array($this->env->getFunction('ckeditor_is_loaded')->getCallable(), array()))) {
                // line 6
                echo "            <script type=\"text/javascript\">
                var CKEDITOR_BASEPATH = \"";
                // line 7
                echo call_user_func_array($this->env->getFunction('ckeditor_base_path')->getCallable(), array((isset($context["base_path"]) ? $context["base_path"] : $this->getContext($context, "base_path"))));
                echo "\";
            </script>

            <script type=\"text/javascript\" src=\"";
                // line 10
                echo call_user_func_array($this->env->getFunction('ckeditor_js_path')->getCallable(), array((isset($context["js_path"]) ? $context["js_path"] : $this->getContext($context, "js_path"))));
                echo "\"></script>
        ";
            }
            // line 12
            echo "
        <script type=\"text/javascript\">
            ";
            // line 14
            echo call_user_func_array($this->env->getFunction('ckeditor_destroy')->getCallable(), array((isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"))));
            echo "

            ";
            // line 16
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["plugins"]) ? $context["plugins"] : $this->getContext($context, "plugins")));
            foreach ($context['_seq'] as $context["plugin_name"] => $context["plugin"]) {
                // line 17
                echo "                ";
                echo call_user_func_array($this->env->getFunction('ckeditor_plugin')->getCallable(), array((isset($context["plugin_name"]) ? $context["plugin_name"] : $this->getContext($context, "plugin_name")), (isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin"))));
                echo "
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['plugin_name'], $context['plugin'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 19
            echo "
            ";
            // line 20
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["styles"]) ? $context["styles"] : $this->getContext($context, "styles")));
            foreach ($context['_seq'] as $context["style_name"] => $context["style"]) {
                // line 21
                echo "                ";
                echo call_user_func_array($this->env->getFunction('ckeditor_styles_set')->getCallable(), array((isset($context["style_name"]) ? $context["style_name"] : $this->getContext($context, "style_name")), (isset($context["style"]) ? $context["style"] : $this->getContext($context, "style"))));
                echo "
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['style_name'], $context['style'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 23
            echo "
            ";
            // line 24
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["templates"]) ? $context["templates"] : $this->getContext($context, "templates")));
            foreach ($context['_seq'] as $context["template_name"] => $context["template"]) {
                // line 25
                echo "                ";
                echo call_user_func_array($this->env->getFunction('ckeditor_template')->getCallable(), array((isset($context["template_name"]) ? $context["template_name"] : $this->getContext($context, "template_name")), (isset($context["template"]) ? $context["template"] : $this->getContext($context, "template"))));
                echo "
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['template_name'], $context['template'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 27
            echo "
            ";
            // line 28
            echo call_user_func_array($this->env->getFunction('ckeditor_replace')->getCallable(), array((isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), (isset($context["config"]) ? $context["config"] : $this->getContext($context, "config"))));
            echo "
        </script>
    ";
        }
    }

    public function getTemplateName()
    {
        return "IvoryCKEditorBundle:Form:ckeditor_widget.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  82 => 21,  57 => 14,  53 => 12,  36 => 5,  26 => 2,  20 => 1,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 306,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 298,  1056 => 293,  1053 => 292,  1051 => 291,  1048 => 290,  1040 => 285,  1036 => 284,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 280,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 255,  961 => 254,  958 => 253,  955 => 252,  952 => 251,  950 => 250,  947 => 249,  939 => 243,  936 => 242,  934 => 241,  931 => 240,  923 => 236,  920 => 235,  918 => 234,  915 => 233,  903 => 229,  900 => 228,  897 => 227,  894 => 226,  892 => 225,  889 => 224,  881 => 220,  878 => 219,  876 => 218,  873 => 217,  865 => 213,  862 => 212,  860 => 211,  857 => 210,  849 => 206,  846 => 205,  844 => 204,  841 => 203,  833 => 199,  830 => 198,  828 => 197,  825 => 196,  817 => 192,  814 => 191,  812 => 190,  809 => 189,  798 => 184,  796 => 183,  793 => 182,  785 => 178,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 165,  753 => 164,  751 => 163,  739 => 156,  729 => 155,  724 => 154,  721 => 153,  712 => 150,  710 => 149,  707 => 148,  699 => 142,  697 => 141,  696 => 140,  695 => 139,  694 => 138,  689 => 137,  683 => 135,  680 => 134,  678 => 133,  675 => 132,  666 => 126,  662 => 125,  658 => 124,  654 => 123,  649 => 122,  643 => 120,  640 => 119,  638 => 118,  635 => 117,  617 => 112,  614 => 111,  598 => 107,  576 => 101,  557 => 96,  529 => 92,  527 => 91,  524 => 90,  515 => 85,  512 => 84,  509 => 83,  501 => 80,  496 => 79,  493 => 78,  490 => 77,  478 => 74,  470 => 73,  467 => 72,  464 => 71,  433 => 60,  426 => 58,  423 => 57,  414 => 52,  408 => 50,  405 => 49,  403 => 48,  388 => 42,  385 => 41,  374 => 36,  371 => 35,  366 => 33,  363 => 32,  355 => 27,  350 => 26,  344 => 24,  342 => 23,  337 => 22,  335 => 21,  316 => 16,  311 => 14,  308 => 13,  299 => 8,  293 => 6,  290 => 5,  285 => 3,  281 => 409,  278 => 408,  276 => 393,  273 => 392,  271 => 374,  268 => 373,  263 => 365,  258 => 354,  255 => 353,  253 => 342,  245 => 335,  243 => 327,  240 => 326,  227 => 301,  225 => 298,  220 => 290,  215 => 280,  210 => 270,  207 => 269,  204 => 267,  202 => 266,  199 => 265,  194 => 248,  191 => 246,  189 => 240,  181 => 232,  179 => 224,  174 => 217,  171 => 216,  161 => 202,  149 => 182,  146 => 181,  129 => 148,  126 => 147,  124 => 132,  114 => 111,  111 => 110,  106 => 104,  101 => 89,  99 => 68,  89 => 47,  81 => 40,  79 => 32,  69 => 13,  66 => 17,  61 => 2,  810 => 263,  804 => 260,  801 => 185,  799 => 258,  795 => 256,  792 => 255,  780 => 176,  777 => 253,  774 => 252,  771 => 251,  768 => 250,  766 => 249,  761 => 247,  749 => 162,  746 => 161,  743 => 243,  735 => 238,  732 => 237,  715 => 151,  698 => 234,  693 => 232,  688 => 231,  685 => 230,  682 => 229,  676 => 225,  672 => 223,  670 => 222,  665 => 221,  648 => 219,  631 => 218,  627 => 217,  622 => 216,  619 => 113,  610 => 212,  608 => 211,  605 => 210,  596 => 106,  592 => 203,  590 => 202,  587 => 201,  585 => 200,  582 => 199,  578 => 178,  572 => 176,  566 => 174,  563 => 173,  560 => 172,  547 => 93,  542 => 190,  536 => 187,  533 => 186,  531 => 185,  528 => 184,  525 => 183,  505 => 180,  502 => 179,  500 => 172,  491 => 171,  486 => 168,  480 => 75,  471 => 162,  465 => 161,  461 => 70,  454 => 159,  449 => 157,  446 => 156,  443 => 155,  434 => 152,  431 => 151,  428 => 59,  425 => 149,  422 => 148,  412 => 142,  406 => 140,  400 => 47,  398 => 137,  393 => 136,  390 => 43,  383 => 132,  380 => 130,  377 => 37,  372 => 126,  356 => 122,  353 => 121,  349 => 119,  339 => 116,  336 => 115,  332 => 20,  330 => 113,  323 => 111,  318 => 110,  313 => 15,  310 => 107,  304 => 103,  294 => 100,  288 => 4,  284 => 97,  279 => 96,  264 => 90,  249 => 89,  244 => 88,  238 => 312,  232 => 82,  228 => 80,  222 => 297,  217 => 289,  201 => 74,  193 => 69,  188 => 66,  183 => 64,  167 => 63,  162 => 61,  156 => 195,  154 => 189,  151 => 188,  145 => 55,  142 => 54,  139 => 169,  125 => 48,  122 => 46,  119 => 117,  116 => 116,  113 => 43,  107 => 27,  105 => 40,  90 => 33,  87 => 32,  77 => 28,  74 => 20,  71 => 19,  55 => 19,  48 => 10,  45 => 16,  40 => 14,  327 => 112,  321 => 152,  315 => 109,  312 => 149,  309 => 148,  301 => 144,  289 => 140,  277 => 95,  274 => 94,  272 => 134,  269 => 91,  265 => 130,  236 => 109,  209 => 96,  197 => 249,  187 => 87,  185 => 86,  182 => 85,  176 => 223,  170 => 79,  165 => 62,  160 => 76,  158 => 75,  153 => 72,  147 => 69,  144 => 176,  141 => 175,  138 => 61,  136 => 168,  132 => 59,  128 => 49,  123 => 57,  120 => 56,  110 => 28,  104 => 90,  98 => 25,  92 => 45,  86 => 46,  78 => 20,  70 => 33,  59 => 28,  54 => 25,  43 => 15,  38 => 17,  35 => 16,  250 => 341,  247 => 72,  241 => 87,  235 => 311,  233 => 304,  230 => 303,  224 => 103,  221 => 61,  219 => 76,  214 => 99,  203 => 93,  198 => 54,  190 => 67,  186 => 239,  180 => 49,  178 => 48,  175 => 47,  169 => 210,  166 => 209,  164 => 203,  159 => 196,  143 => 36,  134 => 161,  131 => 160,  127 => 16,  121 => 131,  115 => 12,  112 => 52,  109 => 105,  102 => 39,  96 => 67,  94 => 24,  91 => 23,  75 => 19,  65 => 18,  62 => 16,  51 => 18,  46 => 21,  37 => 5,  31 => 3,  624 => 282,  621 => 281,  616 => 214,  613 => 213,  609 => 273,  593 => 105,  589 => 267,  583 => 266,  580 => 265,  574 => 263,  571 => 262,  568 => 261,  564 => 99,  561 => 259,  555 => 95,  553 => 194,  550 => 94,  545 => 191,  540 => 252,  538 => 251,  530 => 248,  520 => 247,  516 => 245,  513 => 244,  511 => 243,  507 => 181,  503 => 81,  495 => 233,  477 => 164,  474 => 163,  469 => 228,  466 => 227,  459 => 69,  456 => 68,  452 => 158,  450 => 64,  445 => 279,  442 => 62,  440 => 154,  437 => 61,  435 => 231,  432 => 230,  430 => 227,  427 => 226,  421 => 223,  418 => 222,  416 => 221,  413 => 220,  409 => 141,  394 => 217,  391 => 216,  387 => 134,  384 => 214,  378 => 211,  375 => 127,  373 => 209,  370 => 125,  368 => 34,  362 => 124,  359 => 123,  314 => 162,  303 => 159,  295 => 142,  291 => 99,  287 => 152,  283 => 138,  270 => 150,  266 => 366,  260 => 363,  248 => 336,  242 => 113,  229 => 135,  216 => 100,  212 => 279,  208 => 132,  200 => 127,  196 => 71,  192 => 88,  184 => 233,  157 => 93,  155 => 92,  148 => 56,  100 => 38,  97 => 37,  93 => 39,  88 => 37,  84 => 41,  80 => 41,  76 => 31,  72 => 37,  67 => 32,  64 => 3,  60 => 10,  58 => 26,  42 => 7,  39 => 6,  34 => 4,);
    }
}
