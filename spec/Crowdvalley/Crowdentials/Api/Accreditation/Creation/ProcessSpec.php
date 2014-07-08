<?php

namespace spec\Crowdvalley\Crowdentials\Api\Accreditation\Creation;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProcessSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('', '');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Crowdvalley\Crowdentials\Api\Accreditation\Creation\Process');
    }

    function it_gets_id()
    {
        $this->beConstructedWith(123);

        $this->getId()->shouldReturn(123);
    }

    function it_gets_created()
    {
        $created = new \DateTime();

        $this->beConstructedWith('', $created);

        $this->getCreated()->shouldReturn($created);
    }
}
