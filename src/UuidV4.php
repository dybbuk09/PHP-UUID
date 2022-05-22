<?php

namespace Hraw\Uuid;

use Exception;

class UuidV4
{
    /**
     * Hold the hexadecimal value of random bytes
     */
    private static $randomNumberString;

    /**
     * Holds the segments of uuid4
     */
    private static $v4Segments = [8, 4, 4, 4, 12];

    /**
     * Get Uuid version 4
     * @return string
     * @throws Exception
     */
    public static function get(): string
    {
        self::$randomNumberString = self::generateRandomNumber();
        return self::transformToUuid(self::$v4Segments);
    }

    /**
     * Transform random number to RFC 4122 complaint
     * @param array $segments
     * @return string
     */
    public static function transformToUuid(array $segments): string
    {
        $uuid = '';
        foreach ($segments as $key => $segment)
        {
            $part = substr(self::$randomNumberString, 0, $segment);
            $uuid .= ($key === 0) ? $part : "-{$part}";
            self::$randomNumberString = str_replace($part, '', self::$randomNumberString);
        }
        return $uuid;
    }

    /**
     * Generate 16 bytes or 128bit of random data
     * @see https://datatracker.ietf.org/doc/html/rfc4122#section-4.4
     * @return string
     * @throws Exception
     */
    private static function generateRandomNumber(): string
    {
        $randomBytes = random_bytes(16);
        // Set version to 0100
        // For randomly or pseudo-randomly generated version
        $randomBytes[6] = chr(ord($randomBytes[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $randomBytes[8] = chr(ord($randomBytes[8]) & 0x3f | 0x80);

        return bin2hex($randomBytes);
    }

    /**
     * Validate if the given uuid is a valid version 4 uuid.
     * @param $uuid
     * @return bool
     */
    public static function validate($uuid): bool
    {
        if (!preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[4][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i', $uuid)) {
            return false;
        }
        return true;
    }
}