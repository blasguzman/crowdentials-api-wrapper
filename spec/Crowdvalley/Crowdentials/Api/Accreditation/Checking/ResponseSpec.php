<?php

namespace spec\Crowdvalley\Crowdentials\Api\Accreditation\Checking;

use Crowdvalley\Crowdentials\Api\Accreditation\Checking\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ResponseSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('', '', '', '');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Crowdvalley\Crowdentials\Api\Accreditation\Checking\Response');
    }

    function it_gets_state()
    {
        $this->beConstructedWith('a-state', '', '', '');

        $this->getState()->shouldReturn('a-state');
    }

    function it_gets_first_name()
    {
        $this->beConstructedWith('', 'a-first-name', '', '');

        $this->getFirstName()->shouldReturn('a-first-name');
    }

    function it_gets_last_name()
    {
        $this->beConstructedWith('', '', 'a-last-name', '');

        $this->getLastName()->shouldReturn('a-last-name');
    }

    function it_gets_date()
    {
        $this->beConstructedWith('', '', '', 'a-date');

        $this->getDate()->shouldReturn('a-date');
    }

    function it_returns_false_if_it_has_a_state_different_than_submitted()
    {
        $this->beConstructedWith('foo', '', '', '');

        $this->isSubmitted()->shouldReturn(false);
    }

    function it_returns_true_if_it_has_a_state_equal_to_submitted()
    {
        $this->beConstructedWith(Response::STATE_SUBMITTED, '', '', '');

        $this->isSubmitted()->shouldReturn(true);
    }

    function it_returns_false_if_it_has_a_state_different_than_verified()
    {
        $this->beConstructedWith('foo', '', '', '');

        $this->isVerified()->shouldReturn(false);
    }

    function it_returns_true_if_it_has_a_state_equal_to_verified()
    {
        $this->beConstructedWith(Response::STATE_VERIFIED, '', '', '');

        $this->isVerified()->shouldReturn(true);
    }

    function it_returns_false_if_it_has_a_state_different_than_pending()
    {
        $this->beConstructedWith('foo', '', '', '');

        $this->isPending()->shouldReturn(false);
    }

    function it_returns_true_if_it_has_a_state_equal_to_pending()
    {
        $this->beConstructedWith(Response::STATE_PENDING, '', '', '');

        $this->isPending()->shouldReturn(true);
    }
}
