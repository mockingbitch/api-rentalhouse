<?php
/**
 * Logger helper to log into different files
 *
 * @package    App\Helpers
 * @author     Romain Laneuville <romain.laneuville@hotmail.fr>
 */

namespace App\Core\Logger;

use Carbon\Carbon;
use Exception;
use Monolog\Logger;
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

/**
 * Class LogToChannels
 *
 * @package App\Helpers
 */
class Log
{
    /**
     * The LogToChannels channels.
     *
     * @var Logger[]
     */
    protected static array $channels = [];

    /**
     * LogToChannels constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param string $channel The channel to log the record in
     * @param int $level The error level
     * @param string $message The error message
     * @param array $context Optional context arguments
     *
     * @return mixed
     * @throws Exception
     */
    public static function log(string $channel, int $level, string $message, array $context = []): mixed
    {
        // Add the logger if it doesn't exist
        if (!isset(self::$channels[$channel])) {
            $handler = new StreamHandler(
                storage_path() . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . $channel . '.log'
            );

            $handler->setFormatter(new LineFormatter(null, null, true, true));

            self::addChannel($channel, $handler);
        }
        self::writeDatabase($level, $message);

        // LogToChannels the record
        return self::$channels[$channel]->{Logger::getLevelName($level)}($message, $context);
    }

    /**
     * Add a channel to log in
     *
     * @param string           $channelName The channel name
     * @param HandlerInterface $handler     The channel handler
     * @param string|null      $path        The path of the channel file, DEFAULT storage_path()/logs
     *
     * @throws Exception When the channel already exists
     */
    public static function addChannel(string $channelName, HandlerInterface $handler, string $path = null): void
    {
        $date = Carbon::now()->format('Y-m-d');
        if (isset(self::$channels[$channelName])) {
            throw new Exception('This channel already exists');
        }

        self::$channels[$channelName] = new Logger($channelName);
        self::$channels[$channelName]->pushHandler(
            new $handler(
                $path === null
                    ? storage_path() .
                    DIRECTORY_SEPARATOR . 'logs' .
                    DIRECTORY_SEPARATOR . $date . '_' . $channelName . '.log'
                    : $path . DIRECTORY_SEPARATOR . $date . '_' . $channelName . '.log'
            )
        );
    }

    /**
     * Adds a log record at the DEBUG level.
     *
     * @param string $channel The channel name
     * @param string $message The log message
     * @param array $context The log context
     *
     * @return mixed Whether the record has been processed
     * @throws Exception
     */
    public static function debug(string $channel, string $message, array $context = []): mixed
    {
        return self::log($channel, Logger::DEBUG, $message, $context);
    }

    /**
     * Adds a log record at the INFO level.
     *
     * @param string $channel The channel name
     * @param string $message The log message
     * @param array $context The log context
     *
     * @return mixed
     * @throws Exception
     */
    public static function info(string $channel, string $message, array $context = []): mixed
    {
        return self::log($channel, Logger::INFO, $message, $context);
    }

    /**
     * Adds a log record at the NOTICE level.
     *
     * @param string $channel The channel name
     * @param string $message The log message
     * @param array $context The log context
     *
     * @return mixed Whether the record has been processed
     * @throws Exception
     */
    public static function notice(string $channel, string $message, array $context = []): mixed
    {
        return self::log($channel, Logger::NOTICE, $message, $context);
    }

    /**
     * Adds a log record at the WARNING level.
     *
     * @param string $channel The channel name
     * @param string $message The log message
     * @param array $context The log context
     *
     * @return mixed Whether the record has been processed
     * @throws Exception
     */
    public static function warning(string $channel, string $message, array $context = []): mixed
    {
        return self::log($channel, Logger::WARNING, $message, $context);
    }

    /**
     * Adds a log record at the ERROR level.
     *
     * @param string $channel The channel name
     * @param string $message
     * @param array $context The log context
     *
     * @return mixed Whether the record has been processed
     * @throws Exception
     */
    public static function error(string $channel, string $message, array $context = []): mixed
    {
        return self::log($channel, Logger::ERROR, $message, $context);
    }

    /**
     * Adds a log record at the CRITICAL level.
     *
     * @param string $channel The channel name
     * @param string $message The log message
     * @param array $context The log context
     *
     * @return mixed Whether the record has been processed
     * @throws Exception
     */
    public function critical(string $channel, string $message, array $context = []): mixed
    {
        return self::log($channel, Logger::CRITICAL, $message, $context);
    }

    /**
     * Adds a log record at the ALERT level.
     *
     * @param string $channel The channel name
     * @param string $message The log message
     * @param array $context The log context
     *
     * @return mixed Whether the record has been processed
     * @throws Exception
     */
    public function alert(string $channel, string $message, array $context = []): mixed
    {
        return self::log($channel, Logger::ALERT, $message, $context);
    }

    /**
     * Adds a log record at the EMERGENCY level.
     *
     * @param string $channel The channel name
     * @param string $message The log message
     * @param array $context The log context
     *
     * @return mixed Whether the record has been processed
     * @throws Exception
     */
    public function emergency(string $channel, string $message, array $context = []): mixed
    {
        return self::log($channel, Logger::EMERGENCY, $message, $context);
    }

    /**
     * Write Database
     * @param string $level
     * @param string $message
     * @return mixed
     */
    public static function writeDatabase(string $level, string $message): mixed
    {
        return \App\Core\Logger\Models\Log::create([
            'status'    => $level ?? null,
            'route'     => request()->url() ?? null,
            'message'   => $message ?? null,
            'user_id'   => auth()->user()->id ?? null,
            'ip_addr'   => request()->ip() ?? null,
            'payload'   => json_encode(request()->all(), true) ?? null,
        ]);
    }
}
