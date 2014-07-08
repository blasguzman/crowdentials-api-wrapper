<?php

namespace spec\Crowdvalley\Crowdentials\Api\Accreditation\Creation;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RequestSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Crowdvalley\Crowdentials\Api\Accreditation\Creation\Request');
    }

    function it_gets_first_name()
    {
        $this->beConstructedWith('a-first-name', '', '', '', '');

        $this->getFirstName()->shouldReturn('a-first-name');
    }

    function it_gets_last_name()
    {
        $this->beConstructedWith('', 'a-last-name', '', '', '');

        $this->getLastName()->shouldReturn('a-last-name');
    }

    function it_gets_email()
    {
        $this->beConstructedWith('', '', 'an-email', '', '');

        $this->getEmail()->shouldReturn('an-email');
    }

    function it_gets_phone()
    {
        $this->beConstructedWith('', '', '', 'a-phone', '');

        $this->getPhone()->shouldReturn('a-phone');
    }

    function it_gets_client()
    {
        $this->beConstructedWith('', '', '', '', 'a-client');

        $this->getClient()->shouldReturn('a-client');
    }

    function it_sets_first_name()
    {
        $this->setFirstName('foo');
        $this->getFirstName()->shouldReturn('foo');
    }

    function it_sets_last_name()
    {
        $this->setLastName('bar');
        $this->getLastName()->shouldReturn('bar');
    }

    function it_sets_email()
    {
        $this->setEmail('foo@bar');
        $this->getEmail()->shouldReturn('foo@bar');
    }

    function it_sets_phone()
    {
        $this->setPhone('123');
        $this->getPhone()->shouldReturn('123');
    }

    function it_sets_client()
    {
        $this->setClient('client inc');
        $this->getClient()->shouldReturn('client inc');
    }
}
