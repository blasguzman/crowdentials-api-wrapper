<?php

/**
 * This file is part of Crowdentials Api Wrapper.
 *
 * (c) Crowd Valley
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Crowdvalley\Crowdentials\Api\Accreditation\Creation;

/**
 * Class used to create a process for an accreditation request.
 *
 * @author Yosmany Garcia <yosmanyga@gmail.com>
 */
class Process
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @param int            $id
     * @param null|\DateTime $created
     */
    public function __construct($id, $created = null)
    {
        $this->id = $id;
        $this->created = $created;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }
}