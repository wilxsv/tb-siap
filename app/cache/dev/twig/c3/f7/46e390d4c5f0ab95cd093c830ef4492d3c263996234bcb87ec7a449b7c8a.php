<?php

/* SonataAdminBundle:CRUD:base_history.html.twig */
class __TwigTemplate_c3f746e390d4c5f0ab95cd093c830ef4492d3c263996234bcb87ec7a449b7c8a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'actions' => array($this, 'block_actions'),
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
        $this->env->loadTemplate("SonataAdminBundle:Button:edit_button.html.twig")->display($context);
        echo "</li>
    <li>";
        // line 16
        $this->env->loadTemplate("SonataAdminBundle:Button:acl_button.html.twig")->display($context);
        echo "</li>
    <li>";
        // line 17
        $this->env->loadTemplate("SonataAdminBundle:Button:show_button.html.twig")->display($context);
        echo "</li>
    <li>";
        // line 18
        $this->env->loadTemplate("SonataAdminBundle:Button:list_button.html.twig")->display($context);
        echo "</li>
";
    }

    // line 21
    public function block_content($context, array $blocks = array())
    {
        // line 22
        echo "
    <div class=\"col-md-5\">
        <table class=\"table\" id=\"revisions\">
            <thead>
                <tr>
                    <th>";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("td_revision", array(), "SonataAdminBundle"), "html", null, true);
        echo "</th>
                    <th>";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("td_timestamp", array(), "SonataAdminBundle"), "html", null, true);
        echo "</th>
                    <th>";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("td_username", array(), "SonataAdminBundle"), "html", null, true);
        echo "</th>
                    <th>";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("td_action", array(), "SonataAdminBundle"), "html", null, true);
        echo "</th>
                </tr>
            </thead>
            <tbody>
                ";
        // line 34
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["revisions"]) ? $context["revisions"] : $this->getContext($context, "revisions")));
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
        foreach ($context['_seq'] as $context["_key"] => $context["revision"]) {
            // line 35
            echo "                    <tr>
                        <td>";
            // line 36
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["revision"]) ? $context["revision"] : $this->getContext($context, "revision")), "rev"), "html", null, true);
            echo "</td>
                        <td>";
            // line 37
            $template = $this->env->resolveTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "history_revision_timestamp"), "method"));
            $template->display($context);
            echo "</td>
                        <td>";
            // line 38
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["revision"]) ? $context["revision"] : $this->getContext($context, "revision")), "username"), "html", null, true);
            echo "</td>
                        <td><a href=\"";
            // line 39
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "history_view_revision", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), 2 => array("revision" => $this->getAttribute((isset($context["revision"]) ? $context["revision"] : $this->getContext($context, "revision")), "rev"))), "method"), "html", null, true);
            echo "\" class=\"revision-link\" rel=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["revision"]) ? $context["revision"] : $this->getContext($context, "revision")), "rev"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label_view_revision", array(), "SonataAdminBundle"), "html", null, true);
            echo "</a></td>
                    </tr>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['revision'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 42
        echo "            </tbody>
        </table>
    </div>
    <div id=\"revision-detail\" class=\"col-md-7 revision-detail\">

    </div>

    <script>
        jQuery(document).ready(function() {

            jQuery('a.revision-link').bind('click', function(event) {
                event.stopPropagation();
                event.preventDefault();

                jQuery('#revision-detail').html('');
                jQuery('table#revisions tbody tr').removeClass('current');
                jQuery(this).parent('').removeClass('current');

                jQuery.ajax({
                    url: jQuery(this).attr('href'),
                    dataType: 'html',
                    success: function(data) {
                        jQuery('#revision-detail').html(data);
                    }
                });

                return false;
            })
        });
    </script>
";
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:base_history.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  624 => 224,  620 => 223,  612 => 220,  601 => 216,  599 => 215,  580 => 207,  574 => 205,  559 => 201,  526 => 190,  497 => 156,  485 => 124,  463 => 117,  447 => 113,  404 => 90,  401 => 89,  391 => 163,  369 => 148,  333 => 132,  329 => 130,  307 => 82,  287 => 77,  195 => 54,  178 => 48,  956 => 271,  953 => 270,  946 => 302,  942 => 300,  933 => 296,  925 => 292,  917 => 291,  914 => 290,  912 => 289,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 277,  870 => 274,  868 => 273,  863 => 269,  853 => 261,  848 => 258,  840 => 253,  834 => 249,  832 => 248,  822 => 244,  820 => 243,  816 => 241,  807 => 237,  805 => 236,  802 => 235,  791 => 262,  788 => 233,  778 => 267,  773 => 264,  765 => 230,  760 => 222,  757 => 221,  738 => 214,  720 => 211,  717 => 210,  713 => 209,  700 => 205,  679 => 200,  673 => 198,  668 => 197,  663 => 195,  660 => 194,  657 => 193,  650 => 192,  647 => 191,  644 => 190,  632 => 187,  629 => 186,  626 => 184,  603 => 179,  600 => 178,  594 => 212,  588 => 175,  584 => 173,  570 => 164,  561 => 161,  554 => 224,  551 => 199,  546 => 175,  522 => 156,  513 => 230,  479 => 135,  468 => 128,  451 => 120,  448 => 119,  424 => 91,  418 => 112,  410 => 113,  376 => 153,  373 => 102,  340 => 136,  326 => 129,  261 => 73,  118 => 23,  200 => 31,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 306,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 298,  1056 => 293,  1053 => 292,  1051 => 291,  1048 => 290,  1040 => 285,  1036 => 284,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 280,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 255,  961 => 254,  958 => 253,  955 => 252,  952 => 251,  950 => 269,  947 => 249,  939 => 243,  936 => 297,  934 => 241,  931 => 295,  923 => 236,  920 => 235,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 227,  894 => 226,  892 => 282,  889 => 224,  881 => 278,  878 => 219,  876 => 276,  873 => 217,  865 => 272,  862 => 212,  860 => 268,  857 => 267,  849 => 206,  846 => 205,  844 => 204,  841 => 203,  833 => 199,  830 => 198,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 190,  809 => 189,  798 => 184,  796 => 233,  793 => 182,  785 => 232,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 165,  753 => 220,  751 => 163,  739 => 156,  729 => 155,  724 => 154,  721 => 153,  712 => 150,  710 => 149,  707 => 208,  699 => 142,  697 => 141,  696 => 204,  695 => 139,  694 => 138,  689 => 137,  680 => 134,  675 => 132,  662 => 125,  658 => 124,  654 => 123,  649 => 122,  643 => 120,  640 => 119,  638 => 118,  617 => 112,  614 => 111,  598 => 107,  593 => 105,  576 => 101,  564 => 162,  557 => 96,  550 => 94,  527 => 91,  515 => 305,  512 => 84,  509 => 228,  503 => 81,  496 => 79,  493 => 155,  478 => 74,  467 => 72,  456 => 68,  450 => 114,  414 => 52,  408 => 109,  388 => 42,  371 => 35,  363 => 32,  350 => 26,  342 => 23,  335 => 133,  316 => 16,  290 => 5,  276 => 393,  266 => 366,  263 => 365,  255 => 353,  245 => 335,  207 => 58,  194 => 66,  184 => 68,  76 => 27,  810 => 238,  804 => 260,  801 => 185,  799 => 234,  795 => 256,  792 => 255,  780 => 303,  777 => 253,  774 => 252,  771 => 232,  768 => 231,  766 => 249,  761 => 247,  749 => 218,  746 => 161,  743 => 217,  735 => 238,  732 => 213,  715 => 151,  698 => 234,  693 => 232,  688 => 202,  685 => 230,  682 => 201,  672 => 223,  670 => 222,  665 => 196,  648 => 219,  627 => 217,  622 => 216,  619 => 183,  616 => 182,  613 => 213,  610 => 181,  608 => 211,  605 => 210,  596 => 106,  592 => 203,  587 => 201,  585 => 209,  582 => 199,  578 => 178,  572 => 204,  566 => 203,  547 => 93,  545 => 198,  542 => 190,  533 => 186,  531 => 225,  507 => 165,  505 => 180,  502 => 179,  477 => 164,  471 => 129,  465 => 161,  454 => 121,  446 => 156,  443 => 155,  431 => 151,  428 => 116,  425 => 149,  422 => 148,  412 => 126,  406 => 111,  390 => 43,  383 => 132,  377 => 37,  375 => 127,  372 => 126,  370 => 101,  359 => 144,  356 => 126,  353 => 121,  349 => 119,  336 => 115,  332 => 88,  330 => 113,  318 => 86,  313 => 84,  291 => 80,  190 => 67,  321 => 152,  295 => 142,  274 => 53,  242 => 113,  236 => 42,  70 => 27,  170 => 79,  288 => 79,  284 => 76,  279 => 77,  275 => 103,  256 => 96,  250 => 44,  237 => 86,  232 => 82,  222 => 297,  191 => 26,  153 => 55,  150 => 56,  563 => 202,  560 => 172,  558 => 160,  553 => 194,  549 => 182,  543 => 174,  537 => 159,  532 => 192,  528 => 184,  525 => 157,  523 => 189,  518 => 180,  514 => 167,  511 => 166,  508 => 165,  501 => 163,  491 => 171,  487 => 156,  460 => 123,  455 => 115,  449 => 157,  442 => 62,  439 => 133,  436 => 132,  433 => 60,  426 => 58,  420 => 123,  415 => 127,  411 => 120,  405 => 108,  403 => 48,  380 => 130,  366 => 150,  354 => 142,  331 => 96,  325 => 94,  320 => 87,  317 => 121,  311 => 83,  308 => 13,  304 => 81,  272 => 134,  267 => 78,  249 => 89,  216 => 35,  155 => 73,  146 => 34,  126 => 179,  188 => 25,  181 => 232,  161 => 75,  110 => 172,  124 => 47,  692 => 399,  683 => 135,  678 => 133,  676 => 199,  666 => 126,  661 => 380,  656 => 378,  652 => 376,  645 => 369,  641 => 189,  635 => 226,  631 => 218,  625 => 361,  615 => 354,  607 => 218,  597 => 177,  590 => 202,  583 => 334,  579 => 332,  577 => 206,  575 => 328,  569 => 325,  565 => 324,  555 => 200,  548 => 176,  540 => 160,  536 => 194,  529 => 191,  524 => 90,  516 => 294,  510 => 293,  504 => 164,  500 => 172,  495 => 158,  490 => 154,  486 => 168,  482 => 136,  470 => 121,  464 => 125,  459 => 116,  452 => 158,  434 => 118,  421 => 90,  417 => 243,  400 => 47,  385 => 159,  361 => 207,  344 => 24,  339 => 116,  324 => 179,  310 => 83,  302 => 79,  296 => 151,  282 => 161,  259 => 149,  244 => 43,  231 => 133,  226 => 131,  215 => 280,  186 => 51,  152 => 61,  114 => 174,  104 => 40,  358 => 103,  351 => 141,  347 => 140,  343 => 92,  338 => 130,  327 => 112,  323 => 88,  319 => 124,  315 => 109,  301 => 80,  299 => 8,  293 => 90,  289 => 140,  281 => 75,  277 => 95,  271 => 374,  265 => 51,  262 => 105,  260 => 363,  257 => 103,  251 => 101,  248 => 336,  239 => 64,  228 => 41,  225 => 298,  213 => 69,  211 => 81,  197 => 30,  174 => 154,  148 => 49,  134 => 182,  127 => 32,  20 => 1,  270 => 157,  253 => 342,  233 => 82,  212 => 60,  210 => 59,  206 => 71,  202 => 266,  198 => 55,  192 => 53,  185 => 61,  180 => 49,  175 => 47,  172 => 51,  167 => 56,  165 => 77,  160 => 57,  137 => 46,  113 => 44,  100 => 81,  90 => 34,  81 => 32,  65 => 27,  129 => 180,  97 => 39,  77 => 30,  34 => 18,  53 => 22,  84 => 41,  58 => 22,  23 => 11,  480 => 75,  474 => 122,  469 => 158,  461 => 70,  457 => 153,  453 => 151,  444 => 263,  440 => 154,  437 => 61,  435 => 146,  430 => 255,  427 => 143,  423 => 57,  413 => 241,  409 => 141,  407 => 238,  402 => 107,  398 => 88,  393 => 168,  387 => 134,  384 => 106,  381 => 157,  379 => 154,  374 => 36,  368 => 34,  365 => 141,  362 => 148,  360 => 128,  355 => 27,  341 => 131,  337 => 90,  322 => 93,  314 => 88,  312 => 149,  309 => 82,  305 => 115,  298 => 91,  294 => 100,  285 => 78,  283 => 138,  278 => 408,  268 => 373,  264 => 74,  258 => 72,  252 => 68,  247 => 78,  241 => 87,  229 => 73,  220 => 290,  214 => 75,  177 => 43,  169 => 44,  140 => 51,  132 => 42,  128 => 47,  107 => 38,  61 => 23,  273 => 392,  269 => 91,  254 => 46,  243 => 66,  240 => 326,  238 => 84,  235 => 63,  230 => 62,  227 => 80,  224 => 61,  221 => 38,  219 => 76,  217 => 56,  208 => 124,  204 => 57,  179 => 44,  159 => 196,  143 => 33,  135 => 35,  119 => 117,  102 => 37,  71 => 30,  67 => 29,  63 => 28,  59 => 27,  28 => 14,  94 => 16,  89 => 17,  85 => 32,  75 => 29,  68 => 10,  56 => 23,  87 => 36,  201 => 56,  196 => 52,  183 => 50,  171 => 153,  166 => 209,  163 => 58,  158 => 74,  156 => 38,  151 => 54,  142 => 54,  138 => 57,  136 => 70,  121 => 24,  117 => 175,  105 => 170,  91 => 37,  62 => 24,  49 => 21,  25 => 12,  21 => 12,  31 => 16,  38 => 18,  26 => 14,  24 => 3,  19 => 11,  93 => 35,  88 => 33,  78 => 34,  46 => 19,  44 => 18,  27 => 14,  79 => 28,  72 => 28,  69 => 27,  47 => 18,  40 => 17,  37 => 20,  22 => 12,  246 => 67,  157 => 56,  145 => 54,  139 => 59,  131 => 181,  123 => 65,  120 => 46,  115 => 45,  111 => 39,  108 => 171,  101 => 37,  98 => 36,  96 => 18,  83 => 15,  74 => 29,  66 => 23,  55 => 21,  52 => 22,  50 => 21,  43 => 18,  41 => 20,  35 => 16,  32 => 5,  29 => 15,  209 => 96,  203 => 32,  199 => 265,  193 => 51,  189 => 52,  187 => 69,  182 => 23,  176 => 309,  173 => 46,  168 => 69,  164 => 55,  162 => 68,  154 => 36,  149 => 35,  147 => 52,  144 => 26,  141 => 72,  133 => 49,  130 => 57,  125 => 46,  122 => 45,  116 => 45,  112 => 52,  109 => 43,  106 => 64,  103 => 82,  99 => 23,  95 => 35,  92 => 59,  86 => 36,  82 => 36,  80 => 31,  73 => 29,  64 => 24,  60 => 26,  57 => 26,  54 => 23,  51 => 16,  48 => 21,  45 => 13,  42 => 15,  39 => 17,  36 => 16,  33 => 17,  30 => 15,);
    }
}
