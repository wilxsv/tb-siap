<?php

/* SonataAdminBundle:Block:block_admin_list.html.twig */
class __TwigTemplate_979f3b7b950afa990648d04e6994880dabd4cf54dd0475856a94587d4caace79 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'block' => array($this, 'block_block'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate($this->getAttribute($this->getAttribute((isset($context["sonata_block"]) ? $context["sonata_block"] : $this->getContext($context, "sonata_block")), "templates"), "block_base"));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_block($context, array $blocks = array())
    {
        // line 15
        echo "    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["groups"]) ? $context["groups"] : $this->getContext($context, "groups")));
        foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
            // line 16
            echo "        ";
            $context["display"] = (twig_test_empty($this->getAttribute((isset($context["group"]) ? $context["group"] : $this->getContext($context, "group")), "roles")) || $this->env->getExtension('security')->isGranted("ROLE_SUPER_ADMIN"));
            // line 17
            echo "        ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["group"]) ? $context["group"] : $this->getContext($context, "group")), "roles"));
            foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
                if ((!(isset($context["display"]) ? $context["display"] : $this->getContext($context, "display")))) {
                    // line 18
                    echo "            ";
                    $context["display"] = $this->env->getExtension('security')->isGranted((isset($context["role"]) ? $context["role"] : $this->getContext($context, "role")));
                    // line 19
                    echo "        ";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 20
            echo "
        ";
            // line 21
            if ((isset($context["display"]) ? $context["display"] : $this->getContext($context, "display"))) {
                // line 22
                echo "            <div class=\"box\">
                <div class=\"box-header\">
                    <h3 class=\"box-title\">";
                // line 24
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["group"]) ? $context["group"] : $this->getContext($context, "group")), "label"), array(), $this->getAttribute((isset($context["group"]) ? $context["group"] : $this->getContext($context, "group")), "label_catalogue")), "html", null, true);
                echo "</h3>
                </div>
                <div class=\"box-body\">
                    <table class=\"table table-hover\">
                        <tbody>
                            ";
                // line 29
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["group"]) ? $context["group"] : $this->getContext($context, "group")), "items"));
                foreach ($context['_seq'] as $context["_key"] => $context["admin"]) {
                    // line 30
                    echo "                                ";
                    if ((($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "create"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "CREATE"), "method")) || ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "list"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "LIST"), "method")))) {
                        // line 31
                        echo "                                            <tr>
                                                <td class=\"sonata-ba-list-label\" width=\"40%\">
                                                    ";
                        // line 33
                        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "label"), array(), $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "translationdomain")), "html", null, true);
                        echo "
                                                </td>
                                                <td>
                                                    <div class=\"btn-group\">
                                                        ";
                        // line 37
                        if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "create"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "CREATE"), "method"))) {
                            // line 38
                            echo "                                                            ";
                            if (twig_test_empty($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "subClasses"))) {
                                // line 39
                                echo "                                                                <a class=\"btn btn-link btn-flat\" href=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "create"), "method"), "html", null, true);
                                echo "\">
                                                                    <i class=\"fa fa-plus-circle\"></i>
                                                                    ";
                                // line 41
                                echo $this->env->getExtension('translator')->getTranslator()->trans("link_add", array(), "SonataAdminBundle");
                                // line 42
                                echo "                                                                </a>
                                                            ";
                            } else {
                                // line 44
                                echo "                                                                <a class=\"btn btn-link btn-flat dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">
                                                                    <i class=\"fa fa-plus-circle\"></i>
                                                                    ";
                                // line 46
                                echo $this->env->getExtension('translator')->getTranslator()->trans("link_add", array(), "SonataAdminBundle");
                                // line 47
                                echo "                                                                    <span class=\"caret\"></span>
                                                                </a>
                                                                <ul class=\"dropdown-menu\">
                                                                    ";
                                // line 50
                                $context['_parent'] = (array) $context;
                                $context['_seq'] = twig_ensure_traversable(twig_get_array_keys_filter($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "subclasses")));
                                foreach ($context['_seq'] as $context["_key"] => $context["subclass"]) {
                                    // line 51
                                    echo "                                                                        <li>
                                                                            <a href=\"";
                                    // line 52
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "create", 1 => array("subclass" => (isset($context["subclass"]) ? $context["subclass"] : $this->getContext($context, "subclass")))), "method"), "html", null, true);
                                    echo "\">";
                                    echo twig_escape_filter($this->env, (isset($context["subclass"]) ? $context["subclass"] : $this->getContext($context, "subclass")), "html", null, true);
                                    echo "</a>
                                                                        </li>
                                                                    ";
                                }
                                $_parent = $context['_parent'];
                                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['subclass'], $context['_parent'], $context['loop']);
                                $context = array_intersect_key($context, $_parent) + $_parent;
                                // line 55
                                echo "                                                                </ul>
                                                            ";
                            }
                            // line 57
                            echo "                                                        ";
                        }
                        // line 58
                        echo "                                                        ";
                        if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "list"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "LIST"), "method"))) {
                            // line 59
                            echo "                                                            <a class=\"btn btn-link btn-flat\" href=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "list"), "method"), "html", null, true);
                            echo "\">
                                                                <i class=\"glyphicon glyphicon-list\"></i>
                                                                ";
                            // line 61
                            echo $this->env->getExtension('translator')->getTranslator()->trans("link_list", array(), "SonataAdminBundle");
                            // line 62
                            echo "</a>
                                                        ";
                        }
                        // line 64
                        echo "                                                    </div>
                                                </td>
                                            </tr>
                                ";
                    }
                    // line 68
                    echo "                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['admin'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 69
                echo "                        </tbody>
                    </table>
                </div>
            </div>
        ";
            }
            // line 74
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:Block:block_admin_list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  118 => 23,  200 => 54,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 306,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 298,  1056 => 293,  1053 => 292,  1051 => 291,  1048 => 290,  1040 => 285,  1036 => 284,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 280,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 255,  961 => 254,  958 => 253,  955 => 252,  952 => 251,  950 => 250,  947 => 249,  939 => 243,  936 => 242,  934 => 241,  931 => 240,  923 => 236,  920 => 235,  918 => 234,  915 => 233,  903 => 229,  900 => 228,  897 => 227,  894 => 226,  892 => 225,  889 => 224,  881 => 220,  878 => 219,  876 => 218,  873 => 217,  865 => 213,  862 => 212,  860 => 211,  857 => 210,  849 => 206,  846 => 205,  844 => 204,  841 => 203,  833 => 199,  830 => 198,  828 => 197,  825 => 196,  817 => 192,  814 => 191,  812 => 190,  809 => 189,  798 => 184,  796 => 183,  793 => 182,  785 => 178,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 165,  753 => 164,  751 => 163,  739 => 156,  729 => 155,  724 => 154,  721 => 153,  712 => 150,  710 => 149,  707 => 148,  699 => 142,  697 => 141,  696 => 140,  695 => 139,  694 => 138,  689 => 137,  680 => 134,  675 => 132,  662 => 125,  658 => 124,  654 => 123,  649 => 122,  643 => 120,  640 => 119,  638 => 118,  617 => 112,  614 => 111,  598 => 107,  593 => 105,  576 => 101,  564 => 99,  557 => 96,  550 => 94,  527 => 91,  515 => 85,  512 => 84,  509 => 83,  503 => 81,  496 => 79,  493 => 78,  478 => 74,  467 => 72,  456 => 68,  450 => 64,  414 => 52,  408 => 50,  388 => 42,  371 => 35,  363 => 32,  350 => 26,  342 => 23,  335 => 21,  316 => 16,  290 => 5,  276 => 393,  266 => 366,  263 => 365,  255 => 353,  245 => 335,  207 => 269,  194 => 66,  184 => 68,  76 => 31,  810 => 263,  804 => 260,  801 => 185,  799 => 258,  795 => 256,  792 => 255,  780 => 176,  777 => 253,  774 => 252,  771 => 251,  768 => 250,  766 => 249,  761 => 247,  749 => 162,  746 => 161,  743 => 243,  735 => 238,  732 => 237,  715 => 151,  698 => 234,  693 => 232,  688 => 231,  685 => 230,  682 => 229,  672 => 223,  670 => 222,  665 => 221,  648 => 219,  627 => 217,  622 => 216,  619 => 113,  616 => 214,  613 => 213,  610 => 212,  608 => 211,  605 => 210,  596 => 106,  592 => 203,  587 => 201,  585 => 200,  582 => 199,  578 => 178,  572 => 176,  566 => 174,  547 => 93,  545 => 191,  542 => 190,  533 => 186,  531 => 185,  507 => 181,  505 => 180,  502 => 179,  477 => 164,  471 => 162,  465 => 161,  454 => 159,  446 => 156,  443 => 155,  431 => 151,  428 => 59,  425 => 149,  422 => 148,  412 => 142,  406 => 140,  390 => 43,  383 => 132,  377 => 37,  375 => 127,  372 => 126,  370 => 125,  359 => 123,  356 => 122,  353 => 121,  349 => 119,  336 => 115,  332 => 20,  330 => 113,  318 => 110,  313 => 15,  291 => 99,  190 => 67,  321 => 152,  295 => 142,  274 => 94,  242 => 113,  236 => 109,  70 => 29,  170 => 79,  288 => 4,  284 => 97,  279 => 96,  275 => 103,  256 => 96,  250 => 341,  237 => 86,  232 => 82,  222 => 297,  191 => 246,  153 => 55,  150 => 61,  563 => 173,  560 => 172,  558 => 186,  553 => 194,  549 => 182,  543 => 179,  537 => 176,  532 => 174,  528 => 184,  525 => 183,  523 => 171,  518 => 170,  514 => 168,  511 => 167,  508 => 165,  501 => 80,  491 => 171,  487 => 156,  460 => 143,  455 => 141,  449 => 157,  442 => 62,  439 => 133,  436 => 132,  433 => 60,  426 => 58,  420 => 123,  415 => 121,  411 => 120,  405 => 49,  403 => 48,  380 => 130,  366 => 33,  354 => 101,  331 => 96,  325 => 94,  320 => 122,  317 => 121,  311 => 14,  308 => 13,  304 => 103,  272 => 134,  267 => 78,  249 => 89,  216 => 100,  155 => 52,  146 => 34,  126 => 26,  188 => 48,  181 => 232,  161 => 202,  110 => 42,  124 => 25,  692 => 399,  683 => 135,  678 => 133,  676 => 225,  666 => 126,  661 => 380,  656 => 378,  652 => 376,  645 => 369,  641 => 368,  635 => 117,  631 => 218,  625 => 361,  615 => 354,  607 => 349,  597 => 342,  590 => 202,  583 => 334,  579 => 332,  577 => 329,  575 => 328,  569 => 325,  565 => 324,  555 => 95,  548 => 313,  540 => 308,  536 => 187,  529 => 92,  524 => 90,  516 => 294,  510 => 293,  504 => 292,  500 => 172,  495 => 158,  490 => 77,  486 => 168,  482 => 285,  470 => 73,  464 => 71,  459 => 69,  452 => 158,  434 => 152,  421 => 244,  417 => 243,  400 => 47,  385 => 41,  361 => 207,  344 => 24,  339 => 116,  324 => 179,  310 => 107,  302 => 168,  296 => 167,  282 => 161,  259 => 149,  244 => 88,  231 => 133,  226 => 131,  215 => 280,  186 => 47,  152 => 62,  114 => 111,  104 => 90,  358 => 103,  351 => 135,  347 => 134,  343 => 132,  338 => 130,  327 => 112,  323 => 111,  319 => 124,  315 => 109,  301 => 144,  299 => 8,  293 => 6,  289 => 140,  281 => 409,  277 => 95,  271 => 374,  265 => 130,  262 => 105,  260 => 363,  257 => 103,  251 => 101,  248 => 336,  239 => 97,  228 => 80,  225 => 298,  213 => 69,  211 => 81,  197 => 72,  174 => 42,  148 => 49,  134 => 55,  127 => 32,  20 => 1,  270 => 157,  253 => 342,  233 => 82,  212 => 74,  210 => 270,  206 => 71,  202 => 266,  198 => 66,  192 => 88,  185 => 61,  180 => 66,  175 => 74,  172 => 51,  167 => 56,  165 => 61,  160 => 38,  137 => 46,  113 => 40,  100 => 40,  90 => 38,  81 => 33,  65 => 27,  129 => 44,  97 => 39,  77 => 31,  34 => 16,  53 => 20,  84 => 41,  58 => 22,  23 => 18,  480 => 75,  474 => 163,  469 => 158,  461 => 70,  457 => 153,  453 => 151,  444 => 263,  440 => 154,  437 => 61,  435 => 146,  430 => 255,  427 => 143,  423 => 57,  413 => 241,  409 => 141,  407 => 238,  402 => 237,  398 => 137,  393 => 136,  387 => 134,  384 => 109,  381 => 120,  379 => 119,  374 => 36,  368 => 34,  365 => 141,  362 => 124,  360 => 104,  355 => 27,  341 => 131,  337 => 22,  322 => 93,  314 => 88,  312 => 149,  309 => 148,  305 => 115,  298 => 91,  294 => 100,  285 => 3,  283 => 138,  278 => 408,  268 => 373,  264 => 90,  258 => 354,  252 => 80,  247 => 78,  241 => 87,  229 => 73,  220 => 290,  214 => 75,  177 => 43,  169 => 210,  140 => 52,  132 => 28,  128 => 47,  107 => 37,  61 => 27,  273 => 392,  269 => 91,  254 => 147,  243 => 327,  240 => 326,  238 => 84,  235 => 311,  230 => 81,  227 => 80,  224 => 79,  221 => 79,  219 => 76,  217 => 56,  208 => 124,  204 => 267,  179 => 44,  159 => 196,  143 => 33,  135 => 35,  119 => 117,  102 => 19,  71 => 11,  67 => 31,  63 => 24,  59 => 23,  28 => 14,  94 => 34,  89 => 39,  85 => 34,  75 => 33,  68 => 10,  56 => 21,  87 => 14,  201 => 74,  196 => 52,  183 => 46,  171 => 57,  166 => 209,  163 => 45,  158 => 75,  156 => 64,  151 => 54,  142 => 54,  138 => 57,  136 => 47,  121 => 24,  117 => 51,  105 => 44,  91 => 38,  62 => 24,  49 => 20,  25 => 12,  21 => 12,  31 => 15,  38 => 18,  26 => 14,  24 => 13,  19 => 11,  93 => 39,  88 => 37,  78 => 34,  46 => 19,  44 => 21,  27 => 14,  79 => 35,  72 => 37,  69 => 32,  47 => 21,  40 => 14,  37 => 17,  22 => 12,  246 => 99,  157 => 51,  145 => 60,  139 => 59,  131 => 160,  123 => 52,  120 => 51,  115 => 45,  111 => 47,  108 => 21,  101 => 42,  98 => 35,  96 => 18,  83 => 32,  74 => 30,  66 => 30,  55 => 25,  52 => 21,  50 => 23,  43 => 18,  41 => 19,  35 => 19,  32 => 4,  29 => 15,  209 => 96,  203 => 55,  199 => 265,  193 => 51,  189 => 63,  187 => 69,  182 => 85,  176 => 58,  173 => 65,  168 => 69,  164 => 55,  162 => 68,  154 => 36,  149 => 62,  147 => 52,  144 => 59,  141 => 58,  133 => 46,  130 => 57,  125 => 46,  122 => 45,  116 => 50,  112 => 52,  109 => 46,  106 => 104,  103 => 41,  99 => 41,  95 => 41,  92 => 38,  86 => 36,  82 => 36,  80 => 13,  73 => 27,  64 => 24,  60 => 22,  57 => 20,  54 => 25,  51 => 9,  48 => 21,  45 => 18,  42 => 17,  39 => 16,  36 => 19,  33 => 16,  30 => 15,);
    }
}
