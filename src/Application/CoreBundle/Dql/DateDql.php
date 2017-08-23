<?php
/*
 *  DATE
 *      Convierte (cast) la expresion brindad en dato tipo fecha (date)
 *
 *  DBMS Soportados | Documentación
 *  ----------------+-----------------------------------------------------------
 *      PostgreSql  |   https://www.postgresql.org/docs/9.4/static/functions-datetime.html
 *
 *  DateFunction ::= "DATE" "(" ArithmeticExpression ")"
 */
namespace Application\CoreBundle\Dql;

use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;

class DateDql extends FunctionNode {

    public $field;

    public function parse(\Doctrine\ORM\Query\Parser $parser) {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->field = $parser->ArithmeticExpression();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker) {
        return 'DATE(' .
            $this->field->dispatch($sqlWalker) .
        ')';
    }
}
