<?php

namespace Galoa\ExerciciosPhp\Tests\TextWrap;

use Galoa\ExerciciosPhp\TextWrap\Resolucao;
use PHPUnit\Framework\TestCase;

/**
 * Tests for Galoa\ExerciciosPhp\TextWrap\Resolucao.
 *
 * @codeCoverageIgnore
 */
class TextWrapTest extends TestCase {

  /**
   * Test Setup.
   */
  public function setUp() {
    $this->resolucao = new Resolucao();
    $this->baseString = "Se vi mais longe foi por estar de pé sobre ombros de gigantes";
  }

  /**
   * Checa o retorno para strings vazias.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::__construct
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::isBlank
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::getWord
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::breakWord
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::removeBlank
   */
  public function testForEmptyStrings() {
    $ret = $this->resolucao->textWrap("", 2021);
    $this->assertEmpty($ret[0]);
    $this->assertCount(1, $ret);
  }

  /**
   * Testa a quebra de linha para palavras curtas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::__construct
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::isBlank
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::getWord
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::breakWord
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::removeBlank
   */
  public function testForSmallWords() {
    $ret = $this->resolucao->textWrap($this->baseString, 8);
    $this->assertEquals("Se vi", $ret[0]);
    $this->assertEquals("mais", $ret[1]);
    $this->assertEquals("longe", $ret[2]);
    $this->assertEquals("foi por", $ret[3]);
    $this->assertEquals("estar de", $ret[4]);
    $this->assertEquals("pé sobre", $ret[5]);
    $this->assertEquals("ombros", $ret[6]);
    $this->assertEquals("de", $ret[7]);
    $this->assertEquals("gigantes", $ret[8]);
    $this->assertCount(9, $ret);
  }

  /**
   * Testa a quebra de linha para palavras curtas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::__construct
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::isBlank
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::getWord
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::breakWord
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::removeBlank
   */
  public function testForSmallWords2() {
    $ret = $this->resolucao->textWrap($this->baseString, 12);
    $this->assertEquals("Se vi mais", $ret[0]);
    $this->assertEquals("longe foi", $ret[1]);
    $this->assertEquals("por estar de", $ret[2]);
    $this->assertEquals("pé sobre", $ret[3]);
    $this->assertEquals("ombros de", $ret[4]);
    $this->assertEquals("gigantes", $ret[5]);
    $this->assertCount(6, $ret);
  }

  /**
   * Teste personalizado.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::__construct
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::isBlank
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::getWord
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::breakWord
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::removeBlank
   */
  public function myText() {
    $ret = $this->resolucao->textWrap("Batata Frita", 6);
    $this->assertEquals("Batata", $ret[0]);
    $this->assertEquals("Frita", $ret[1]);
    $this->assertCount(2, $ret);
  }
  /**
   * Teste personalizado.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::__construct
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::isBlank
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::getWord
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::breakWord
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::removeBlank
   */
  public function myText2() {
    $ret = $this->resolucao->textWrap("O presidente agiu anticonstitucionalissimamente com esta medida.", 10);
    $this->assertEquals("O", $ret[0]);
    $this->assertEquals("agiu antic", $ret[1]);
    $this->assertEquals("onstitucio", $ret[2]);
    $this->assertEquals("nalissimam", $ret[3]);
    $this->assertEquals("ente com", $ret[4]);
    $this->assertEquals("esta", $ret[5]);
    $this->assertEquals("medida.", $ret[6]);
    $this->assertCount(7, $ret);
  }

}
