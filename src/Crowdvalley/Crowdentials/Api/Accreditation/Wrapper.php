<?php

/**
 * This file is part of Crowdentials Api Wrapper.
 *
 * (c) Crowd Valley
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Crowdvalley\Crowdentials\Api\Accreditation;

use Buzz\Browser;
use Crowdvalley\Crowdentials\Api\Accreditation\Creation\Process as AccreditationCreationProcess;
use Crowdvalley\Crowdentials\Api\Accreditation\Creation\Request as AccreditationCreationRequest;
use Crowdvalley\Crowdentials\Api\Accreditation\Checking\Response as AccreditationCheckingResponse;
use Crowdvalley\Crowdentials\Api\Accreditation\Removal\FailureResponse as AccreditationRemovalFailureResponse;
use Crowdvalley\Crowdentials\Api\Accreditation\Removal\SuccessResponse as AccreditationRemovalSuccessResponse;

/**
 * @author Yosmany Garcia <yosmanyga@gmail.com>
 */
class Wrapper
{
    const API_VERSION = 2;

    /**
     * The private api key
     *
     * @var string
     */
    private $key;

    /**
     * The base url for api urls
     *
     * @var string
     */
    private $base;

    /**
     * @var \Buzz\Browser
     */
    private $browser;

    /**
     * Constructor.
     *
     * @param string  $key     The private api key
     * @param string  $base    The base url for api urls
     * @param Browser $browser The browser used to make requests
     */
    public function __construct(
        $key,
        $base = 'http://sandbox.crowdentials.com/cai/api/v2',
        Browser $browser = null
    )
    {
        $this->key = $key;
        $this->base = $base;
        $this->browser = $browser ?: new Browser;
    }

    /**
     * Checks an accreditation process.
     *
     * @param mixed $process A process or id
     *
     * @return AccreditationCheckingResponse The response containing the status
     */
    public function check($process)
    {
        if (!$process instanceof AccreditationCreationProcess) {
            $process = new AccreditationCreationProcess((int) $process);
        }

        $url = $this->generateUrl(
            'getRequest.php',
            array(
                'id' => $process->getId()
            )
        );

        $data = $this->callApi($url);

        return new AccreditationCheckingResponse(
            $data['state'],
            $data['verifierFName'],
            $data['verifierLName'],
            $data['verifiedDate']
        );
    }

    /**
     * Sends an accreditation request.
     *
     * @param AccreditationCreationRequest $request
     *
     * @return AccreditationCreationProcess The accreditation process for current request
     */
    public function create(AccreditationCreationRequest $request)
    {
        $url = $this->generateUrl(
            'sendRequest.php',
            array(
                'fName' =>  $request->getFirstName(),
                'lName' =>  $request->getLastName(),
                'email' =>  $request->getEmail(),
                'phone' =>  $request->getPhone(),
                'client' => $request->getClient()
            )
        );

        $data = $this->callApi($url);

        return new AccreditationCreationProcess(
            $data['requestId'],
            new \DateTime($data['timestamp'])
        );
    }

    /**
     * Removes an accreditation process.
     *
     * @param mixed $process
     *
     * @return AccreditationRemovalSuccessResponse|AccreditationRemovalFailureResponse
     */
    public function remove($process)
    {
        if (!$process instanceof AccreditationCreationProcess) {
            $process = new AccreditationCreationProcess((int) $process);
        }

        $url = $this->generateUrl(
            'removeRequest.php',
            array(
                'id' => $process->getId()
            )
        );

        $data = $this->callApi($url);

        if ('success' == $data['response']) {
            return new AccreditationRemovalSuccessResponse();
        }

        return new AccreditationRemovalFailureResponse($data['reason']);
    }

    /**
     * Generates an url using base and given action, then adds to the query the
     * key parameter and given parameters.
     *
     * @param string $action
     * @param array  $parameters
     * @return string The generated url
     */
    private function generateUrl($action, $parameters)
    {
        $parameters = array_merge(
            array('key' => $this->key),
            $parameters
        );

        return sprintf(
            "%s/%s?%s",
            $this->base,
            $action,
            http_build_query($parameters)
        );
    }

    /**
     * @param string $url
     *
     * @return mixed
     */
    private function callApi($url)
    {
        $response = $this->browser->get($url);

        return json_decode($response->getContent(), true);
    }
}
