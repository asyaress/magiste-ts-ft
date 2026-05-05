<?php

namespace App\Support;

class TotpService
{
    private const ALPHABET = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
    private const DIGITS = 6;
    private const PERIOD = 30;

    public function generateSecret(int $bytesLength = 20): string
    {
        return $this->base32Encode(random_bytes($bytesLength));
    }

    public function makeOtpAuthUri(string $issuer, string $accountName, string $secret): string
    {
        $label = rawurlencode($issuer . ':' . $accountName);
        $issuerParam = rawurlencode($issuer);

        return "otpauth://totp/{$label}?secret={$secret}&issuer={$issuerParam}&algorithm=SHA1&digits=" . self::DIGITS . "&period=" . self::PERIOD;
    }

    public function verifyCode(string $secret, string $code, int $window = 1): bool
    {
        $cleanCode = preg_replace('/\D+/', '', $code) ?? '';
        if (strlen($cleanCode) !== self::DIGITS) {
            return false;
        }

        $counter = (int) floor(time() / self::PERIOD);

        for ($offset = -$window; $offset <= $window; $offset++) {
            if (hash_equals($this->codeAt($secret, $counter + $offset), $cleanCode)) {
                return true;
            }
        }

        return false;
    }

    private function codeAt(string $secret, int $counter): string
    {
        $key = $this->base32Decode($secret);
        if ($key === '') {
            return '';
        }

        $binaryCounter = pack('N*', 0) . pack('N*', $counter);
        $hash = hash_hmac('sha1', $binaryCounter, $key, true);
        $offset = ord(substr($hash, -1)) & 0x0f;
        $chunk = substr($hash, $offset, 4);
        $value = unpack('N', $chunk)[1] & 0x7fffffff;

        return str_pad((string) ($value % (10 ** self::DIGITS)), self::DIGITS, '0', STR_PAD_LEFT);
    }

    private function base32Encode(string $binary): string
    {
        $bits = '';
        $length = strlen($binary);

        for ($i = 0; $i < $length; $i++) {
            $bits .= str_pad(decbin(ord($binary[$i])), 8, '0', STR_PAD_LEFT);
        }

        $encoded = '';
        $bitLength = strlen($bits);

        for ($i = 0; $i < $bitLength; $i += 5) {
            $chunk = substr($bits, $i, 5);
            if (strlen($chunk) < 5) {
                $chunk = str_pad($chunk, 5, '0', STR_PAD_RIGHT);
            }

            $encoded .= self::ALPHABET[bindec($chunk)];
        }

        return $encoded;
    }

    private function base32Decode(string $encoded): string
    {
        $clean = strtoupper(preg_replace('/[^A-Z2-7]/', '', $encoded) ?? '');
        if ($clean === '') {
            return '';
        }

        $bits = '';
        $length = strlen($clean);

        for ($i = 0; $i < $length; $i++) {
            $index = strpos(self::ALPHABET, $clean[$i]);
            if ($index === false) {
                continue;
            }

            $bits .= str_pad(decbin($index), 5, '0', STR_PAD_LEFT);
        }

        $binary = '';
        $bitLength = strlen($bits);

        for ($i = 0; $i + 8 <= $bitLength; $i += 8) {
            $binary .= chr(bindec(substr($bits, $i, 8)));
        }

        return $binary;
    }
}

