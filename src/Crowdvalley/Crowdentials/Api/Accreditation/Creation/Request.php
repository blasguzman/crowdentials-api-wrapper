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
 * Class used to create an accreditation request.
 *
 * @author Yosmany Garcia <yosmanyga@gmail.com>
 */
class Request
{
    /**
     * The first name of the investor the request is being sent to.
     *
     * @var string
     */
    private $firstName;

    /**
     * The last name of the investor the request is being sent to.
     *
     * @var string
     */
    private $lastName;

    /**
     * The email of the investor the request is being sent to.
     *
     * @var string
     */
    private $email;

    /**
     * The phone number of the investor the request is being sent to.
     *
     * @var string
     */
    private $phone;

    /**
     * The client which is sending this request (Example: Fundable, Gust, etc).
     *
     * @var string
     */
    private $client;

    /**
     * Constructor.
     *
     * @param string|null $firstName
     * @param string|null $lastName
     * @param string|null $email
     * @param string|null $phone
     * @param string|null $client
     */
    function __construct(
        $firstName = null,
        $lastName = null,
        $email = null,
        $phone = null,
        $client = null)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->client = $client;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return string
     */
    public function getClient()
    {
        return $this->client;
    }
}