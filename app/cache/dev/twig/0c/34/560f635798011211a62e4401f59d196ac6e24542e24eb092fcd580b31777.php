<?php

/* WebProfilerBundle:Profiler:profiler.css.twig */
class __TwigTemplate_0c34560f635798011211a62e4401f59d196ac6e24542e24eb092fcd580b31777 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "/*
Copyright (c) 2008, Yahoo! Inc. All rights reserved.
Code licensed under the BSD License:
http://developer.yahoo.net/yui/license.txt
version: 2.6.0
*/
html{color:#000;background:#FFF;}body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,code,form,fieldset,legend,input,button,textarea,p,blockquote,th,td{margin:0;padding:0;}table{border-collapse:collapse;border-spacing:0;}fieldset,img{border:0;}address,caption,cite,code,dfn,em,strong,th,var,optgroup{font-style:inherit;font-weight:inherit;}del,ins{text-decoration:none;}li{list-style:none;}caption,th{text-align:left;}h1,h2,h3,h4,h5,h6{font-size:100%;font-weight:normal;}q:before,q:after{content:'';}abbr,acronym{border:0;font-variant:normal;}sup{vertical-align:baseline;}sub{vertical-align:baseline;}legend{color:#000;}input,button,textarea,select,optgroup,option{font-family:inherit;font-size:inherit;font-style:inherit;font-weight:inherit;}input,button,textarea,select{*font-size:100%;}
html, body {
    background-color: #efefef;
}
body {
    font: 1em \"Lucida Sans Unicode\", \"Lucida Grande\", Verdana, Arial, Helvetica, sans-serif;
    text-align: left;
}
p {
    font-size: 14px;
    line-height: 20px;
    color: #313131;
    padding-bottom: 20px
}
strong {
    color: #313131;
    font-weight: bold;
}
em {
    font-style: italic;
}
a {
    color: #6c6159;
}
a img {
    border: none;
}
a:hover {
    text-decoration: underline;
}
button::-moz-focus-inner {
    padding: 0;
    border: none;
}
button {
    overflow: visible;
    width: auto;
    background-color: transparent;
    font-weight: bold;
}
caption {
    margin-bottom: 7px;
}
table, tr, th, td {
    border-collapse: collapse;
    border: 1px solid #d0dbb3;
}
table {
    width: 100%;
    margin: 10px 0 30px;
}
table th {
    font-weight: bold;
    background-color: #f1f7e2;
}
table th, table td {
    font-size: 12px;
    padding: 8px 10px;
}
table td em {
    color: #aaa;
}
fieldset {
    border: none;
}
abbr {
    border-bottom: 1px dotted #000;
    cursor: help;
}
pre, code {
    font-size: 0.9em;
}
.clear {
    clear: both;
    height: 0;
    font-size: 0;
    line-height: 0;
}
.clear-fix:after
{
    content: \"\\0020\";
    display: block;
    height: 0;
    clear: both;
    visibility: hidden;
}
* html .clear-fix
{
    height: 1%;
}
.clear-fix
{
    display: block;
}
#content {
    padding: 0 50px;
    margin: 0 auto 20px;
    font-family: Arial, Helvetica, sans-serif;
    min-width: 970px;
}
#header {
    padding: 20px 30px 20px;
}
#header h1 {
    float: left;
}
.search {
    float: right;
}
#menu-profiler {
    border-right: 1px solid #dfdfdf;
}
#menu-profiler li {
    border-bottom: 1px solid #dfdfdf;
    position: relative;
    padding-bottom: 0;
    display: block;
    background-color: #f6f6f6;
    z-index: 10000;
}
#menu-profiler li a {
    color: #404040;
    display: block;
    font-size: 13px;
    text-transform: uppercase;
    text-decoration: none;
    cursor: pointer;
}
#menu-profiler li a span.label {
    display: block;
    padding: 20px 0px 16px 65px;
    min-height: 16px;
    overflow: hidden;
}
#menu-profiler li a span.icon {
    display: block;
    position: absolute;
    left: 0;
    top: 12px;
    width: 60px;
    text-align: center;
}
#menu-profiler li.selected a,
#menu-profiler li a:hover {
    background: #d1d1d1 url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAA7CAAAAACfn7+eAAAACXZwQWcAAAABAAAAOwDiPIGUAAAAJElEQVQIW2N4y8TA9B+KGZDYEP5/FD4Eo7IgNLJqZDUIMRRTAcmVHUZf/1g/AAAAAElFTkSuQmCC) repeat-x 0 0;
}
#navigation div:first-child,
#menu-profiler li:first-child,
#menu-profiler li:first-child a,
#menu-profiler li:first-child a span.label {
    border-radius: 16px 0 0 0;
}
#menu-profiler li a span.count {
    padding: 0;
    position: absolute;
    right: 10px;
    top: 20px;
}
#collector-wrapper {
    float: left;
    width: 100%;
}
#collector-content {
    margin-left: 250px;
    padding: 30px 40px 40px;
}
#collector-content pre {
    white-space: pre-wrap;
    word-break: break-all;
}
#navigation {
    float: left;
    width: 250px;
    margin-left: -100%;
}
#collector-content table td {
    background-color: white;
}
h1 {
    font-family: Georgia, \"Times New Roman\", Times, serif;
    color: #404040;
}
h2, h3 {
    font-weight: bold;
    margin-bottom: 20px;
}
li {
    padding-bottom: 10px;
}
#main {
    border-radius: 16px;
    margin-bottom: 20px;
}
#menu-profiler span.count span {
    display: inline-block;
    background-color: #aacd4e;
    border-radius: 6px;
    padding: 4px;
    color: #fff;
    margin-right: 2px;
    font-size: 11px;
}
#resume {
    background-color: #f6f6f6;
    border-bottom: 1px solid #dfdfdf;
    padding: 18px 10px 0px;
    margin-left: 250px;
    height: 34px;
    color: #313131;
    font-size: 12px;
    border-top-right-radius: 16px;
}
a#resume-view-all {
    display: inline-block;
    padding: 0.2em 0.7em;
    margin-right: 0.5em;
    background-color: #666;
    border-radius: 16px;
    color: white;
    font-weight: bold;
    text-decoration: none;
}
table th.value {
    width: 450px;
    background-color: #dfeeb8;
}
#content h2 {
    font-size: 24px;
    color: #313131;
    font-weight: bold;
}
#content #main {
    padding: 0;
    background-color: #FFF;
    border: 1px solid #dfdfdf;
}
#content #main p {
    color: #313131;
    font-size: 14px;
    padding-bottom: 20px;
}
.sf-toolbarreset {
    border-top: 0;
    padding: 0;
}
.sf-reset .block-exception-detected .text-exception {
    left: 10px;
    right: 10px;
    width: 95%;
}
.sf-reset .block-exception-detected .illustration-exception {
    display: none;
}
ul.alt {
    margin: 10px 0 30px;
}
ul.alt li {
    padding: 5px 7px;
    font-size: 13px;
}
ul.alt li.even {
    background: #f1f7e2;
}
ul.alt li.error {
    background-color: #f66;
    margin-bottom: 1px;
}
ul.alt li.warning {
    background-color: #ffcc00;
    margin-bottom: 1px;
}
ul.alt li.scream, ul.alt li.scream strong {
    color: gray;
}
ul.sf-call-stack li {
    text-size: small;
    padding: 0 0 0 20px;
}
td.main, td.menu {
    text-align: left;
    margin: 0;
    padding: 0;
    border: 0;
    vertical-align: top;
}
.search {
    float: right;
    padding-top: 20px;
}
.search label {
    line-height: 28px;
    vertical-align: middle;
}
.search input {
    width: 195px;
    font-size: 12px;
    border: 1px solid #dadada;
    background: #FFF url(data:image/gif;base64,R0lGODlhAQAFAKIAAPX19e/v7/39/fr6+urq6gAAAAAAAAAAACH5BAAAAAAALAAAAAABAAUAAAMESAEjCQA7) repeat-x left top;
    padding: 5px 6px;
    color: #565656;
}
.search input[type=\"search\"] {
    -webkit-appearance: textfield;
}
#navigation div:first-child {
    margin: 0 0 20px;
    border-top: 0;
}
#navigation .search {
    padding-top: 15px;
    float: none;
    background: none repeat scroll 0 0 #f6f6f6;
    color: #333;
    margin: 20px 0;
    border: 1px solid #dfdfdf;
    border-left: none;
}
#navigation .search h3 {
    font-family: Arial, Helvetica, sans-serif;
    text-transform: uppercase;
    margin-left: 10px;
    font-size: 13px;
}
#navigation .search form {
    padding: 15px 0;
}
#navigation .search button {
    float: right;
    margin-right: 20px;
}
#navigation .search label {
    display: block;
    float: left;
    width: 50px;
}
#navigation .search input,
#navigation .search select,
#navigation .search label,
#navigation .search a {
    font-size: 12px;
}
#navigation .search form {
    padding-left: 10px;
}
#navigation .search input {
    width: 160px;
}
#navigation .import label {
    float: none;
    display: inline;
}
#navigation .import input {
    width: 100px;
}
.timeline {
    background-color: #fbfbfb;
    margin-bottom: 15px;
    margin-top: 5px;
}
#collector-content .routing tr.matches td {
    background-color: #0e0;
}
#collector-content .routing tr.almost td {
    background-color: #fa0;
}
.loading {
    background: transparent url(data:image/gif;base64,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) scroll no-repeat 50% 50%;
    height: 30px;
    display: none;
}
.sf-profiler-timeline .legends {
    font-size: 12px;
    line-height: 1.5em;
}
.sf-profiler-timeline .legends span {
    border-left-width: 10px;
    border-left-style: solid;
    padding: 0 10px 0 5px;
}
.sf-profiler-timeline canvas {
    border: 1px solid #999;
    border-width: 1px 0;
}
.collapsed-menu-parents #resume,
.collapsed-menu-parents #collector-content {
    margin-left: 60px !important;
}
.collapsed-menu {
    width: 60px !important;
}
.collapsed-menu span :not(.icon) {
    display: none !important;
}
.collapsed-menu span.icon img {
    display: inline !important;
}
";
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Profiler:profiler.css.twig";
    }

    public function getDebugInfo()
    {
        return array (  1073 => 656,  1055 => 648,  1044 => 645,  1026 => 633,  1021 => 631,  997 => 622,  993 => 621,  984 => 615,  975 => 609,  963 => 604,  959 => 602,  941 => 595,  937 => 593,  935 => 592,  919 => 587,  905 => 579,  884 => 568,  864 => 558,  815 => 531,  800 => 523,  790 => 519,  745 => 493,  727 => 476,  686 => 472,  2118 => 1610,  2115 => 1609,  2110 => 1604,  2107 => 1603,  1982 => 1480,  1978 => 1478,  1967 => 1476,  1963 => 1475,  1959 => 1473,  1957 => 1472,  1834 => 1351,  1831 => 1350,  1820 => 1347,  1817 => 1346,  1812 => 1345,  1810 => 1344,  1785 => 1322,  1782 => 1321,  1779 => 1320,  1774 => 1317,  1771 => 1316,  1763 => 1291,  1760 => 1290,  1755 => 1617,  1751 => 1615,  1749 => 1609,  1744 => 1607,  1741 => 1606,  1739 => 1603,  1736 => 1602,  1734 => 1320,  1731 => 1319,  1729 => 1316,  1726 => 1315,  1717 => 1311,  1715 => 1310,  1701 => 1299,  1697 => 1298,  1693 => 1297,  1690 => 1296,  1688 => 1290,  1685 => 1289,  1681 => 1288,  1674 => 1286,  1671 => 1285,  1667 => 1284,  1657 => 1279,  1654 => 1278,  1651 => 1277,  1648 => 1276,  1643 => 1272,  1630 => 1262,  1597 => 1240,  1592 => 1237,  1580 => 1229,  1508 => 1159,  1497 => 1157,  1493 => 1156,  1470 => 1136,  1208 => 877,  1191 => 863,  1156 => 830,  1140 => 816,  1107 => 786,  1091 => 772,  1089 => 771,  684 => 459,  651 => 444,  1229 => 998,  1226 => 997,  1216 => 993,  1214 => 992,  1210 => 990,  1201 => 987,  1197 => 985,  1176 => 974,  1135 => 936,  1068 => 872,  1062 => 833,  1059 => 832,  1043 => 980,  1038 => 978,  1035 => 639,  1028 => 832,  1011 => 823,  1006 => 821,  988 => 816,  985 => 815,  971 => 809,  965 => 807,  938 => 789,  930 => 590,  886 => 757,  1119 => 855,  1116 => 854,  1075 => 869,  1054 => 829,  1050 => 861,  1034 => 856,  1031 => 854,  1025 => 831,  1023 => 632,  1020 => 827,  1017 => 849,  1000 => 623,  987 => 840,  972 => 608,  945 => 816,  943 => 792,  794 => 670,  770 => 507,  759 => 657,  723 => 628,  854 => 552,  850 => 584,  838 => 544,  826 => 569,  755 => 541,  750 => 539,  741 => 533,  704 => 517,  736 => 544,  706 => 473,  702 => 479,  1720 => 1312,  1668 => 1510,  1659 => 1504,  1655 => 1503,  1649 => 1502,  1641 => 1497,  1637 => 1496,  1620 => 1484,  1613 => 1247,  1609 => 1479,  1594 => 1472,  1590 => 1236,  1571 => 1457,  1564 => 1453,  1560 => 1452,  1545 => 1445,  1525 => 1430,  1407 => 1319,  1387 => 1309,  1359 => 1288,  990 => 841,  1673 => 1259,  1670 => 1258,  1663 => 1282,  1635 => 1290,  1632 => 1289,  1629 => 1288,  1622 => 1283,  1617 => 1281,  1614 => 1280,  1611 => 1279,  1606 => 1277,  1601 => 1476,  1598 => 1274,  1595 => 1273,  1588 => 1268,  1586 => 1267,  1582 => 1230,  1572 => 1262,  1566 => 1260,  1563 => 1258,  1557 => 1256,  1555 => 1255,  1552 => 1449,  1549 => 1253,  1541 => 1444,  1532 => 1247,  1527 => 1246,  1522 => 1429,  1519 => 1244,  1514 => 1243,  1511 => 1242,  1504 => 1237,  1492 => 1230,  1487 => 1227,  1485 => 1226,  1477 => 1220,  1475 => 1219,  1333 => 1084,  1320 => 1073,  1313 => 1070,  1306 => 1067,  1304 => 1066,  1301 => 1065,  1296 => 1063,  1280 => 1058,  1277 => 1057,  1274 => 1056,  1266 => 1053,  1217 => 1011,  1186 => 989,  874 => 562,  803 => 630,  606 => 449,  691 => 492,  655 => 457,  484 => 412,  552 => 472,  709 => 520,  397 => 337,  392 => 198,  1577 => 1107,  1574 => 1106,  1569 => 1261,  1567 => 1106,  1460 => 1001,  1454 => 997,  1444 => 993,  1437 => 989,  1433 => 988,  1429 => 987,  1425 => 986,  1421 => 985,  1415 => 982,  1409 => 978,  1405 => 977,  1391 => 965,  1389 => 964,  1367 => 946,  1356 => 944,  1352 => 943,  1347 => 941,  1321 => 923,  1318 => 922,  1316 => 1071,  1289 => 1061,  1286 => 1060,  1281 => 893,  1270 => 886,  1261 => 883,  1255 => 882,  1244 => 880,  1234 => 879,  1227 => 878,  1222 => 877,  1220 => 995,  1207 => 989,  1199 => 859,  1188 => 857,  1184 => 980,  1163 => 839,  1160 => 838,  1152 => 835,  1136 => 823,  1133 => 822,  1130 => 821,  1127 => 820,  1125 => 819,  1081 => 777,  1078 => 776,  1060 => 866,  1052 => 764,  1045 => 1000,  1042 => 761,  1037 => 857,  992 => 817,  962 => 697,  960 => 826,  944 => 686,  893 => 572,  847 => 603,  829 => 591,  664 => 463,  623 => 234,  494 => 219,  462 => 202,  445 => 339,  419 => 204,  639 => 468,  611 => 386,  538 => 444,  646 => 451,  642 => 449,  544 => 434,  541 => 204,  517 => 404,  797 => 671,  752 => 533,  748 => 458,  681 => 553,  677 => 465,  630 => 437,  618 => 172,  535 => 397,  519 => 425,  416 => 215,  1082 => 552,  1076 => 775,  1072 => 548,  1069 => 654,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 974,  1030 => 973,  1018 => 630,  1015 => 527,  1013 => 627,  1010 => 525,  1007 => 524,  1002 => 820,  999 => 518,  995 => 818,  983 => 509,  977 => 507,  974 => 810,  968 => 808,  954 => 800,  948 => 494,  922 => 779,  916 => 480,  913 => 479,  911 => 581,  906 => 476,  896 => 573,  885 => 463,  882 => 462,  872 => 696,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 605,  842 => 443,  836 => 543,  824 => 537,  781 => 552,  775 => 485,  762 => 504,  742 => 492,  737 => 490,  726 => 390,  722 => 389,  718 => 482,  708 => 381,  703 => 499,  674 => 248,  659 => 196,  636 => 446,  604 => 329,  581 => 387,  568 => 261,  539 => 406,  534 => 418,  530 => 417,  521 => 389,  489 => 179,  483 => 376,  394 => 168,  396 => 306,  345 => 147,  476 => 373,  386 => 159,  364 => 235,  234 => 90,  595 => 326,  589 => 450,  586 => 451,  562 => 505,  556 => 474,  506 => 221,  498 => 417,  492 => 380,  473 => 277,  458 => 121,  399 => 199,  352 => 268,  346 => 187,  328 => 139,  880 => 566,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 487,  758 => 405,  667 => 489,  573 => 516,  567 => 414,  520 => 394,  481 => 375,  475 => 409,  472 => 408,  466 => 227,  441 => 196,  438 => 337,  432 => 380,  429 => 188,  395 => 400,  382 => 131,  378 => 157,  367 => 155,  357 => 168,  348 => 140,  334 => 141,  286 => 112,  205 => 90,  297 => 200,  218 => 144,  940 => 351,  932 => 786,  926 => 589,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 571,  888 => 570,  883 => 700,  875 => 286,  869 => 313,  866 => 312,  843 => 579,  839 => 306,  813 => 264,  811 => 429,  808 => 494,  787 => 667,  784 => 293,  782 => 665,  779 => 291,  776 => 290,  763 => 245,  754 => 499,  747 => 260,  744 => 534,  740 => 491,  734 => 530,  731 => 392,  728 => 528,  725 => 251,  719 => 257,  716 => 438,  714 => 522,  711 => 540,  705 => 480,  701 => 261,  690 => 469,  687 => 460,  671 => 465,  669 => 219,  653 => 239,  634 => 456,  628 => 444,  621 => 470,  609 => 419,  602 => 230,  591 => 436,  571 => 419,  499 => 382,  488 => 273,  389 => 160,  223 => 104,  14 => 4,  306 => 227,  303 => 122,  300 => 121,  292 => 145,  280 => 194,  12 => 36,  624 => 282,  620 => 451,  612 => 467,  601 => 446,  599 => 412,  580 => 265,  574 => 431,  559 => 427,  526 => 429,  497 => 173,  485 => 304,  463 => 196,  447 => 340,  404 => 310,  401 => 172,  391 => 133,  369 => 172,  333 => 115,  329 => 131,  307 => 128,  287 => 236,  195 => 87,  178 => 64,  956 => 271,  953 => 822,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 610,  914 => 775,  912 => 336,  909 => 580,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 560,  868 => 273,  863 => 587,  853 => 261,  848 => 548,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 496,  807 => 528,  805 => 426,  802 => 569,  791 => 420,  788 => 518,  778 => 267,  773 => 662,  765 => 246,  760 => 621,  757 => 221,  738 => 214,  720 => 439,  717 => 210,  713 => 256,  700 => 205,  679 => 466,  673 => 487,  668 => 464,  663 => 484,  660 => 464,  657 => 446,  650 => 483,  647 => 237,  644 => 190,  632 => 438,  629 => 454,  626 => 443,  603 => 439,  600 => 178,  594 => 454,  588 => 372,  584 => 488,  570 => 149,  561 => 259,  554 => 500,  551 => 424,  546 => 423,  522 => 406,  513 => 386,  479 => 388,  468 => 353,  451 => 287,  448 => 389,  424 => 334,  418 => 344,  410 => 202,  376 => 191,  373 => 156,  340 => 145,  326 => 138,  261 => 146,  118 => 49,  200 => 72,  1402 => 1317,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 948,  1368 => 409,  1355 => 403,  1349 => 942,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 925,  1324 => 924,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 1062,  1287 => 379,  1283 => 1059,  1279 => 377,  1273 => 887,  1271 => 1055,  1268 => 1054,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 984,  1192 => 983,  1190 => 982,  1187 => 981,  1179 => 975,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 837,  1154 => 836,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 899,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 871,  1077 => 657,  1074 => 304,  1067 => 299,  1064 => 651,  1056 => 864,  1053 => 292,  1051 => 647,  1048 => 646,  1040 => 858,  1036 => 534,  1032 => 757,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 824,  1012 => 271,  1009 => 822,  1004 => 624,  982 => 839,  979 => 812,  976 => 811,  973 => 662,  970 => 607,  967 => 606,  964 => 502,  961 => 254,  958 => 802,  955 => 600,  952 => 691,  950 => 269,  947 => 597,  939 => 243,  936 => 788,  934 => 241,  931 => 295,  923 => 588,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 766,  897 => 329,  894 => 762,  892 => 703,  889 => 702,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 615,  862 => 557,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 546,  841 => 537,  833 => 439,  830 => 539,  828 => 538,  825 => 681,  817 => 567,  814 => 191,  812 => 530,  809 => 189,  798 => 255,  796 => 521,  793 => 556,  785 => 666,  783 => 177,  772 => 172,  769 => 171,  767 => 660,  764 => 505,  756 => 460,  753 => 540,  751 => 401,  739 => 156,  729 => 233,  724 => 484,  721 => 525,  712 => 521,  710 => 475,  707 => 501,  699 => 142,  697 => 513,  696 => 476,  695 => 466,  694 => 470,  689 => 137,  680 => 457,  675 => 199,  662 => 217,  658 => 500,  654 => 484,  649 => 462,  643 => 306,  640 => 448,  638 => 440,  617 => 112,  614 => 367,  598 => 107,  593 => 270,  576 => 517,  564 => 260,  557 => 434,  550 => 465,  527 => 416,  515 => 191,  512 => 224,  509 => 385,  503 => 427,  496 => 423,  493 => 415,  478 => 374,  467 => 370,  456 => 288,  450 => 212,  414 => 203,  408 => 176,  388 => 292,  371 => 156,  363 => 153,  350 => 120,  342 => 137,  335 => 134,  316 => 232,  290 => 119,  276 => 193,  266 => 204,  263 => 146,  255 => 101,  245 => 116,  207 => 75,  194 => 70,  184 => 63,  76 => 31,  810 => 529,  804 => 662,  801 => 560,  799 => 234,  795 => 256,  792 => 488,  780 => 513,  777 => 663,  774 => 509,  771 => 412,  768 => 547,  766 => 546,  761 => 658,  749 => 479,  746 => 478,  743 => 240,  735 => 238,  732 => 487,  715 => 507,  698 => 477,  693 => 248,  688 => 372,  685 => 509,  682 => 470,  672 => 247,  670 => 486,  665 => 362,  648 => 443,  627 => 236,  622 => 442,  619 => 212,  616 => 440,  613 => 275,  610 => 332,  608 => 231,  605 => 230,  596 => 106,  592 => 373,  587 => 434,  585 => 331,  582 => 399,  578 => 432,  572 => 204,  566 => 393,  547 => 435,  545 => 463,  542 => 421,  533 => 237,  531 => 154,  507 => 241,  505 => 214,  502 => 220,  477 => 232,  471 => 164,  465 => 214,  454 => 269,  446 => 197,  443 => 210,  431 => 189,  428 => 189,  425 => 188,  422 => 184,  412 => 152,  406 => 201,  390 => 304,  383 => 193,  377 => 129,  375 => 249,  372 => 200,  370 => 208,  359 => 123,  356 => 122,  353 => 149,  349 => 188,  336 => 272,  332 => 267,  330 => 233,  318 => 233,  313 => 110,  291 => 218,  190 => 90,  321 => 135,  295 => 146,  274 => 110,  242 => 113,  236 => 114,  70 => 19,  170 => 84,  288 => 118,  284 => 56,  279 => 134,  275 => 105,  256 => 96,  250 => 2,  237 => 91,  232 => 88,  222 => 83,  191 => 69,  153 => 56,  150 => 55,  563 => 429,  560 => 435,  558 => 195,  553 => 425,  549 => 411,  543 => 425,  537 => 458,  532 => 410,  528 => 199,  525 => 311,  523 => 441,  518 => 388,  514 => 415,  511 => 243,  508 => 424,  501 => 422,  491 => 288,  487 => 411,  460 => 195,  455 => 344,  449 => 198,  442 => 190,  439 => 195,  436 => 336,  433 => 345,  426 => 180,  420 => 220,  415 => 180,  411 => 313,  405 => 269,  403 => 136,  380 => 160,  366 => 171,  354 => 190,  331 => 140,  325 => 129,  320 => 127,  317 => 178,  311 => 152,  308 => 109,  304 => 207,  272 => 183,  267 => 101,  249 => 181,  216 => 79,  155 => 47,  146 => 54,  126 => 62,  188 => 76,  181 => 65,  161 => 58,  110 => 105,  124 => 45,  692 => 474,  683 => 282,  678 => 468,  676 => 467,  666 => 448,  661 => 488,  656 => 499,  652 => 497,  645 => 442,  641 => 441,  635 => 489,  631 => 475,  625 => 453,  615 => 453,  607 => 363,  597 => 455,  590 => 223,  583 => 435,  579 => 353,  577 => 398,  575 => 212,  569 => 394,  565 => 430,  555 => 257,  548 => 353,  540 => 459,  536 => 419,  529 => 409,  524 => 344,  516 => 387,  510 => 78,  504 => 145,  500 => 386,  495 => 381,  490 => 218,  486 => 377,  482 => 217,  470 => 216,  464 => 242,  459 => 346,  452 => 286,  434 => 279,  421 => 341,  417 => 219,  400 => 267,  385 => 203,  361 => 146,  344 => 238,  339 => 269,  324 => 112,  310 => 165,  302 => 125,  296 => 121,  282 => 178,  259 => 103,  244 => 204,  231 => 107,  226 => 84,  215 => 129,  186 => 72,  152 => 46,  114 => 36,  104 => 42,  358 => 151,  351 => 141,  347 => 119,  343 => 146,  338 => 135,  327 => 265,  323 => 128,  319 => 220,  315 => 125,  301 => 235,  299 => 170,  293 => 198,  289 => 113,  281 => 114,  277 => 140,  271 => 190,  265 => 105,  262 => 98,  260 => 211,  257 => 145,  251 => 182,  248 => 94,  239 => 112,  228 => 107,  225 => 106,  213 => 78,  211 => 140,  197 => 71,  174 => 74,  148 => 56,  134 => 47,  127 => 35,  20 => 1,  270 => 102,  253 => 100,  233 => 87,  212 => 106,  210 => 77,  206 => 152,  202 => 94,  198 => 140,  192 => 87,  185 => 66,  180 => 70,  175 => 58,  172 => 62,  167 => 71,  165 => 60,  160 => 58,  137 => 66,  113 => 38,  100 => 51,  90 => 27,  81 => 23,  65 => 36,  129 => 47,  97 => 39,  77 => 20,  34 => 5,  53 => 12,  84 => 24,  58 => 25,  23 => 4,  480 => 175,  474 => 231,  469 => 228,  461 => 122,  457 => 213,  453 => 199,  444 => 185,  440 => 275,  437 => 209,  435 => 231,  430 => 344,  427 => 206,  423 => 256,  413 => 141,  409 => 219,  407 => 138,  402 => 199,  398 => 184,  393 => 265,  387 => 164,  384 => 302,  381 => 236,  379 => 110,  374 => 128,  368 => 126,  365 => 125,  362 => 124,  360 => 169,  355 => 143,  341 => 117,  337 => 183,  322 => 179,  314 => 153,  312 => 124,  309 => 129,  305 => 108,  298 => 120,  294 => 238,  285 => 100,  283 => 115,  278 => 106,  268 => 173,  264 => 188,  258 => 187,  252 => 166,  247 => 1,  241 => 90,  229 => 85,  220 => 81,  214 => 147,  177 => 69,  169 => 77,  140 => 21,  132 => 48,  128 => 42,  107 => 69,  61 => 17,  273 => 185,  269 => 107,  254 => 199,  243 => 140,  240 => 111,  238 => 192,  235 => 89,  230 => 111,  227 => 86,  224 => 151,  221 => 80,  219 => 174,  217 => 118,  208 => 76,  204 => 78,  179 => 80,  159 => 57,  143 => 120,  135 => 46,  119 => 40,  102 => 33,  71 => 15,  67 => 18,  63 => 18,  59 => 14,  28 => 3,  94 => 21,  89 => 46,  85 => 23,  75 => 18,  68 => 30,  56 => 33,  87 => 34,  201 => 74,  196 => 92,  183 => 71,  171 => 73,  166 => 54,  163 => 82,  158 => 80,  156 => 58,  151 => 55,  142 => 52,  138 => 56,  136 => 71,  121 => 50,  117 => 37,  105 => 34,  91 => 33,  62 => 12,  49 => 14,  25 => 69,  21 => 3,  31 => 8,  38 => 6,  26 => 2,  24 => 13,  19 => 1,  93 => 27,  88 => 32,  78 => 19,  46 => 12,  44 => 10,  27 => 7,  79 => 21,  72 => 17,  69 => 16,  47 => 11,  40 => 12,  37 => 7,  22 => 68,  246 => 93,  157 => 71,  145 => 74,  139 => 118,  131 => 115,  123 => 42,  120 => 31,  115 => 108,  111 => 47,  108 => 33,  101 => 30,  98 => 45,  96 => 30,  83 => 33,  74 => 23,  66 => 13,  55 => 15,  52 => 12,  50 => 22,  43 => 9,  41 => 8,  35 => 9,  32 => 5,  29 => 7,  209 => 145,  203 => 73,  199 => 93,  193 => 130,  189 => 66,  187 => 149,  182 => 87,  176 => 63,  173 => 85,  168 => 61,  164 => 70,  162 => 59,  154 => 124,  149 => 69,  147 => 54,  144 => 42,  141 => 51,  133 => 45,  130 => 46,  125 => 51,  122 => 61,  116 => 39,  112 => 40,  109 => 52,  106 => 51,  103 => 51,  99 => 31,  95 => 27,  92 => 43,  86 => 95,  82 => 28,  80 => 32,  73 => 20,  64 => 17,  60 => 35,  57 => 34,  54 => 33,  51 => 13,  48 => 16,  45 => 10,  42 => 13,  39 => 10,  36 => 10,  33 => 9,  30 => 3,);
    }
}
