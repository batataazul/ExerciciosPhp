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
  public function testForMe() {
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
  public function testForMe2() {
    $ret = $this->resolucao->textWrap("O presidente agiu anticonstitucionalissimamente com esta medida.", 10);
    $this->assertEquals("O", $ret[0]);
    $this->assertEquals("presidente", $ret[1]);
    $this->assertEquals("agiu antic", $ret[2]);
    $this->assertEquals("onstitucio", $ret[3]);
    $this->assertEquals("nalissimam", $ret[4]);
    $this->assertEquals("ente com", $ret[5]);
    $this->assertEquals("esta", $ret[6]);
    $this->assertEquals("medida.", $ret[7]);
    $this->assertCount(8, $ret);
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
  public function testForMe3() {
    $ret = $this->resolucao->textWrap("Porque Deus tanto amou o mundo que deu o seu Filho Unigênito,\npara que todo o que nele crer não pereça, mas tenha a vida eterna.", 15);
    $this->assertEquals("Porque Deus", $ret[0]);
    $this->assertEquals("tanto amou o", $ret[1]);
    $this->assertEquals("mundo que deu o", $ret[2]);
    $this->assertEquals("seu Filho", $ret[3]);
    $this->assertEquals("Unigênito,\npara", $ret[4]);
    $this->assertEquals("que todo o que", $ret[5]);
    $this->assertEquals("nele crer não", $ret[6]);
    $this->assertEquals("pereça, mas", $ret[7]);
    $this->assertEquals("tenha a vida", $ret[8]);
    $this->assertEquals("eterna.", $ret[9]);
    $this->assertCount(10, $ret);
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
  public function testForMe4() {
    $ret = $this->resolucao->textWrap("O presidente agiu anticonstitucionalissimamente com esta medida.", 8);
    $this->assertEquals("O presid", $ret[0]);
    $this->assertEquals("ente", $ret[1]);
    $this->assertEquals("agiu ant", $ret[2]);
    $this->assertEquals("iconstit", $ret[3]);
    $this->assertEquals("ucionali", $ret[4]);
    $this->assertEquals("ssimamen", $ret[5]);
    $this->assertEquals("te com", $ret[6]);
    $this->assertEquals("esta", $ret[7]);
    $this->assertEquals("medida.", $ret[8]);
    $this->assertCount(9, $ret);
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
  public function testForMe5()
  {
    $ret = $this->resolucao->textWrap("Eu vou viajar para o Paraná", 30);
    $this->assertEquals("Eu vou viajar para o Paraná", $ret[0]);
    $this->assertCount(1, $ret);
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
  public function testForMe6()
  {
    $ret = $this->resolucao->textWrap("Eu vou viajar para o Paraná", 10);
    $this->assertEquals("Eu vou", $ret[0]);
    $this->assertEquals("viajar", $ret[1]);
    $this->assertEquals("para o", $ret[2]);
    $this->assertEquals("Paraná", $ret[3]);
    $this->assertCount(4, $ret);
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
  public function testForMe7() {
    $ret = $this->resolucao->textWrap("No princípio Deus criou os céus e a terra.", 6);
    $this->assertEquals("No pri", $ret[0]);
    $this->assertEquals("ncípio", $ret[1]);
    $this->assertEquals("Deus", $ret[2]);
    $this->assertEquals("criou", $ret[3]);
    $this->assertEquals("os", $ret[4]);
    $this->assertEquals("céus e", $ret[5]);
    $this->assertEquals("a", $ret[6]);
    $this->assertEquals("terra.", $ret[7]);
    $this->assertCount(8, $ret);
  }

  /**
   * Teste personalizado Hebraico.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::__construct
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::isBlank
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::getWord
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::breakWord
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::removeBlank
   */
  public function testForMe8() {
    $ret = $this->resolucao-> textWrap("ישו אוהב אותך", 6);
    $this->assertEquals("ישו", $ret[0]);
    $this->assertEquals("אוהב", $ret[1]);
    $this->assertEquals("אותך", $ret[2]);
    $this->assertCount(3, $ret);
  }

  /**
   * Teste personalizado Japonês.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::__construct
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::isBlank
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::getWord
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::breakWord
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::removeBlank
   */
  public function testForMe9() {
    $ret = $this->resolucao->textWrap("テーブルの上に本があります", 7);
    $this->assertEquals("テーブルの上に", $ret[0]);
    $this->assertEquals("本があります", $ret[1]);
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
  public function testForMe10()
  {
    $ret = $this->resolucao->textWrap("Pois todos pecaram e não alcançam o padrão da glória de Deus, mas ele, em sua graça, nos declara justos por meio de Cristo Jesus, que nos resgatou do castigo por nossos pecados.", 20);
    $this->assertEquals("Pois todos pecaram e", $ret[0]);
    $this->assertEquals("não alcançam o", $ret[1]);
    $this->assertEquals("padrão da glória de", $ret[2]);
    $this->assertEquals("Deus, mas ele, em", $ret[3]);
    $this->assertEquals("sua graça, nos", $ret[4]);
    $this->assertEquals("declara justos por", $ret[5]);
    $this->assertEquals("meio de Cristo", $ret[6]);
    $this->assertEquals("Jesus, que nos", $ret[7]);
    $this->assertEquals("resgatou do castigo", $ret[8]);
    $this->assertEquals("por nossos pecados.", $ret[9]);
    $this->assertCount(10, $ret);
  }
  /**
   * Teste personalizado Hebraico.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::__construct
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::isBlank
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::getWord
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::breakWord
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::removeBlank
   */
  public function testForMe11() {
    $ret = $this->resolucao->textWrap("' אַחַ֤ת ׀ שָׁאַ֣לְתִּי מֵֽאֵת־יְהוָה֮ אוֹתָ֪הּ אֲבַ֫קֵּ֥שׁ שִׁבְתִּ֣י בְּבֵית־יְ֭הוָה כָּל־יְמֵ֣י חַיַּ֑י לַחֲז֥וֹת בְּנֹֽעַם־יְ֝הוָ֗ה וּלְבַקֵּ֥ר בְּהֵיכָלֽוֹ׃ '", 7);
    $this->assertEquals("' אַחַ֤ת ׀", $ret[0]);
    $this->assertEquals("שָׁאַ֣לְתִּי מֵֽ", $ret[1]);
    $this->assertEquals("אֵת־יְהוָה֮", $ret[2]);
    $this->assertEquals("אוֹתָ֪הּ", $ret[3]);
    $this->assertEquals("אֲבַ֫קֵּ֥שׁ", $ret[4]);
    $this->assertEquals("שִׁבְתִּ֣י בְּבֵ", $ret[5]);
    $this->assertEquals("ית־יְ֭הוָה", $ret[6]);
    $this->assertEquals("כָּל־יְמֵ֣י", $ret[7]);
    $this->assertEquals("חַיַּ֑י", $ret[8]);
    $this->assertEquals("לַחֲז֥וֹ  בְּ", $ret[9]);
    $this->assertEquals("נֹֽעַם־יְ֝הוָ֗", $ret[10]);
    $this->assertEquals("ה וּלְבַקֵּ֥ר", $ret[11]);
    $this->assertEquals("בְּהֵיכָלֽוֹ׃", $ret[12]);
    $this->assertEquals("'", $ret[13]);
    $this->assertCount(14, $ret);
  }
}
