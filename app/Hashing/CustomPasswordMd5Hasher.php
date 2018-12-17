<?php

namespace Gaia\Hashing;

use Illuminate\Hashing\AbstractHasher;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class CustomPasswordMd5Hasher extends AbstractHasher implements HasherContract
{
    /**
     * 
     * {@inheritDoc}
     * @see \Illuminate\Contracts\Hashing\Hasher::needsRehash()
     */
    public function needsRehash($hashedValue, array $options = [])
    {
        return false;
    }

    /**
     * 
     * {@inheritDoc}
     * 
     * @param array $options {
     *      extra info for our password md5 pash
     * 
     *      @type string            $login_name
     *      @type \Carbon\Carbon    $reg_time
     * }
     * 
     * @see \Illuminate\Contracts\Hashing\Hasher::make()
     */
    public function make($value, array $options = [])
    {
        $loginName = $options['login_name'] ?? null;
        $regTime = $options['reg_time'] ?? null;
        if (empty($loginName) || empty($regTime)) {
            throw new \InvalidArgumentException('Auth hash checker params error.');
        }
        $shadow = md5(md5($value) . $loginName . $regTime->timestamp);
        $shadow = substr($shadow, 0, 31);
        return 's' . $shadow;
    }

    /**
     * 
     * {@inheritDoc}
     * 
     *  @param array $options {
     *      extra info for our password md5 pash
     * 
     *      @type string            $login_name
     *      @type \Carbon\Carbon    $reg_time
     * }
     * 
     * @see \Illuminate\Hashing\AbstractHasher::check()
     */
    public function check($value, $hashedValue, array $options = [])
    {
        if (strlen($hashedValue) === 0) {
            return false;
        }
        return $this->make($value, $options) === $hashedValue;
    }
}
