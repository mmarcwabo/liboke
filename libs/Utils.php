<?php

class Utils
{
  //Show a php array as an html table
  public static function htmlTable($data = array())
  {
    $rows = array();
    foreach ($data as $row) {
      $cells = array();
      foreach ($row as $cell) {
        $cells[] = "<td>{$cell}</td>";
      }
      $rows[] = "<tr>" . implode('', $cells) . "</tr>";
    }
    return "<table class='hci-table table table-striped'>" . implode('', $rows) . "</table>";
  }

  /**
   *For array of arrays
   *
   */
  public static function arrayToList($data = array())
  {
    $rows = array();
    foreach ($data as $row) {
      $items = array();
      foreach ($row as $item) {
        $items[] = $item;
      }
      $rows[] = "<option>" . implode('', $items) . "</option>";
    }
    return implode('', $rows);
  }

  /*
 *For array of simple items
 *
 */
  public static function arrayItemToList($data = array())
  {
    $options = array();
    for ($i = 0; $i < count($data); $i++) {

      $options[] = "<option>" . $data[$i] . "</option>";
    }
    return implode('', $options);
  }

  public static function getRandowItems($items_table, $number)
  {
    $items_table = (array) $items_table;
    $items_table = shuffle($items_table);
    $random_items = array();
    for ($i = 0; $$i < $number; $i++) {
      // Get random elements from the shuffled array
      // Countries, towns and other element
      $random_items[$i] = $items_table[$i];
    }
    return $random_items;
  }

  /*
 *Main button style
 *
 */
  public static function buttonize($label, $isForModal, $targetID)
  {
    $modal_setting = "";
    if ($isForModal) {
      $modal_setting = 'data-toggle="modal" data-target="' . $targetID;
    }
    echo  '<button type="button" class="btn btn-lg"' .
      $modal_setting .
      '" style="background-color:#6dac29; color:white;">
        ' . $label . '
        </button>';
  }

  /**
   * iconize
   * @param $image - Image path
   * @param $sizex - X Dimension of the image
   * @param $sizey - Y Dimension of the image
   * @return Html - img tag
   */
  public static function iconize($image, $size)
  {
    echo '
  <img src="' . _URL_ . 'images/'
      . $image . '" alt="icon" height="'
      . $size . '" width="' . $size . '"/>
  ';
  }

  public static function format_number($number)
  {
    $number_ = explode('-', $number);
    return implode("", $number_);
  }

  /**
   * notice - Display a not info
   * @param $style - green, red, yellow (respectively error, warning, ok notices)
   * @param $notice - notice content
   * @return string - notice
   * 
   */

  public static function notice($style, $notice = "")
  {
    $close_button = '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>';
    if ($style == "green") {
      $notice_ = '<div class="alert alert-success">' . $notice . $close_button . '</div>';
    } else if ($style == "red") {
      $notice_ = '<div class="alert alert-danger">' . $notice . $close_button . '</div>';
    } else {
      $notice_ = '<div class="alert alert-warning">' . $notice . $close_button . '</div>';;
    }
    return $notice_;
  }

  public static function add_cd_country_code($phone_number)
  {
    // Remove the first zero if the number has 10
    $number = '';
    if (strlen($phone_number) == 10) {
      $number = substr($phone_number, 1);
    } else if (strlen($phone_number) == 9){
      $number = $phone_number;
    } else {
      return false;
    }

    // Add country code to number
    $number = '+243' . $number;

    return $number;
  }
}//class Utils end
