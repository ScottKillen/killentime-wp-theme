<?php

/* From https://github.com/BenediktBergmann/WordPress-Anchor-Plugin/tree/master
/* used under GPL3 license
*/

class KTAutoAnchor
{
  public $content;
  public $anchorIDs;

  function __construct($input)
  {
    $this->content = $input;
    $this->anchorIDs = array();
  }

  function custom_callback($matches)
  {
    $id = '';

    $matches[1] = str_replace($matches[2], "", $matches[1]);

    if (stripos($matches[0], 'id=')) {
      $array = array();
      preg_match('/id="([^"]*)"/i', $matches[0], $array);
      $id = strtolower($array[1]);

      $matches[2] = str_replace($array[0], "", $matches[2]);
    } else {
      $id = strtolower($matches[3]);
      //Replacing space with underscore
      $id = preg_replace('/\s+/', '_', $id);
      //Deleting special characters
      $id = str_replace(array('!', '?', '.', ',', '\\', '/', '<', '>', '(', ')', '[', ']', '{', '}'), '', $id);
      //Deleting umlaut
      $id = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $id);
    }

    $idWithoutIdentifier = $id;
    $idnumber = 1;
    if (substr_count(strtolower($this->content), strtolower('id="' . $id . '"')) > 1) {
      while (stripos(strtolower($this->content), strtolower('id="' . $id . '"')) || in_array($id, $this->anchorIDs)) {
        if ($idnumber != 1) {
          $id = $idWithoutIdentifier . '-' . $idnumber;
        }
        $idnumber++;
      }
    }


    if ($id != '') {
      array_push($this->anchorIDs, $id);
      $heading_link = '<a href="#' . $id . '" class="heading-anchor-link"><svg class="bi "><use href="#fa-link" /></svg></a>';
      $matches[0] = $matches[1] . ' id="' . $id . '" ' . $matches[2] . '>' . $heading_link . $matches[3] . $matches[4];
    }

    return $matches[0];
  }
}
