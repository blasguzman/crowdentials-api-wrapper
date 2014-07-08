<?php

/**
 * This file is part of Crowdentials Api Wrapper.
 *
 * (c) Crowd Valley
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Crowdvalley\Crowdentials\Api\Accreditation\Checking;

/**
 * Class used to get the status of an accreditation process.
 *
 * @author Yosmany Garcia <yosmanyga@gmail.com>
 */
class Response
{
    const STATE_SUBMITTED = 'submitted';
    const STATE_VERIFIED = 'verified';
    const STATE_PENDING = 'pending';

    /**
     * The current state of the request.
     *
     * @var string;
     */
    private $state;

    /**
     * The first name of the verifier entered by the investor, if the investor
     * has not entered a verifier yet this is set to null.
     *
     * @var string
     */
    private $firstName;

    /**
     * The last name of the verifier entered by the investor, if the investor
     * has not entered a verifier yet this is set to null.
     *
     * @var string
     */
    private $lastName;

    /**
     * The date the investor was verified on, if the investor has not yet been
     * verified this is set to null.
     *
     * @var \DateTime
     */
    private $date;

    public function __construct($state, $firstName, $lastName, $date)
    {
        $this->state = $state;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Returns whether request is submitted.
     *
     * @return bool true if request is submitted, false otherwise
     */
    public function isSubmitted()
    {
        return $this->state == self::STATE_SUBMITTED;
    }

    /**
     * Returns whether request is verified.
     *
     * @return bool true if request is verified, false otherwise
     */
    public function isVerified()
    {
        return $this->state == self::STATE_VERIFIED;
    }

    /**
     * Returns whether request is pending.
     *
     * @return bool true if request is pending, false otherwise
     */
    public function isPending()
    {
        return $this->state == self::STATE_PENDING;
    }
}