<?php

namespace spec\Crowdvalley\Crowdentials\Api\Accreditation\Removal;

use Crowdvalley\Crowdentials\Api\Accreditation\Removal\FailureResponse;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FailureResponseSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Crowdvalley\Crowdentials\Api\Accreditation\Removal\FailureResponse');
    }

    function it_gets_reason()
    {
        $this->beConstructedWith('a-reason');

        $this->getReason()->shouldReturn('a-reason');
    }

    function it_returns_false_if_reason_is_different_than_denied()
    {
        $this->beConstructedWith('foo');

        $this->wasDenied()->shouldReturn(false);
    }

    function it_returns_false_if_reason_is_equal_to_denied()
    {
        $this->beConstructedWith(FailureResponse::REASON_DENIED);

        $this->wasDenied()->shouldReturn(true);
    }

    function it_returns_false_if_reason_is_different_than_removed()
    {
        $this->beConstructedWith('foo');

        $this->wasRemoved()->shouldReturn(false);
    }

    function it_returns_false_if_reason_is_equal_to_removed()
    {
        $this->beConstructedWith(FailureResponse::REASON_REMOVED);

        $this->wasRemoved()->shouldReturn(true);
    }

    function it_returns_false_if_reason_is_different_than_completed()
    {
        $this->beConstructedWith('foo');

        $this->wasCompleted()->shouldReturn(false);
    }

    function it_returns_false_if_reason_is_equal_to_completed()
    {
        $this->beConstructedWith(FailureResponse::REASON_COMPLETED);

        $this->wasCompleted()->shouldReturn(true);
    }
}
