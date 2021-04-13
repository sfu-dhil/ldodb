<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace Tests\App\Controller;

use Nines\UtilBundle\Tests\ControllerBaseCase;

class DefaultControllerTest extends ControllerBaseCase
{
    public function testIndex() : void {
        $crawler = $this->client->request('GET', '/');
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
    }
}
