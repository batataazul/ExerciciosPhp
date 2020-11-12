<?php

namespace Galoa\ExerciciosPhp\TextWrap;

class Resolucao implements TextWrapInterface {

  private string $myText;
  private array $uSafe;
  private int $index;
  private int $len;
  private int $counter;
  private string $blank;
  /**
  * {@inheritdoc}
  *
  */
  public function __construct() {
    $this->myText = "";
    $this->uSafe = array();
    $this->index = 0;
    $this->len = 0;
    $this->counter = 0;
    $this->blank = "";

  }

  /**
   * Método que verifica se um caractere é branco usando Regex
   * @param string $char
   *  String de um caractere para ser verificada
   * @return bool 
   *  Flag verdadeira se for branco ou falso se não for, ou se a String for maior do que 1
  */
  private function isBlank(string $char) : bool {
    $pattern = "/\s/u";
    if (mb_strlen($char,"UTF-8") > 1) {
      echo("Not Char");
      return false;
    } else{
      if(preg_match($pattern,$char) == 1) {
        return true;
      } else{
        return false;
      }
    }
  }
  /** 
   * Método que pega uma palavra do vetor de caracteres e retorna, atualizando o índice e uma contadora
  */
  private function getWord() : string {
    $word = "";
    for (; $this->index < $this->len ; $this->index++,$this->counter++) { 
      if($this->isBlank($this->uSafe[$this->index])) {
        $this->blank = $this->uSafe[$this->index];
        $this->counter++;
        return $word;
      }else {
          $word .= $this->uSafe[$this->index];
        }
    }
    return $word;
  }

  /** 
   *  Método que pega uma palavra maior que um tamanho e quebra em duas palavras
   *  @param string word
   *      Palavra que será quebrada
   *  @param string word2
   *      Referência para retornar segunda palavra
   *  @param int length
   *      Tamanho máximo que um pedaço pode ter
   *  @return string
   *      Retorna por valor primeiro pedaço da palavra e o segundo por referência
  */
  private function breakWord(string $word, string &$word2, int $length) : string {
    $auxAr = mb_str_split($word,1,"UTF-8");
    $word = "";
    $i = 0;
    for(; $i < $length; $i++) {
      $word .= $auxAr[$i];
    }
    for (; $i < count($auxAr);$i++) {
      $word2 .= $auxAr;
    }
    return $word;

  }

  public function textWrap(string $text, int $length): array {
    $result = array();
    $word = "";
    $aux = "";
    $aux2 = "";
    $this->myText = $text;
    $this->uSafe = mb_str_split($this->myText,1,"UTF-8");
    $this->len = count($this->uSafe);
    while($this->index < $this->len){
      $aux = $this->getWord();
      if ($this->counter -1 > $length){
        if(mb_strlen($aux,"UTF-8") < $length) {
          array_push($result, $word);
          $word = $aux;
          $this->counter = 0;
        }
        else{
          do{
            $aux = $this->breakWord($aux,$aux2,$length);
            $word .= $aux;
            array_push($result,$word);
            $word = "";
            $aux = $aux2;
          }while(mb_strlen($aux2,"UTF-8") > $length);
          $aux2 .= $this->blank;
          $word = $aux2;
          $this->counter = mb_strlen($aux2, "UTF-8");
          $aux2 = "";
        }
      } elseif ($this->counter - 1 == $length){
          $word .= $aux;
          array_push($result, $word);
          $this->counter = 0;
          $word = "";
      } else{
        $aux .= $this->blank;
        $word .= $aux;
      }
    }
    return $result;
  }

}
