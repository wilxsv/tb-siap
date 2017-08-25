<?php
/*
 *  INITCAP
 *      Convierte la primera letra de cada palabra en mayúscula y el resto en
 *      minúscula. Las palabras son secuencias de caracteres alfanuméricos,
 *      separados por carecteres no alfanumericos.
 *
 *  DBMS Soportados | Documentación
 *  ----------------+-----------------------------------------------------------
 *      PostgreSql  |   https://www.postgresql.org/docs/9.4/static/functions-string.html
 *
 *  StringFunction ::= "INITCAP" "(" ArithmeticExpression ")"
 */
namespace Application\CoreBundle\Dql;

use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;

class InitcapDql extends FunctionNode {

    public $field;

    public function parse(\Doctrine\ORM\Query\Parser $parser) {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->field = $parser->ArithmeticExpression();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker) {
        return 'INITCAP(' .
            $this->field->dispatch($sqlWalker) .
        ')';
    }
}
