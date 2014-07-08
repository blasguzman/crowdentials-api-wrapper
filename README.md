Crowdentials Api Wrapper
========================

Provides a wrapper for Crowdentials Api.

# Installation

## Setup through composer

First, add it to the list of dependencies inside your `composer.json`:

```json
{
    "require": {
        "crowdvalley/crowdentials-api-wrapper": "dev-master"
    }
}
```

Then simply install it with composer:

```bash
$> composer install --prefer-dist
```

You can read more about Composer on its [official webpage](http://getcomposer.org).

# Examples

## Sends an accreditation request

```
use Crowdvalley\Crowdentials\Api\Accreditation\Wrapper as ApiWrapper;
use Crowdvalley\Crowdentials\Api\Accreditation\Creation\Request;

$api = new ApiWrapper('your-key');

// Prepares the accreditation request
$request = new Request('John', 'Doe', 'johnd@foo.bar', '123', 'Client Inc');

// Calls the api
$process = $api->create($request);

/* Gets process info */

// The id of the request that has been entered into the Crowdentials system
echo $process->getId();
echo "\r\n";

// The timestamp for when the request was created in the Crowdentials system
echo $process->getCreated()->format('Y-m-d H:i:s');
echo "\r\n";
```

## Gets an accreditation request

```
use Crowdvalley\Crowdentials\Api\Accreditation\Wrapper as ApiWrapper;
use Crowdvalley\Crowdentials\Api\Accreditation\Checking\Response;

$api = new ApiWrapper('your-key');

// The id of the request for which you would like to receive information
$id = 123;

// Calls the api
$response = $api->check($id);

/* Checks response */

if ($response->isSubmitted()) {
    echo "Accreditation was submitted.";
} elseif ($response->isPending()) {
    echo "Accreditation is pending.";
} elseif ($response->isVerified()) {
    echo "Accreditation is verified.";
}

/* Or compares the state directly */

if ($response->getState() == Response::STATE_VERIFIED) {
    echo "Accreditation is verified.";
}

/* Gets more fields */

// The first name of the verifier entered by the investor
$response->getFirstName();
// The last name of the verifier entered by the investor
$response->getLastName();
// The date the investor was verified on
$response->getDate();

```

## Removes an accreditation request

```
use Crowdvalley\Crowdentials\Api\Accreditation\Wrapper as ApiWrapper;
use Crowdvalley\Crowdentials\Api\Accreditation\Removal\SuccessResponse;
use Crowdvalley\Crowdentials\Api\Accreditation\Removal\FailureResponse;

$api = new ApiWrapper('your-key');

// The id of the request for which you would like to remove
$id = 123;

// Calls the api
$response = $api->remove($id);

/* Checks response */

if ($response instanceof SuccessResponse) {
    echo "Accreditation removed successfully";
} elseif ($response instanceof FailureResponse) {
    echo "Accreditation was not removed.";

    if ($response->wasDenied()) {
        echo sprintf("Access denied. Please check your permissions on the accreditation %s.", $id);
    } elseif ($response->wasRemoved()) {
        echo sprintf("The accreditation %s was already removed", $id);
    } elseif ($response->wasCompleted()) {
        echo sprintf("The accreditation %s was already completed", $id);
    }
}

/* Or gets the error directly */

if ($response instanceof SuccessResponse) {
    echo "Accreditation removed successfully";
} elseif ($response instanceof FailureResponse) {
    echo "Accreditation was not removed. We get an error from the server:\r\n";
    echo $response->getReason();
}