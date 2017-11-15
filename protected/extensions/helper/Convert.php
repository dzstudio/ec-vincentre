<?php
/**
 * Copyright (c) 2006 - 2011 Etology, Inc. All Rights Reserved.
 *
 * THIS IS UNPUBLISHED PROPRIETARY SOURCE CODE OF Etology, Inc.
 * The copyright notice above does not evidence any
 * actual or intended publication of such source code.
 */

/**
 * Wrapper class to convert a resource as required format.
 * @package lib
 */

/**
 * This class is used to convert a resource into specified format.
 * @package lib
 * @version 0.1
 */
class Convert
{
  /**
   * Decimal point.
   * @var
   */
  private static $decimalPoint = '.';

  /**
   * Thousands separator.
   * @var
   */
  private static $thousandsSeparator = ',';

  /**
   * Date format.
   * @var string
   */
  private static $dateFormat = 'Y-m-d';

  public static function getDate($nDaysLater = 0)
  {
    return self::getDateTime($nDaysLater, self::$dateFormat);
  }

  public static function getDateTime($nDaysLater = 0, $format = 'Y-m-d H:i:s')
  {
    $currentDateTime = date('Y-m-d H:i:s');
    $date = mktime(
      date('H', $currentDateTime),
      date('i', $currentDateTime),
      date('s', $currentDateTime),
      date('m', $currentDateTime) ,
      date('d', $currentDateTime) + ($nDaysLater),
      date('Y', $currentDateTime)
    );

    return date($format, $date);
  }

  public static function formatDate($date, $format = null)
  {
    $date = strtotime($date);
    if (0 > $date)
    {
      $date = 0;
    }

    if ($format)
    {
      $result = date($format, $date);
    }
    else
    {
      $result = date(self::$dateFormat, $date);
    }

    return $result;
  }

  public static function getDecimalPoint()
  {
    return self::$decimalPoint;
  }

  public static function getThousandsSeparator()
  {
    return self::$thousandsSeparator;
  }

  /**
   * Atom function to convert a number as '$xx,xxx.xx' format.
   * @param float $amount original number
   * @param bool $isN flag to display N/A
   * @param int $decimal decimal length
   * @param int $leastDecimal least decimal if last numbers is 0 (If $leastDecimal = 2, than 2.2000 -> 2.20)
   * @return string
   */
  public static function toDollar($amount, $isN = false, $decimal = 2, $leastDecimal = -1)
  {
    $value = number_format(abs($amount), $decimal, self::getDecimalPoint(), self::getThousandsSeparator());

    if (-1 < $leastDecimal)
    {
      $value = preg_replace('/^(\d+\.\d{' . $leastDecimal . '}\d*[1-9]|\d+\.\d{' . $leastDecimal . '})0+$/', '$1', $value);
      $value = preg_replace('/\.$/', '', $value);
    }

    $value = (0 <= round($amount, $decimal) ? '$' : '-$') . $value;
    if ($isN)
    {
      $value = ($amount != 0) ? $value : Yii::t('common', 'N_A');
    }

    return $value;
  }

  /**
   * Atom function to convert a number as '$xx,xxx.xx' format.
   *
   * @param float $amount original number
   * @param bool $isN flag to display N/A
   * @param int $decimal decimal length
   * @return string
   */
  public static function toMoney($amount, $isN = false, $decimal = 2)
  {
    return self::toDollar($amount, $isN, $decimal);
  }

    /**
   * Converts resource to an array if necessary.
   * @param mixed $convertSource the source to be converted
   * @return array if the source is array, return itself; or an array with an element of the source
   */
  public static function toArray($convertSource)
  {
    return is_array($convertSource) ? $convertSource : array($convertSource);
  }

  /**
   * Converts special characters to HTML entities htmlspecialchars().
   *
   * @param string $string original string
   * @return string
   */
  public static function escapeHtml($string)
  {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
  }

  /**
   * Format a number with grouped thousands
   * @param float $number
   * @param int $decimal
   * @return string
   */
  public static function numberFormat($number, $decimal = 2)
  {
    return number_format($number, $decimal, self::$decimalPoint, self::$thousandsSeparator);
  }

  /**
   * Atom function to convert a number as specified format.
   * @param float $number original number
   * @param int $decimals reserved decimals
   * @param boolean $isN if the value should show 'N/A'
   * @return string
   */
  public static function toNumber($number, $decimals = 0, $isN = false)
  {
    $value = number_format($number, $decimals, self::getDecimalPoint(), self::getThousandsSeparator());

    if ($isN)
    {
      $value = ($number != 0) ? $value : __('N/A');
    }

    return $value;
  }

  /**
   * Converts a number as 'XX.XX%' percentage format.
   *
   * @param float $number the original number
   * @param int $decimals reserved decimals
   * @return string
   */
  public static function toPercent($number, $decimals = 2)
  {
    return self::toNumber($number * 100, $decimals) . '%';
  }

  /**
   * Atom function to convert a number to CPC.
   * If the number is not 0 but smaller than 0.01, will return $0.01.
   *
   * @param float $cpc the original CPC
   * @param boolean $isN the flag to indicate if 'N/A' should be displayed if CPC is zero
   * @return string
   */
  public static function toCPC($cpc, $isN = true)
  {
    return ((0 < $cpc) && (0.01 > $cpc)) ? self::toDollar(0.01) : self::toDollar($cpc, $isN);
  }

  /**
   * Encode through base64
   *
   * @param string $data binary data
   * @return string encoded data
   */
  public static function toBase64($data)
  {
    return base64_encode($data);
  }

  public static function datetimeToStr($datetime) {
    $nowTimestamp = strtotime(Common::getNow());
    $today = self::formatDate(Common::getNow(), 'Y-m-d');
    $yesterday = date('Y-m-d', $nowTimestamp - 86400);
    $theDateBeforeYesterday = date('Y-m-d', $nowTimestamp - 2 * 86400);
    $compareDate = date('Y-m-d', $datetime);
    $result = date('H:i:s', $datetime);

    if ($compareDate == $today) {
      $result = '今天 ' . $result;
    }
    else if ($compareDate == $yesterday) {
      $result = '昨天 ' . $result;
    }
    else if ($compareDate == $theDateBeforeYesterday) {
      $result = '前天 ' . $result;
    }
    else {
      $result = date('Y-m-d H:i:s', $datetime);
    }

    return $result;
  }

  public static function htmlEncode($html) {
    return htmlentities($html, ENT_NOQUOTES, "utf-8");
  }

  public static function jsonEncode($obj) {
    return CJSON::encode($obj);
  }

  public static function jsonDecode($str) {
    return CJSON::decode($str);
  }
}