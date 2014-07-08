<?php

/**
 * This file is part of Crowdentials Api Wrapper.
 *
 * (c) Crowd Valley
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Crowdvalley\Crowdentials\Api\Accreditation\Removal;

/**
 * Class used to get a failure response when removing an accreditation.
 *
 * @author Yosmany Garcia <yosmanyga@gmail.com>
 */
class FailureResponse
{
    const REASON_DENIED = 'You do not have permission to remove this request';
    const REASON_REMOVED = 'This request has been deleted';
    const REASON_COMPLETED = 'This request has already been completed';

    /**
     * @var string
     */
    private $reason;

    /**
     * @param string $reason
     */
    function __construct($reason)
    {
        $this->reason = $reason;
    }

    /**
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @return bool true if permission to the request was denied,
     *              false otherwise
     */
    public function wasDenied()
    {
        return $this->reason == self::REASON_DENIED;
    }

    /**
     * @return bool true if request was already deleted, false otherwise
     */
    public function wasRemoved()
    {
        return $this->reason == self::REASON_REMOVED;
    }

    /**
     * @return bool true if request was already completed, false otherwise
     */
    public function wasCompleted()
    {
        return $this->reason == self::REASON_COMPLETED;
    }
}