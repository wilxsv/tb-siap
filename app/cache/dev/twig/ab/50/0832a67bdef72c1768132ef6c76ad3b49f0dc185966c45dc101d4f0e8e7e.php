<?php

/* FOSUserBundle:ChangePassword:changePassword.html.twig */
class __TwigTemplate_ab500832a67bdef72c1768132ef6c76ad3b49f0dc185966c45dc101d4f0e8e7e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataUserBundle::layout.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'fos_user_content' => array($this, 'block_fos_user_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataUserBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <style type=\"text/css\">
        .ui-front {
            z-index: 1030 !important;
        }
    </style>
";
    }

    // line 12
    public function block_javascripts($context, array $blocks = array())
    {
        // line 13
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    <script type=\"text/javascript\">
        \$(document).ready(function() {
            \$(\"#guardar\").click(function() {
                if (\$(\"#fos_user_change_password_form_new_first\").val() != \$(\"#fos_user_change_password_form_new_second\").val()) {
                    \$(\"#fos_user_change_password_form_new_first\").val('');
                    \$(\"#fos_user_change_password_form_new_second\").val('');
                    \$(\"#fos_user_change_password_form_new_first\").focus();

                    \$(\"body\").append('<div id=\"dialog-message\"></div>');
                    \$(\"#dialog-message\").empty();
                    \$(\"#dialog-message\").append('<p><span class=\"glyphicon glyphicon-exclamation-sign\"></span> Los campos de la nueva contraseña no coinciden.<br /><strong>Por favor vuelva a digitarlas</strong></p>');
                    \$(\"#dialog-message\").dialog({
                        dialogClass: \"dialog-error\",
                        modal: true,
                        title: 'Contraseñas no coinciden.',
                        width: 500,
                        buttons: {
                            Aceptar: function() {
                                \$( this ).dialog( \"close\" );
                            }
                        }
                    });
                    
                    return false;
                }

            });
        });

    </script>
";
    }

    // line 46
    public function block_fos_user_content($context, array $blocks = array())
    {
        // line 47
        echo "    <center>
        <form action=\"";
        // line 48
        echo $this->env->getExtension('routing')->getPath("fos_user_change_password");
        echo "\" ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
        echo " method=\"POST\" class=\"fos_user_change_password\">
            <table style=\"border-collapse: separate; border-spacing: 10px;\">
                <tr>
                    <td>";
        // line 51
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "current_password"), 'label', (twig_test_empty($_label_ = ((array_key_exists("label", $context)) ? (_twig_default_filter((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), null)) : (null))) ? array() : array("label" => $_label_)));
        echo "</td>
                    <td>";
        // line 52
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "current_password"), 'widget');
        echo "</td>
                </tr>
                <tr>
                    <td>";
        // line 55
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "new"), "first"), 'label', (twig_test_empty($_label_ = ((array_key_exists("label", $context)) ? (_twig_default_filter((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), null)) : (null))) ? array() : array("label" => $_label_)));
        echo "</td>
                    <td>";
        // line 56
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "new"), "first"), 'widget');
        echo "</td>
                </tr>
                <tr>
                    <td>";
        // line 59
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "new"), "second"), 'label', (twig_test_empty($_label_ = ((array_key_exists("label", $context)) ? (_twig_default_filter((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), null)) : (null))) ? array() : array("label" => $_label_)));
        echo "</td>
                    <td>";
        // line 60
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "new"), "second"), 'widget');
        echo "</td>
                </tr>
            </table>
            ";
        // line 63
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
        echo "
            <div>
                <button id=\"guardar\" type=\"submit\" class=\"btn btn-primary\">
                    <span class=\"glyphicon glyphicon-ok\"></span> ";
        // line 66
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("change_password.submit", array(), "FOSUserBundle"), "html", null, true);
        echo "
                </button>
                <a class=\"btn btn-info\" href=\"";
        // line 68
        echo $this->env->getExtension('routing')->getPath("_inicio");
        echo "\">
                    <span class=\"glyphicon glyphicon-home\"></span> Regresar
                </a>
            </div>
        </form>
    </center>
";
    }

    public function getTemplateName()
    {
        return "FOSUserBundle:ChangePassword:changePassword.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  306 => 95,  303 => 94,  300 => 93,  292 => 91,  280 => 87,  12 => 36,  624 => 224,  620 => 223,  612 => 220,  601 => 216,  599 => 215,  580 => 207,  574 => 205,  559 => 201,  526 => 190,  497 => 156,  485 => 124,  463 => 117,  447 => 113,  404 => 90,  401 => 89,  391 => 163,  369 => 148,  333 => 132,  329 => 130,  307 => 82,  287 => 89,  195 => 54,  178 => 46,  956 => 271,  953 => 270,  946 => 302,  942 => 300,  933 => 296,  925 => 292,  917 => 291,  914 => 290,  912 => 289,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 277,  870 => 274,  868 => 273,  863 => 269,  853 => 261,  848 => 258,  840 => 253,  834 => 249,  832 => 248,  822 => 244,  820 => 243,  816 => 241,  807 => 237,  805 => 236,  802 => 235,  791 => 262,  788 => 233,  778 => 267,  773 => 264,  765 => 230,  760 => 222,  757 => 221,  738 => 214,  720 => 211,  717 => 210,  713 => 209,  700 => 205,  679 => 200,  673 => 198,  668 => 197,  663 => 195,  660 => 194,  657 => 193,  650 => 192,  647 => 191,  644 => 190,  632 => 187,  629 => 186,  626 => 184,  603 => 179,  600 => 178,  594 => 212,  588 => 175,  584 => 173,  570 => 164,  561 => 161,  554 => 224,  551 => 199,  546 => 175,  522 => 156,  513 => 230,  479 => 135,  468 => 128,  451 => 120,  448 => 119,  424 => 91,  418 => 112,  410 => 113,  376 => 153,  373 => 102,  340 => 136,  326 => 129,  261 => 73,  118 => 49,  200 => 31,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 306,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 298,  1056 => 293,  1053 => 292,  1051 => 291,  1048 => 290,  1040 => 285,  1036 => 284,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 280,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 255,  961 => 254,  958 => 253,  955 => 252,  952 => 251,  950 => 269,  947 => 249,  939 => 243,  936 => 297,  934 => 241,  931 => 295,  923 => 236,  920 => 235,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 227,  894 => 226,  892 => 282,  889 => 224,  881 => 278,  878 => 219,  876 => 276,  873 => 217,  865 => 272,  862 => 212,  860 => 268,  857 => 267,  849 => 206,  846 => 205,  844 => 204,  841 => 203,  833 => 199,  830 => 198,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 190,  809 => 189,  798 => 184,  796 => 233,  793 => 182,  785 => 232,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 165,  753 => 220,  751 => 163,  739 => 156,  729 => 155,  724 => 154,  721 => 153,  712 => 150,  710 => 149,  707 => 208,  699 => 142,  697 => 141,  696 => 204,  695 => 139,  694 => 138,  689 => 137,  680 => 134,  675 => 132,  662 => 125,  658 => 124,  654 => 123,  649 => 122,  643 => 120,  640 => 119,  638 => 118,  617 => 112,  614 => 111,  598 => 107,  593 => 105,  576 => 101,  564 => 162,  557 => 96,  550 => 94,  527 => 91,  515 => 305,  512 => 84,  509 => 228,  503 => 81,  496 => 79,  493 => 155,  478 => 74,  467 => 72,  456 => 68,  450 => 114,  414 => 52,  408 => 109,  388 => 42,  371 => 35,  363 => 32,  350 => 26,  342 => 23,  335 => 133,  316 => 16,  290 => 90,  276 => 393,  266 => 366,  263 => 365,  255 => 353,  245 => 335,  207 => 58,  194 => 52,  184 => 48,  76 => 35,  810 => 238,  804 => 260,  801 => 185,  799 => 234,  795 => 256,  792 => 255,  780 => 303,  777 => 253,  774 => 252,  771 => 232,  768 => 231,  766 => 249,  761 => 247,  749 => 218,  746 => 161,  743 => 217,  735 => 238,  732 => 213,  715 => 151,  698 => 234,  693 => 232,  688 => 202,  685 => 230,  682 => 201,  672 => 223,  670 => 222,  665 => 196,  648 => 219,  627 => 217,  622 => 216,  619 => 183,  616 => 182,  613 => 213,  610 => 181,  608 => 211,  605 => 210,  596 => 106,  592 => 203,  587 => 201,  585 => 209,  582 => 199,  578 => 178,  572 => 204,  566 => 203,  547 => 93,  545 => 198,  542 => 190,  533 => 186,  531 => 225,  507 => 165,  505 => 180,  502 => 179,  477 => 164,  471 => 129,  465 => 161,  454 => 121,  446 => 156,  443 => 155,  431 => 151,  428 => 116,  425 => 149,  422 => 148,  412 => 126,  406 => 111,  390 => 43,  383 => 132,  377 => 37,  375 => 127,  372 => 126,  370 => 101,  359 => 144,  356 => 126,  353 => 121,  349 => 119,  336 => 115,  332 => 88,  330 => 103,  318 => 86,  313 => 84,  291 => 80,  190 => 49,  321 => 100,  295 => 142,  274 => 53,  242 => 113,  236 => 42,  70 => 29,  170 => 79,  288 => 79,  284 => 76,  279 => 77,  275 => 86,  256 => 79,  250 => 44,  237 => 71,  232 => 82,  222 => 66,  191 => 26,  153 => 55,  150 => 34,  563 => 202,  560 => 172,  558 => 160,  553 => 194,  549 => 182,  543 => 174,  537 => 159,  532 => 192,  528 => 184,  525 => 157,  523 => 189,  518 => 180,  514 => 167,  511 => 166,  508 => 165,  501 => 163,  491 => 171,  487 => 156,  460 => 123,  455 => 115,  449 => 157,  442 => 62,  439 => 133,  436 => 132,  433 => 60,  426 => 58,  420 => 123,  415 => 127,  411 => 120,  405 => 108,  403 => 48,  380 => 130,  366 => 150,  354 => 142,  331 => 96,  325 => 94,  320 => 87,  317 => 121,  311 => 83,  308 => 13,  304 => 81,  272 => 134,  267 => 78,  249 => 89,  216 => 35,  155 => 73,  146 => 34,  126 => 48,  188 => 25,  181 => 232,  161 => 75,  110 => 41,  124 => 51,  692 => 399,  683 => 135,  678 => 133,  676 => 199,  666 => 126,  661 => 380,  656 => 378,  652 => 376,  645 => 369,  641 => 189,  635 => 226,  631 => 218,  625 => 361,  615 => 354,  607 => 218,  597 => 177,  590 => 202,  583 => 334,  579 => 332,  577 => 206,  575 => 328,  569 => 325,  565 => 324,  555 => 200,  548 => 176,  540 => 160,  536 => 194,  529 => 191,  524 => 90,  516 => 294,  510 => 293,  504 => 164,  500 => 172,  495 => 158,  490 => 154,  486 => 168,  482 => 136,  470 => 121,  464 => 125,  459 => 116,  452 => 158,  434 => 118,  421 => 90,  417 => 243,  400 => 47,  385 => 159,  361 => 207,  344 => 24,  339 => 116,  324 => 179,  310 => 83,  302 => 79,  296 => 151,  282 => 161,  259 => 149,  244 => 43,  231 => 69,  226 => 131,  215 => 280,  186 => 51,  152 => 61,  114 => 44,  104 => 43,  358 => 103,  351 => 141,  347 => 140,  343 => 92,  338 => 130,  327 => 102,  323 => 88,  319 => 124,  315 => 98,  301 => 80,  299 => 8,  293 => 90,  289 => 140,  281 => 75,  277 => 95,  271 => 374,  265 => 51,  262 => 81,  260 => 363,  257 => 103,  251 => 101,  248 => 336,  239 => 64,  228 => 41,  225 => 67,  213 => 69,  211 => 81,  197 => 30,  174 => 154,  148 => 49,  134 => 28,  127 => 52,  20 => 11,  270 => 84,  253 => 78,  233 => 82,  212 => 60,  210 => 59,  206 => 57,  202 => 55,  198 => 55,  192 => 53,  185 => 61,  180 => 49,  175 => 45,  172 => 51,  167 => 56,  165 => 77,  160 => 40,  137 => 29,  113 => 56,  100 => 43,  90 => 39,  81 => 20,  65 => 29,  129 => 63,  97 => 41,  77 => 30,  34 => 14,  53 => 27,  84 => 34,  58 => 25,  23 => 12,  480 => 75,  474 => 122,  469 => 158,  461 => 70,  457 => 153,  453 => 151,  444 => 263,  440 => 154,  437 => 61,  435 => 146,  430 => 255,  427 => 143,  423 => 57,  413 => 241,  409 => 141,  407 => 238,  402 => 107,  398 => 88,  393 => 168,  387 => 134,  384 => 106,  381 => 157,  379 => 154,  374 => 36,  368 => 34,  365 => 141,  362 => 148,  360 => 128,  355 => 27,  341 => 131,  337 => 90,  322 => 93,  314 => 88,  312 => 97,  309 => 82,  305 => 115,  298 => 91,  294 => 100,  285 => 78,  283 => 138,  278 => 408,  268 => 373,  264 => 82,  258 => 72,  252 => 68,  247 => 75,  241 => 87,  229 => 73,  220 => 65,  214 => 63,  177 => 43,  169 => 44,  140 => 68,  132 => 57,  128 => 47,  107 => 40,  61 => 29,  273 => 85,  269 => 91,  254 => 46,  243 => 73,  240 => 72,  238 => 84,  235 => 63,  230 => 62,  227 => 80,  224 => 61,  221 => 38,  219 => 76,  217 => 64,  208 => 124,  204 => 57,  179 => 44,  159 => 196,  143 => 33,  135 => 66,  119 => 59,  102 => 43,  71 => 28,  67 => 32,  63 => 16,  59 => 24,  28 => 13,  94 => 41,  89 => 34,  85 => 46,  75 => 32,  68 => 27,  56 => 28,  87 => 28,  201 => 56,  196 => 52,  183 => 50,  171 => 44,  166 => 209,  163 => 58,  158 => 74,  156 => 38,  151 => 54,  142 => 30,  138 => 57,  136 => 70,  121 => 51,  117 => 45,  105 => 44,  91 => 48,  62 => 28,  49 => 17,  25 => 12,  21 => 11,  31 => 14,  38 => 14,  26 => 2,  24 => 13,  19 => 1,  93 => 39,  88 => 47,  78 => 21,  46 => 19,  44 => 16,  27 => 14,  79 => 34,  72 => 31,  69 => 29,  47 => 20,  40 => 24,  37 => 16,  22 => 12,  246 => 67,  157 => 56,  145 => 53,  139 => 51,  131 => 48,  123 => 60,  120 => 46,  115 => 47,  111 => 46,  108 => 42,  101 => 37,  98 => 36,  96 => 40,  83 => 32,  74 => 29,  66 => 17,  55 => 24,  52 => 23,  50 => 21,  43 => 25,  41 => 20,  35 => 20,  32 => 19,  29 => 15,  209 => 58,  203 => 32,  199 => 265,  193 => 51,  189 => 52,  187 => 69,  182 => 23,  176 => 309,  173 => 46,  168 => 43,  164 => 55,  162 => 41,  154 => 36,  149 => 35,  147 => 52,  144 => 26,  141 => 72,  133 => 49,  130 => 57,  125 => 46,  122 => 45,  116 => 43,  112 => 105,  109 => 55,  106 => 64,  103 => 52,  99 => 51,  95 => 41,  92 => 28,  86 => 25,  82 => 33,  80 => 31,  73 => 34,  64 => 19,  60 => 15,  57 => 20,  54 => 19,  51 => 29,  48 => 13,  45 => 12,  42 => 23,  39 => 15,  36 => 20,  33 => 4,  30 => 3,);
    }
}
