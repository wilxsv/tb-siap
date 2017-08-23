<?php

/* SonataAdminBundle:CRUD:base_standard_edit_field.html.twig */
class __TwigTemplate_7207f03bb0a7199a9b087544c716b309284ddc6e47ef7662dc288c0ff7d27d52 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'label' => array($this, 'block_label'),
            'field' => array($this, 'block_field'),
            'help' => array($this, 'block_help'),
            'errors' => array($this, 'block_errors'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 11
        echo "
<div class=\"form-group";
        // line 12
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["field_element"]) ? $context["field_element"] : $this->getContext($context, "field_element")), "var"), "errors")) > 0)) {
            echo " has-error";
        }
        echo "\" id=\"sonata-ba-field-container-";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["field_element"]) ? $context["field_element"] : $this->getContext($context, "field_element")), "vars"), "id"), "html", null, true);
        echo "\">
    ";
        // line 13
        $this->displayBlock('label', $context, $blocks);
        // line 20
        echo "
    <div class=\"col-sm-10 col-md-5 sonata-ba-field sonata-ba-field-";
        // line 21
        echo twig_escape_filter($this->env, (isset($context["edit"]) ? $context["edit"] : $this->getContext($context, "edit")), "html", null, true);
        echo "-";
        echo twig_escape_filter($this->env, (isset($context["inline"]) ? $context["inline"] : $this->getContext($context, "inline")), "html", null, true);
        echo " ";
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["field_element"]) ? $context["field_element"] : $this->getContext($context, "field_element")), "vars"), "errors")) > 0)) {
            echo "sonata-ba-field-error";
        }
        echo "\">

        ";
        // line 23
        $this->displayBlock('field', $context, $blocks);
        // line 24
        echo "
        ";
        // line 25
        if ($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "help")) {
            // line 26
            echo "            <span class=\"help-block\">";
            $this->displayBlock('help', $context, $blocks);
            echo "</span>
        ";
        }
        // line 28
        echo "
        <div class=\"sonata-ba-field-error-messages\">
            ";
        // line 30
        $this->displayBlock('errors', $context, $blocks);
        // line 31
        echo "        </div>

    </div>
</div>
";
    }

    // line 13
    public function block_label($context, array $blocks = array())
    {
        // line 14
        echo "        ";
        if ($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "name", array(), "any", true, true)) {
            // line 15
            echo "            ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["field_element"]) ? $context["field_element"] : $this->getContext($context, "field_element")), 'label', (twig_test_empty($_label_ = $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options"), "name")) ? array() : array("label" => $_label_)));
            echo "
        ";
        } else {
            // line 17
            echo "            ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["field_element"]) ? $context["field_element"] : $this->getContext($context, "field_element")), 'label');
            echo "
        ";
        }
        // line 19
        echo "    ";
    }

    // line 23
    public function block_field($context, array $blocks = array())
    {
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["field_element"]) ? $context["field_element"] : $this->getContext($context, "field_element")), 'widget');
    }

    // line 26
    public function block_help($context, array $blocks = array())
    {
        echo $this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "help");
    }

    // line 30
    public function block_errors($context, array $blocks = array())
    {
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["field_element"]) ? $context["field_element"] : $this->getContext($context, "field_element")), 'errors');
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:base_standard_edit_field.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  956 => 271,  953 => 270,  946 => 302,  942 => 300,  933 => 296,  925 => 292,  917 => 291,  914 => 290,  912 => 289,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 277,  870 => 274,  868 => 273,  863 => 269,  853 => 261,  848 => 258,  840 => 253,  834 => 249,  832 => 248,  822 => 244,  820 => 243,  816 => 241,  807 => 237,  805 => 236,  802 => 235,  791 => 262,  788 => 233,  778 => 267,  773 => 264,  765 => 230,  760 => 222,  757 => 221,  738 => 214,  720 => 211,  717 => 210,  713 => 209,  700 => 205,  679 => 200,  673 => 198,  668 => 197,  663 => 195,  660 => 194,  657 => 193,  650 => 192,  647 => 191,  644 => 190,  632 => 187,  629 => 186,  626 => 184,  603 => 179,  600 => 178,  594 => 176,  588 => 175,  584 => 173,  570 => 164,  561 => 161,  554 => 224,  551 => 221,  546 => 175,  522 => 156,  513 => 230,  479 => 135,  468 => 128,  451 => 120,  448 => 119,  424 => 114,  418 => 112,  410 => 110,  376 => 103,  373 => 102,  340 => 91,  326 => 86,  261 => 50,  118 => 23,  200 => 31,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 306,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 298,  1056 => 293,  1053 => 292,  1051 => 291,  1048 => 290,  1040 => 285,  1036 => 284,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 280,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 255,  961 => 254,  958 => 253,  955 => 252,  952 => 251,  950 => 269,  947 => 249,  939 => 243,  936 => 297,  934 => 241,  931 => 295,  923 => 236,  920 => 235,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 227,  894 => 226,  892 => 282,  889 => 224,  881 => 278,  878 => 219,  876 => 276,  873 => 217,  865 => 272,  862 => 212,  860 => 268,  857 => 267,  849 => 206,  846 => 205,  844 => 204,  841 => 203,  833 => 199,  830 => 198,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 190,  809 => 189,  798 => 184,  796 => 233,  793 => 182,  785 => 232,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 165,  753 => 220,  751 => 163,  739 => 156,  729 => 155,  724 => 154,  721 => 153,  712 => 150,  710 => 149,  707 => 208,  699 => 142,  697 => 141,  696 => 204,  695 => 139,  694 => 138,  689 => 137,  680 => 134,  675 => 132,  662 => 125,  658 => 124,  654 => 123,  649 => 122,  643 => 120,  640 => 119,  638 => 118,  617 => 112,  614 => 111,  598 => 107,  593 => 105,  576 => 101,  564 => 162,  557 => 96,  550 => 94,  527 => 91,  515 => 305,  512 => 84,  509 => 228,  503 => 81,  496 => 79,  493 => 143,  478 => 74,  467 => 72,  456 => 68,  450 => 64,  414 => 52,  408 => 109,  388 => 42,  371 => 35,  363 => 32,  350 => 26,  342 => 23,  335 => 21,  316 => 16,  290 => 5,  276 => 393,  266 => 366,  263 => 365,  255 => 353,  245 => 335,  207 => 33,  194 => 66,  184 => 68,  76 => 27,  810 => 238,  804 => 260,  801 => 185,  799 => 234,  795 => 256,  792 => 255,  780 => 303,  777 => 253,  774 => 252,  771 => 232,  768 => 231,  766 => 249,  761 => 247,  749 => 218,  746 => 161,  743 => 217,  735 => 238,  732 => 213,  715 => 151,  698 => 234,  693 => 232,  688 => 202,  685 => 230,  682 => 201,  672 => 223,  670 => 222,  665 => 196,  648 => 219,  627 => 217,  622 => 216,  619 => 183,  616 => 182,  613 => 213,  610 => 181,  608 => 211,  605 => 210,  596 => 106,  592 => 203,  587 => 201,  585 => 200,  582 => 199,  578 => 178,  572 => 176,  566 => 174,  547 => 93,  545 => 191,  542 => 190,  533 => 186,  531 => 225,  507 => 156,  505 => 180,  502 => 179,  477 => 164,  471 => 129,  465 => 161,  454 => 121,  446 => 156,  443 => 155,  431 => 151,  428 => 116,  425 => 149,  422 => 148,  412 => 142,  406 => 140,  390 => 43,  383 => 132,  377 => 37,  375 => 127,  372 => 126,  370 => 101,  359 => 123,  356 => 126,  353 => 121,  349 => 119,  336 => 115,  332 => 88,  330 => 113,  318 => 110,  313 => 15,  291 => 80,  190 => 67,  321 => 152,  295 => 142,  274 => 53,  242 => 113,  236 => 42,  70 => 29,  170 => 79,  288 => 79,  284 => 97,  279 => 77,  275 => 103,  256 => 96,  250 => 44,  237 => 86,  232 => 82,  222 => 297,  191 => 26,  153 => 55,  150 => 61,  563 => 173,  560 => 172,  558 => 160,  553 => 194,  549 => 182,  543 => 174,  537 => 159,  532 => 174,  528 => 184,  525 => 157,  523 => 171,  518 => 170,  514 => 168,  511 => 167,  508 => 165,  501 => 154,  491 => 171,  487 => 156,  460 => 123,  455 => 141,  449 => 157,  442 => 62,  439 => 133,  436 => 132,  433 => 60,  426 => 58,  420 => 123,  415 => 121,  411 => 120,  405 => 108,  403 => 48,  380 => 130,  366 => 150,  354 => 101,  331 => 96,  325 => 94,  320 => 84,  317 => 121,  311 => 83,  308 => 13,  304 => 81,  272 => 134,  267 => 78,  249 => 89,  216 => 35,  155 => 73,  146 => 34,  126 => 66,  188 => 25,  181 => 232,  161 => 75,  110 => 42,  124 => 25,  692 => 399,  683 => 135,  678 => 133,  676 => 199,  666 => 126,  661 => 380,  656 => 378,  652 => 376,  645 => 369,  641 => 189,  635 => 188,  631 => 218,  625 => 361,  615 => 354,  607 => 180,  597 => 177,  590 => 202,  583 => 334,  579 => 332,  577 => 329,  575 => 328,  569 => 325,  565 => 324,  555 => 95,  548 => 176,  540 => 160,  536 => 187,  529 => 159,  524 => 90,  516 => 294,  510 => 293,  504 => 155,  500 => 172,  495 => 158,  490 => 142,  486 => 168,  482 => 136,  470 => 73,  464 => 125,  459 => 69,  452 => 158,  434 => 118,  421 => 244,  417 => 243,  400 => 47,  385 => 41,  361 => 207,  344 => 24,  339 => 116,  324 => 179,  310 => 107,  302 => 168,  296 => 151,  282 => 161,  259 => 149,  244 => 43,  231 => 133,  226 => 131,  215 => 280,  186 => 47,  152 => 62,  114 => 111,  104 => 18,  358 => 103,  351 => 135,  347 => 134,  343 => 92,  338 => 130,  327 => 112,  323 => 85,  319 => 124,  315 => 109,  301 => 80,  299 => 8,  293 => 90,  289 => 140,  281 => 409,  277 => 95,  271 => 374,  265 => 51,  262 => 105,  260 => 363,  257 => 103,  251 => 101,  248 => 336,  239 => 97,  228 => 41,  225 => 298,  213 => 69,  211 => 81,  197 => 30,  174 => 154,  148 => 49,  134 => 55,  127 => 32,  20 => 1,  270 => 157,  253 => 342,  233 => 82,  212 => 74,  210 => 270,  206 => 71,  202 => 266,  198 => 66,  192 => 88,  185 => 61,  180 => 66,  175 => 74,  172 => 51,  167 => 56,  165 => 77,  160 => 38,  137 => 46,  113 => 40,  100 => 62,  90 => 27,  81 => 38,  65 => 27,  129 => 67,  97 => 39,  77 => 13,  34 => 13,  53 => 20,  84 => 41,  58 => 22,  23 => 11,  480 => 75,  474 => 163,  469 => 158,  461 => 70,  457 => 153,  453 => 151,  444 => 263,  440 => 154,  437 => 61,  435 => 146,  430 => 255,  427 => 143,  423 => 57,  413 => 241,  409 => 141,  407 => 238,  402 => 107,  398 => 137,  393 => 136,  387 => 134,  384 => 106,  381 => 105,  379 => 104,  374 => 36,  368 => 34,  365 => 141,  362 => 148,  360 => 128,  355 => 27,  341 => 131,  337 => 90,  322 => 93,  314 => 88,  312 => 149,  309 => 82,  305 => 115,  298 => 91,  294 => 100,  285 => 78,  283 => 138,  278 => 408,  268 => 373,  264 => 90,  258 => 354,  252 => 80,  247 => 78,  241 => 87,  229 => 73,  220 => 290,  214 => 75,  177 => 43,  169 => 78,  140 => 52,  132 => 28,  128 => 47,  107 => 37,  61 => 23,  273 => 392,  269 => 91,  254 => 46,  243 => 327,  240 => 326,  238 => 84,  235 => 311,  230 => 81,  227 => 80,  224 => 39,  221 => 38,  219 => 76,  217 => 56,  208 => 124,  204 => 267,  179 => 44,  159 => 196,  143 => 33,  135 => 35,  119 => 117,  102 => 19,  71 => 25,  67 => 30,  63 => 28,  59 => 20,  28 => 14,  94 => 16,  89 => 17,  85 => 31,  75 => 33,  68 => 10,  56 => 21,  87 => 57,  201 => 74,  196 => 52,  183 => 46,  171 => 153,  166 => 209,  163 => 45,  158 => 74,  156 => 64,  151 => 54,  142 => 54,  138 => 57,  136 => 70,  121 => 24,  117 => 51,  105 => 26,  91 => 38,  62 => 24,  49 => 15,  25 => 12,  21 => 12,  31 => 15,  38 => 18,  26 => 12,  24 => 3,  19 => 11,  93 => 39,  88 => 33,  78 => 37,  46 => 19,  44 => 17,  27 => 12,  79 => 28,  72 => 37,  69 => 31,  47 => 18,  40 => 14,  37 => 17,  22 => 12,  246 => 99,  157 => 51,  145 => 60,  139 => 59,  131 => 160,  123 => 65,  120 => 51,  115 => 45,  111 => 30,  108 => 21,  101 => 37,  98 => 36,  96 => 18,  83 => 15,  74 => 26,  66 => 23,  55 => 25,  52 => 24,  50 => 23,  43 => 21,  41 => 20,  35 => 22,  32 => 5,  29 => 14,  209 => 96,  203 => 32,  199 => 265,  193 => 51,  189 => 63,  187 => 69,  182 => 23,  176 => 309,  173 => 65,  168 => 69,  164 => 55,  162 => 68,  154 => 36,  149 => 62,  147 => 52,  144 => 59,  141 => 72,  133 => 69,  130 => 57,  125 => 46,  122 => 45,  116 => 50,  112 => 52,  109 => 19,  106 => 64,  103 => 63,  99 => 23,  95 => 19,  92 => 59,  86 => 36,  82 => 36,  80 => 14,  73 => 29,  64 => 24,  60 => 26,  57 => 26,  54 => 23,  51 => 16,  48 => 21,  45 => 13,  42 => 16,  39 => 21,  36 => 20,  33 => 16,  30 => 17,);
    }
}
