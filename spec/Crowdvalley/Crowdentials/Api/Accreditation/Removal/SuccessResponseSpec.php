<?php

namespace spec\Crowdvalley\Crowdentials\Api\Accreditation\Removal;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SuccessResponseSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Crowdvalley\Crowdentials\Api\Accreditation\Removal\SuccessResponse');
    }
}
