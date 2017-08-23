<?php

/* MinsalSiapsBundle::acercaDe.html.twig */
class __TwigTemplate_35af67ca979190a5ea8a2ed4edc92f751a57d259ddb7ac0c18afbddc01a9ccff extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'about_content' => array($this, 'block_about_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('about_content', $context, $blocks);
    }

    public function block_about_content($context, array $blocks = array())
    {
        // line 2
        echo "    ";
        $context["descripcionModulo"] = "";
        // line 3
        echo "    ";
        $context["modulo"] = $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_moduleSelection"), "method");
        // line 4
        echo "    ";
        if (((isset($context["modulo"]) ? $context["modulo"] : $this->getContext($context, "modulo")) == 1)) {
            // line 5
            echo "            ";
            $context["nombreModulo"] = "Identificación del Paciente";
            // line 6
            echo "            ";
            $context["descripcionModulo"] = "Este módulo permite consultar información de pacientes registrados en el sistema y así como realizar el registro de nuevos pacientes; busca facilitar la administración
del la información de los pacientes. También proporciona la interfaz para la administración de los
usuarios que tienen acceso al manejo de este módulo.";
            // line 9
            echo "    ";
        } elseif (((isset($context["modulo"]) ? $context["modulo"] : $this->getContext($context, "modulo")) == 2)) {
            // line 10
            echo "            ";
            $context["nombreModulo"] = "Citas";
            // line 11
            echo "            ";
            $context["descripcionModulo"] = "Este módulo permite llevar la gestión en cuanto al manejo de las citas a los pacientes que están registrados dentro del sistema.
            Se lleva el manejo de la agenda médica según especialidad y médico, administrado horarios en los cuales los médicos brindan atención.
            Además se administra la configuración tanto de los días hábiles como los no hábiles, permitiendo así que la asignación de citas pueda darse
            en fecha con disponibilidad tanto de tiempo como de recursos.";
            // line 15
            echo "        ";
        } elseif (((isset($context["modulo"]) ? $context["modulo"] : $this->getContext($context, "modulo")) == 6)) {
            // line 16
            echo "            ";
            $context["nombreModulo"] = "Agenda Médica";
            // line 17
            echo "            ";
            $context["descripcionModulo"] = "Este módulo permite gestionar según su disponibilidad y especialidad la asignación de citas a los pacientes. La gestión del modulo de “Agenda Médica” incluye tanto la asignación de citas, la eliminación de citas
        y la consulta de la cantidad de citas que tienen programadas en una vista tipo calendario.";
            // line 19
            echo "    ";
        } elseif (((isset($context["modulo"]) ? $context["modulo"] : $this->getContext($context, "modulo")) == 4)) {
            // line 20
            echo "        ";
            $context["nombreModulo"] = "Laboratorio";
            // line 21
            echo "        ";
            $context["descripcionModulo"] = "Este módulo permite consultar todo lo relacionado con las CITAS";
            // line 22
            echo "    ";
        } elseif (((isset($context["modulo"]) ? $context["modulo"] : $this->getContext($context, "modulo")) == 5)) {
            // line 23
            echo "        ";
            $context["nombreModulo"] = "Farmacia";
            // line 24
            echo "        ";
            $context["descripcionModulo"] = "Este módulo permite consultar todo lo relacionado con las CITAS";
            // line 25
            echo "    ";
        } elseif (((isset($context["modulo"]) ? $context["modulo"] : $this->getContext($context, "modulo")) == 3)) {
            // line 26
            echo "        ";
            $context["nombreModulo"] = "Seguimiento Clinico";
            // line 27
            echo "        ";
            $context["descripcionModulo"] = "Este módulo permite gestionar las historias clínicas según la especialidad del médico y el tipo de paciente. Permite generar una nueva
historia clínica, ver historias anteriores, ver y generar solicitudes para exámenes de laboratorio, ver y generar recetas.";
            // line 29
            echo "        ";
        } elseif (((isset($context["modulo"]) ? $context["modulo"] : $this->getContext($context, "modulo")) == 7)) {
            // line 30
            echo "            ";
            $context["nombreModulo"] = "Clínica de Selección";
            // line 31
            echo "            ";
            $context["descripcionModulo"] = "Este módulo permite gestionar el cupo de un determinado paciente a una especialidad según prioridades";
            // line 32
            echo "            ";
        } elseif (((isset($context["modulo"]) ? $context["modulo"] : $this->getContext($context, "modulo")) == 8)) {
            // line 33
            echo "        ";
            $context["nombreModulo"] = "Imagenología Digital";
            // line 34
            echo "        ";
            $context["descripcionModulo"] = "Este módulo permite gestionar el cupo de un determinado paciente a una especialidad según prioridades";
            // line 35
            echo "    ";
        }
        // line 36
        echo "            <div>
            <h3 style=\"color: #003399;text-align:center;\">Sistema Integral de Atención al Paciente </h3>
            <h3 style=\"color: #003399;text-align:center;\"><strong>Módulo:</strong>";
        // line 38
        echo twig_escape_filter($this->env, (isset($context["nombreModulo"]) ? $context["nombreModulo"] : $this->getContext($context, "nombreModulo")), "html", null, true);
        echo "</h3>
            <div style=\"text-align:justify;line-height:25px;\">
                <p><strong>Finalidad:</strong>";
        // line 40
        echo twig_escape_filter($this->env, (isset($context["descripcionModulo"]) ? $context["descripcionModulo"] : $this->getContext($context, "descripcionModulo")), "html", null, true);
        echo "</p>
                <p><strong>Versión:</strong>2.0</p>
                <p><strong>Tecnologías Utilizadas:</strong>
                <ul>
                    <li><strong>Framework de programación:</strong> Symfony 2.0</li>
                    <li><strong>Gestor de Base de Datos:</strong> PostgreSQL</li>
                    <li><strong>Licencia:</strong> OpenGL</li>

                </ul>
                </p>
                <p><strong>SIAP-SUIS </strong>es diseñado por el equipo de desarrollo de la Dirección de Tecnología de Información y Comunicaciones(DTIC)</p>
                <p><strong>Contactenos:</strong> listasiap@salud.gob.sv </p>
            </div>
            <br />
        </div>
        <br />

    </div>
";
    }

    public function getTemplateName()
    {
        return "MinsalSiapsBundle::acercaDe.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  114 => 36,  111 => 35,  108 => 34,  105 => 33,  102 => 32,  96 => 30,  93 => 29,  89 => 27,  86 => 26,  80 => 24,  74 => 22,  68 => 20,  65 => 19,  58 => 16,  46 => 10,  38 => 6,  35 => 5,  32 => 4,  29 => 3,  26 => 2,  20 => 1,  956 => 271,  953 => 270,  950 => 269,  946 => 302,  942 => 300,  936 => 297,  933 => 296,  931 => 295,  925 => 292,  917 => 291,  909 => 288,  903 => 286,  901 => 285,  898 => 284,  892 => 282,  890 => 281,  887 => 280,  881 => 278,  876 => 276,  870 => 274,  868 => 273,  865 => 272,  860 => 268,  857 => 267,  853 => 261,  848 => 258,  840 => 253,  834 => 249,  832 => 248,  828 => 246,  820 => 243,  810 => 238,  807 => 237,  802 => 235,  799 => 234,  796 => 233,  791 => 262,  788 => 233,  785 => 232,  780 => 303,  778 => 267,  771 => 232,  768 => 231,  760 => 222,  757 => 221,  753 => 220,  749 => 218,  743 => 217,  738 => 214,  732 => 213,  720 => 211,  717 => 210,  713 => 209,  707 => 208,  700 => 205,  696 => 204,  688 => 202,  682 => 201,  679 => 200,  673 => 198,  668 => 197,  665 => 196,  663 => 195,  660 => 194,  657 => 193,  644 => 190,  641 => 189,  635 => 188,  632 => 187,  629 => 186,  616 => 182,  610 => 181,  607 => 180,  603 => 179,  600 => 178,  597 => 177,  594 => 176,  588 => 175,  584 => 173,  570 => 164,  564 => 162,  561 => 161,  558 => 160,  554 => 224,  551 => 221,  548 => 176,  546 => 175,  543 => 174,  540 => 160,  537 => 159,  531 => 225,  529 => 159,  525 => 157,  522 => 156,  515 => 305,  513 => 230,  509 => 228,  507 => 156,  504 => 155,  501 => 154,  493 => 143,  490 => 142,  479 => 135,  471 => 129,  468 => 128,  464 => 125,  460 => 123,  454 => 121,  451 => 120,  434 => 118,  418 => 112,  410 => 110,  405 => 108,  402 => 107,  384 => 106,  381 => 105,  379 => 104,  376 => 103,  373 => 102,  370 => 101,  366 => 150,  362 => 148,  360 => 128,  356 => 126,  354 => 101,  343 => 92,  340 => 91,  337 => 90,  332 => 88,  326 => 86,  320 => 84,  309 => 82,  304 => 81,  301 => 80,  296 => 151,  291 => 80,  288 => 79,  274 => 53,  265 => 51,  261 => 50,  254 => 46,  236 => 42,  228 => 41,  224 => 39,  221 => 38,  216 => 35,  203 => 32,  197 => 30,  191 => 26,  182 => 23,  176 => 309,  171 => 153,  161 => 75,  158 => 74,  141 => 72,  133 => 69,  129 => 67,  103 => 63,  92 => 59,  87 => 57,  83 => 25,  81 => 38,  78 => 37,  76 => 30,  73 => 29,  71 => 21,  66 => 23,  63 => 22,  61 => 17,  59 => 20,  55 => 15,  51 => 16,  49 => 11,  47 => 14,  43 => 9,  41 => 11,  940 => 351,  932 => 346,  926 => 342,  924 => 341,  920 => 339,  914 => 290,  912 => 289,  908 => 334,  902 => 331,  899 => 330,  897 => 329,  894 => 328,  891 => 327,  888 => 326,  883 => 323,  879 => 277,  875 => 315,  869 => 313,  866 => 312,  863 => 269,  849 => 310,  843 => 308,  839 => 306,  833 => 304,  830 => 303,  822 => 244,  816 => 241,  813 => 298,  811 => 297,  808 => 296,  805 => 236,  787 => 294,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  773 => 264,  765 => 230,  763 => 273,  754 => 266,  751 => 265,  747 => 260,  744 => 259,  740 => 256,  734 => 254,  731 => 253,  728 => 252,  725 => 251,  721 => 258,  719 => 257,  716 => 251,  714 => 250,  711 => 249,  705 => 248,  701 => 261,  698 => 259,  695 => 249,  693 => 248,  690 => 247,  687 => 246,  683 => 282,  678 => 279,  676 => 199,  671 => 262,  669 => 246,  653 => 232,  650 => 192,  647 => 191,  643 => 227,  640 => 226,  634 => 224,  628 => 222,  626 => 184,  621 => 220,  619 => 183,  609 => 216,  605 => 215,  602 => 214,  599 => 213,  593 => 318,  591 => 289,  583 => 287,  579 => 284,  577 => 283,  574 => 230,  571 => 228,  569 => 213,  566 => 212,  563 => 211,  557 => 209,  499 => 154,  495 => 153,  488 => 148,  486 => 147,  482 => 136,  478 => 143,  457 => 124,  455 => 123,  448 => 119,  444 => 119,  442 => 111,  430 => 101,  428 => 116,  424 => 114,  414 => 94,  408 => 109,  391 => 76,  389 => 75,  383 => 74,  377 => 73,  371 => 72,  365 => 71,  359 => 70,  353 => 69,  347 => 68,  341 => 67,  335 => 66,  329 => 65,  311 => 83,  305 => 61,  299 => 60,  293 => 90,  287 => 58,  281 => 57,  275 => 56,  269 => 55,  257 => 53,  244 => 43,  238 => 49,  232 => 48,  229 => 47,  223 => 46,  207 => 33,  200 => 31,  193 => 36,  189 => 34,  183 => 33,  175 => 32,  168 => 29,  155 => 73,  148 => 23,  142 => 22,  136 => 70,  124 => 19,  100 => 62,  94 => 60,  88 => 13,  82 => 12,  77 => 23,  70 => 9,  67 => 8,  60 => 6,  57 => 19,  52 => 3,  14 => 2,  323 => 85,  317 => 63,  308 => 95,  302 => 93,  297 => 92,  292 => 91,  289 => 90,  285 => 78,  279 => 77,  276 => 85,  273 => 84,  263 => 54,  259 => 132,  250 => 44,  242 => 121,  235 => 116,  225 => 108,  218 => 106,  215 => 44,  213 => 104,  208 => 102,  204 => 41,  201 => 100,  199 => 90,  196 => 89,  194 => 84,  188 => 25,  185 => 81,  177 => 138,  174 => 154,  172 => 31,  169 => 78,  165 => 77,  162 => 77,  156 => 75,  152 => 73,  149 => 72,  140 => 67,  137 => 66,  132 => 69,  130 => 20,  126 => 66,  123 => 40,  118 => 38,  112 => 17,  106 => 64,  101 => 50,  99 => 31,  56 => 10,  53 => 17,  45 => 13,  39 => 4,  36 => 3,);
    }
}
