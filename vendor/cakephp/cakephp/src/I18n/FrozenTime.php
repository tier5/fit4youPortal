<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         3.2.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace Cake\I18n;

use Cake\Chronos\Chronos;
use Cake\Chronos\ChronosInterface;
use DateTime;
use DateTimeZone;
use IntlDateFormatter;
use JsonSerializable;

/**
 * Extends the built-in DateTime class to provide handy methods and locale-aware
 * formatting helpers
 *
 * This object provides an immutable variant of Cake\I18n\Time
 */
class FrozenTime extends Chronos implements JsonSerializable
{
    use DateFormatTrait;

    /**
     * The format to use when formatting a time using `Cake\I18n\FrozenTime::i18nFormat()`
     * and `__toString`
     *
     * The format should be either the formatting constants from IntlDateFormatter as
     * described in (http://www.php.net/manual/en/class.intldateformatter.php) or a pattern
     * as specified in (http://www.icu-project.org/apiref/icu4c/classSimpleDateFormat.html#details)
     *
     * It is possible to provide an array of 2 constants. In this case, the first position
     * will be used for formatting the date part of the object and the second position
     * will be used to format the time part.
     *
     * @var string|array|int
     * @see \Cake\I18n\FrozenTime::i18nFormat()
     */
    protected static $_toStringFormat = [IntlDateFormatter::SHORT, IntlDateFormatter::SHORT];

    /**
     * The format to use when formatting a time using `Cake\I18n\FrozenTime::nice()`
     *
     * The format should be either the formatting constants from IntlDateFormatter as
     * described in (http://www.php.net/manual/en/class.intldateformatter.php) or a pattern
     * as specified in (http://www.icu-project.org/apiref/icu4c/classSimpleDateFormat.html#details)
     *
     * It is possible to provide an array of 2 constants. In this case, the first position
     * will be used for formatting the date part of the object and the second position
     * will be used to format the time part.
     *
     * @var string|array|int
     * @see \Cake\I18n\FrozenTime::nice()
     */
    public static $niceFormat = [IntlDateFormatter::MEDIUM, IntlDateFormatter::SHORT];

    /**
     * The format to use when formatting a time using `Cake\I18n\FrozenTime::timeAgoInWords()`
     * and the difference is more than `Cake\I18n\FrozenTime::$wordEnd`
     *
     * @var string
     * @see \Cake\I18n\FrozenTime::timeAgoInWords()
     */
    public static $wordFormat = [IntlDateFormatter::SHORT, -1];

    /**
     * The format to use when formatting a time using `Time::timeAgoInWords()`
     * and the difference is less than `Time::$wordEnd`
     *
     * @var array
     * @see \Cake\I18n\FrozenTime::timeAgoInWords()
     */
    public static $wordAccuracy = [
        'year' => "day",
        'month' => "day",
        'week' => "day",
        'day' => "hour",
        'hour' => "minute",
        'minute' => "minute",
        'second' => "second",
    ];

    /**
     * The end of relative time telling
     *
     * @var string
     * @see \Cake\I18n\FrozenTime::timeAgoInWords()
     */
    public static $wordEnd = '+1 month';

    /**
     * {@inheritDoc}
     */
    public function __construct($time = null, $tz = null)
    {
        if ($time instanceof DateTime) {
            $tz = $time->getTimeZone();
            $time = $time->format('Y-m-d H:i:s');
        }

        if (is_numeric($time)) {
            $time = '@' . $time;
        }

        parent::__construct($time, $tz);
    }

    /**
     * Returns either a relative or a formatted absolute date depending
     * on the difference between the current time and this object.
     *
     * ### Options:
     *
     * - `from` => another Time object representing the "now" time
     * - `format` => a fall back format if the relative time is longer than the duration specified by end
     * - `accuracy` => Specifies how accurate the date should be described (array)
     *    - year =>   The format if years > 0   (default "day")
     *    - month =>  The format if months > 0  (default "day")
     *    - week =>   The format if weeks > 0   (default "day")
     *    - day =>    The format if weeks > 0   (default "hour")
     *    - hour =>   The format if hours > 0   (default "minute")
     *    - minute => The format if minutes > 0 (default "minute")
     *    - second => The format if seconds > 0 (default "second")
     * - `end` => The end of relative time telling
     * - `relativeString` => The printf compatible string when outputting relative time
     * - `absoluteString` => The printf compatible string when outputting absolute time
     * - `timezone` => The user timezone the timestamp should be formatted in.
     *
     * Relative dates look something like this:
     *
     * - 3 weeks, 4 days ago
     * - 15 seconds ago
     *
     * Default date formatting is d/M/YY e.g: on 18/2/09. Formatting is done internally using
     * `i18nFormat`, see the method for the valid formatting strings
     *
     * The returned string includes 'ago' or 'on' and assumes you'll properly add a word
     * like 'Posted ' before the function output.
     *
     * NOTE: If the difference is one week or more, the lowest level of accuracy is day
     *
     * @param array $options Array of options.
     * @return string Relative time string.
     */
    public function timeAgoInWords(array $options = [])
    {
        return $this->diffFormatter()->timeAgoInWords($this, $options);
    }

    /**
     * Get list of timezone identifiers
     *
     * @param int|string $filter A regex to filter identifier
     *   Or one of DateTimeZone class constants
     * @param string $country A two-letter ISO 3166-1 compatible country code.
     *   This option is only used when $filter is set to DateTimeZone::PER_COUNTRY
     * @param bool|array $options If true (default value) groups the identifiers list by primary region.
     *   Otherwise, an array containing `group`, `abbr`, `before`, and `after`
     *   keys. Setting `group` and `abbr` to true will group results and append
     *   timezone abbreviation in the display value. Set `before` and `after`
     *   to customize the abbreviation wrapper.
     * @return array List of timezone identifiers
     * @since 2.2
     */
    public static function listTimezones($filter = null, $country = null, $options = [])
    {
        if (is_bool($options)) {
            $options = [
                'group' => $options,
            ];
        }
        $defaults = [
            'group' => true,
            'abbr' => false,
            'before' => ' - ',
            'after' => null,
        ];
        $options += $defaults;
        $group = $options['group'];

        $regex = null;
        if (is_string($filter)) {
            $regex = $filter;
            $filter = null;
        }
        if ($filter === null) {
            $filter = DateTimeZone::ALL;
        }
        $identifiers = DateTimeZone::listIdentifiers($filter, $country);

        if ($regex) {
            foreach ($identifiers as $key => $tz) {
                if (!preg_match($regex, $tz)) {
                    unset($identifiers[$key]);
                }
            }
        }

        if ($group) {
            $groupedIdentifiers = [];
            $now = time();
            $before = $options['before'];
            $after = $options['after'];
            foreach ($identifiers as $key => $tz) {
                $abbr = null;
                if ($options['abbr']) {
                    $dateTimeZone = new DateTimeZone($tz);
                    $trans = $dateTimeZone->getTransitions($now, $now);
                    $abbr = isset($trans[0]['abbr']) ?
                        $before . $trans[0]['abbr'] . $after :
                        null;
                }
                $item = explode('/', $tz, 2);
                if (isset($item[1])) {
                    $groupedIdentifiers[$item[0]][$tz] = $item[1] . $abbr;
                } else {
                    $groupedIdentifiers[$item[0]] = [$tz => $item[0] . $abbr];
                }
            }
            return $groupedIdentifiers;
        }
        return array_combine($identifiers, $identifiers);
    }

    /**
     * Returns true this instance will happen within the specified interval
     *
     * This overridden method provides backwards compatible behavior for integers,
     * or strings with trailing spaces. This behavior is *deprecated* and will be
     * removed in future versions of CakePHP.
     *
     * @param string|int $timeInterval the numeric value with space then time type.
     *    Example of valid types: 6 hours, 2 days, 1 minute.
     * @return bool
     */
    public function wasWithinLast($timeInterval)
    {
        $tmp = trim($timeInterval);
        if (is_numeric($tmp)) {
            $timeInterval = $tmp . ' days';
        }
        return parent::wasWithinLast($timeInterval);
    }

    /**
     * Returns true this instance happened within the specified interval
     *
     * This overridden method provides backwards compatible behavior for integers,
     * or strings with trailing spaces. This behavior is *deprecated* and will be
     * removed in future versions of CakePHP.
     *
     * @param string|int $timeInterval the numeric value with space then time type.
     *    Example of valid types: 6 hours, 2 days, 1 minute.
     * @return bool
     */
    public function isWithinNext($timeInterval)
    {
        $tmp = trim($timeInterval);
        if (is_numeric($tmp)) {
            $timeInterval = $tmp . ' days';
        }
        return parent::isWithinNext($timeInterval);
    }
}
