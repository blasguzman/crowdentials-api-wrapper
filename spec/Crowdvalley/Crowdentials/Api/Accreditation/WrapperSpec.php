<?php

namespace spec\Crowdvalley\Crowdentials\Api\Accreditation;

use Buzz\Browser;
use Buzz\Message\Response;
use Crowdvalley\Crowdentials\Api\Accreditation\Checking\Response as AccreditationCheckingResponse;
use Crowdvalley\Crowdentials\Api\Accreditation\Creation\Process;
use Crowdvalley\Crowdentials\Api\Accreditation\Creation\Request;
use Crowdvalley\Crowdentials\Api\Accreditation\Removal\FailureResponse;
use Crowdvalley\Crowdentials\Api\Accreditation\Removal\SuccessResponse;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WrapperSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Crowdvalley\Crowdentials\Api\Accreditation\Wrapper');
    }

    function it_checks_an_accreditation_process(Browser $browser)
    {
        $this->beConstructedWith('a-key', 'foo.bar', $browser);

        $response = new Response();
        $response->setContent(json_encode(array(
            'state'         => 'a-state',
            'verifierFName' => 'a-first-name',
            'verifierLName' => 'a-last-name',
            'verifiedDate'  => 'a-date'
        )));

        $browser->get('foo.bar/getRequest.php?key=a-key&id=123')->willReturn($response);

        $this
            ->check(new Process(123))
            ->shouldBeLike(new AccreditationCheckingResponse(
                'a-state', 'a-first-name', 'a-last-name', 'a-date'
            ));
    }

    function it_checks_an_accreditation_process_using_an_integer_id(Browser $browser)
    {
        $this->beConstructedWith('a-key', 'foo.bar', $browser);

        $response = new Response();
        $response->setContent(json_encode(array(
            'state'         => 'a-state',
            'verifierFName' => 'a-first-name',
            'verifierLName' => 'a-last-name',
            'verifiedDate'  => 'a-date'
        )));

        $browser->get('foo.bar/getRequest.php?key=a-key&id=123')->willReturn($response);

        $this
            ->check(123)
            ->shouldBeLike(new AccreditationCheckingResponse(
                'a-state', 'a-first-name', 'a-last-name', 'a-date'
            ));
    }

    function it_checks_an_accreditation_process_using_a_string_id(Browser $browser)
    {
        $this->beConstructedWith('a-key', 'foo.bar', $browser);

        $response = new Response();
        $response->setContent(json_encode(array(
            'state'         => 'a-state',
            'verifierFName' => 'a-first-name',
            'verifierLName' => 'a-last-name',
            'verifiedDate'  => 'a-date'
        )));

        $browser
            ->get('foo.bar/getRequest.php?key=a-key&id=123')
            ->willReturn($response);

        $this
            ->check('123')
            ->shouldBeLike(new AccreditationCheckingResponse(
                'a-state', 'a-first-name', 'a-last-name', 'a-date'
            ));
    }

    function it_creates_an_accreditation_request(Browser $browser)
    {
        $this->beConstructedWith('a-key', 'foo.bar', $browser);

        $timestamp = date("Y-m-d H:i:s");

        $response = new Response();
        $response->setContent(json_encode(array(
            'requestId'     => 'an-id',
            'timestamp'     => $timestamp,
        )));

        $browser
            ->get('foo.bar/sendRequest.php?key=a-key&fName=a-first-name&lName=a-last-name&email=an-email&phone=a-phone&client=a-client')
            ->willReturn($response);

        $request = new Request(
            'a-first-name',
            'a-last-name',
            'an-email',
            'a-phone',
            'a-client'
        );

        $this
            ->create($request)
            ->shouldBeLike(new Process('an-id', new \DateTime($timestamp)));
    }

    function it_removes_an_accreditation_process(Browser $browser)
    {
        $this->beConstructedWith('a-key', 'foo.bar', $browser);

        $response = new Response();
        $response->setContent(json_encode(array(
            'response' => 'success'
        )));

        $browser->get('foo.bar/removeRequest.php?key=a-key&id=123')->willReturn($response);

        $this
            ->remove(new Process(123))
            ->shouldBeLike(new SuccessResponse());
    }

    function it_removes_an_accreditation_process_using_an_integer_id(Browser $browser)
    {
        $this->beConstructedWith('a-key', 'foo.bar', $browser);

        $response = new Response();
        $response->setContent(json_encode(array(
            'response' => 'success'
        )));

        $browser->get('foo.bar/removeRequest.php?key=a-key&id=123')->willReturn($response);

        $this
            ->remove(123)
            ->shouldBeLike(new SuccessResponse());
    }

    function it_removes_an_accreditation_process_using_a_string_id(Browser $browser)
    {
        $this->beConstructedWith('a-key', 'foo.bar', $browser);

        $response = new Response();
        $response->setContent(json_encode(array(
            'response' => 'success'
        )));

        $browser->get('foo.bar/removeRequest.php?key=a-key&id=123')->willReturn($response);

        $this
            ->remove('123')
            ->shouldBeLike(new SuccessResponse());
    }

    function it_does_not_remove_an_accreditation_process_with_denied_access(Browser $browser)
    {
        $this->beConstructedWith('a-key', 'foo.bar', $browser);

        $response = new Response();
        $response->setContent(json_encode(array(
            'response' => 'failure',
            'reason'   => 'You do not have permission to remove this request'
        )));

        $browser->get('foo.bar/removeRequest.php?key=a-key&id=123')->willReturn($response);

        $this
            ->remove('123')
            ->shouldBeLike(new FailureResponse(FailureResponse::REASON_DENIED));
    }

    function it_does_not_remove_an_already_removed_accreditation_process(Browser $browser)
    {
        $this->beConstructedWith('a-key', 'foo.bar', $browser);

        $response = new Response();
        $response->setContent(json_encode(array(
            'response' => 'failure',
            'reason'   => 'This request has been deleted'
        )));

        $browser->get('foo.bar/removeRequest.php?key=a-key&id=123')->willReturn($response);

        $this
            ->remove('123')
            ->shouldBeLike(new FailureResponse(FailureResponse::REASON_REMOVED));
    }

    function it_does_not_remove_an_already_completed_accreditation_process(Browser $browser)
    {
        $this->beConstructedWith('a-key', 'foo.bar', $browser);

        $response = new Response();
        $response->setContent(json_encode(array(
            'response' => 'failure',
            'reason'   => 'This request has already been completed'
        )));

        $browser->get('foo.bar/removeRequest.php?key=a-key&id=123')->willReturn($response);

        $this
            ->remove('123')
            ->shouldBeLike(new FailureResponse(FailureResponse::REASON_COMPLETED));
    }
}
